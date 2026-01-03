<?php

namespace App\Services\HumanResource\Employee;

use Hashids\Hashids;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\ListData;
use App\Models\UserOrganization;
use App\Http\Resources\HumanResource\Employee\ViewResource;
use App\Http\Resources\HumanResource\Employee\IndexResource;

class ViewClass
{
    public function counts(){
        $statuses = ListData::where('is_active',1)->where('type','Employment Status')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name,
                'count' => UserOrganization::where('type_id',$item->id)->count()
            ];
        });
        return $statuses;
    }

    public function list($request){
        $query = User::select('id', 'email', 'username', 'created_at')
        ->with([
            'profile.religion',
            'profile.blood',
            'profile.marital',
            'profile.sex',
            'profile.suffix',
            'organization.division',
            'organization.position',
            'organization.unit',
            'organization.station',
            'organization.type',
            'organization.status',
            'organization.salary',
        ]);
        $query->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('profile', function ($sub) use ($keyword) {
                $sub->whereRaw('LOWER(firstname) LIKE ?', ['%' . strtolower($keyword) . '%'])
                    ->orWhereRaw('LOWER(lastname) LIKE ?', ['%' . strtolower($keyword) . '%'])
                    ->orWhereRaw('LOWER(middlename) LIKE ?', ['%' . strtolower($keyword) . '%']);
            })
            ->orWhere('username', 'like', "%{$keyword}%");
        });
        $query->whereHas('organization', function ($org) use ($request) {
            $org->when($request->status, fn($q) => $q->where('status_id', $request->status))
                ->when($request->type, fn($q) => $q->where('type_id', $request->type))
                ->when($request->position, fn($q) => $q->where('position_id', $request->position))
                ->when($request->division, fn($q) => $q->where('division_id', $request->division))
                ->when($request->station, fn($q) => $q->where('station_id', $request->station));
        });
        $query->orderBy(UserProfile::select('lastname')->whereColumn('user_profiles.user_id', 'users.id'),'ASC');
        $data = IndexResource::collection($query->paginate($request->count));
        return $data;
    }

    public function view($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);

        $data = new ViewResource(
            User::query()
            ->with('profile.religion','profile.blood','profile.marital','profile.sex','profile.suffix')
            ->with('organization.division','organization.position','organization.unit','organization.station','organization.type','organization.status','organization.salary')
            ->with('academics.school','academics.course','academics.level')
            ->with('credentials.name','credentials.type')
            ->with('contracts.division','contracts.position','contracts.unit','contracts.station','contracts.type','contracts.status','contracts.salary')
            ->with('deductions.deduction')
            // ->with('contracts.division','contracts.position','contracts.unit','contracts.station','contracts.type','contracts.status')
            // ->with('information','academics.level','credentials.type','credentials.name')
            ->where('id',$id)->first()
        );
        return $data;
    }
}

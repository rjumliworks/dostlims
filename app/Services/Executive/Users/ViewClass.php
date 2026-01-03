<?php

namespace App\Services\Executive\Users;

use Hashids\Hashids;
use App\Models\User;
use App\Models\UserRole;
use App\Models\AuthenticationLog;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\AuthenticationResource;
use App\Http\Resources\Executive\ViewResource;
use App\Http\Resources\Executive\UserResource;
use App\Http\Resources\Executive\RoleResource;

class ViewClass
{
    public function list($request){
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
        ->with('myroles:role_id,id,user_id,added_by,laboratory_id,removed_by,removed_at,created_at,is_active','myroles.role:id,name','myroles.added:id','myroles.laboratory:id,name','myroles.added.profile:user_id,firstname,middlename,lastname,suffix_id','myroles.removed:id','myroles.removed.profile:user_id,firstname,middlename,lastname,suffix_id')
        ->when($request->role, function ($query) use ($request) {
            $query->whereHas('myroles', function ($q) use ($request) {
                $q->when($request->role, function ($q, $role) {
                    $q->where('role_id', $role);
                });
            });
        })->paginate($request->count);
        return UserResource::collection($data);
    }

    public function user($code){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($code);

        $data = new ViewResource(
            User::query()
            ->with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
            ->with('myroles:role_id,id,user_id,laboratory_id,created_at,is_active','myroles.role:id,name','myroles.role:id,name')
            ->where('id',$id)->first()
        );
        return $data;
    }

    public function authentication($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = AuthenticationLog::with('user.profile')->where('user_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return AuthenticationResource::collection($data);
    }

    public function activity($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = Activity::with('causer.profile')->where('causer_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return ActivityResource::collection($data);
    }

    public function authentications($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = AuthenticationLog::with('user.profile')->where('user_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return AuthenticationResource::collection($data);
    }

    public function activities($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = Activity::with('causer.profile')->where('causer_id',$id)->orderBy('created_at','DESC')->paginate($request->count);
        return ActivityResource::collection($data);
    }
}

<?php

namespace App\Services\Executive\Users;

use Hashids\Hashids;
use App\Models\User;
use App\Models\UserRole;
// use App\Jobs\MailJob;
use App\Http\Resources\Executive\UserResource;
use App\Http\Resources\Executive\RoleResource;

class SaveClass
{
    public function store($request){
        $data = User::create(array_merge($request->all(), [
            'password' => bcrypt('dost9!@#$%2026'),
            'must_change' => 1,
            'email_verified_at' => now()
        ]));
        $data->profile()->create($request->all());
        $data->myroles()->create(array_merge($request->all(),[
            'added_by' => \Auth::user()->id
        ]));
        // MailJob::dispatch($data);
        return [
            'data' => new UserResource($data),
            'message' => 'User creation was successful!', 
            'info' => "You've successfully created an account for the user."
        ];
    }

    public function update($request){
        $data = User::with('profile.suffix')->where('id',$request->id)->first();
        $data->update($request->all());

        return [
            'data' => new UserResource($data),
            'message' => 'User update was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function role($request){
        if($request->type == 'remove'){
            $data = UserRole::find($request->id);
            $data->removed_by = \Auth::user()->id;
            $data->removed_at = now();
            $data->is_active = 0;
            $data->save();
            $id = $request->id;
        }else{
            $data = new UserRole;
            $data->role_id = $request->role_id;
            $data->laboratory_id = $request->laboratory_id;
            $data->user_id = $request->id;
            $data->added_by = \Auth::user()->id;
            $data->is_active = 1;
            $data->save();
            $id = $data->id;
        }

        $data = UserRole::with('role:id,name','added:id','added.profile:user_id,firstname,middlename,lastname,suffix_id','removed:id','removed.profile:user_id,firstname,middlename,lastname,suffix_id')->where('id',$id)->first();
        return [
            'data' => new RoleResource($data),
            'message' => 'User role remove was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

     public function credential($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code)[0];
   
        $data = User::with('profile')->find($id);
        $data->email = $request->email;
        if ($request->set) {
            $data->password = bcrypt($request->password);
            $data->must_change = 1;
        }
        if($data->save() && $data->profile){
            $data->profile->mobile = $request->mobile;
            $data->profile->save();
        }
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile')
        ->with('myroles:role_id,id,user_id','myroles.role:id,name')
        ->where('id',$id)->first();
        return [
            'data' => new UserResource($data),
            'message' => 'User update was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }

    public function status($request){
        $hashids = new Hashids('krad',10);
        $id = $hashids->decode($request->code);
        $data = User::with('profile:user_id,firstname,middlename,lastname,suffix_id,avatar,mobile','profile.suffix')
        ->with('myroles:role_id,id,user_id','myroles.role:id,name')
        ->where('id',$id)->first();
        $data->is_active = $request->is_active;
        $data->save();

        return [
            'data' => new UserResource($data),
            'message' => 'User update was successful!', 
            'info' => "You've successfully updated the selected user."
        ];
    }
}

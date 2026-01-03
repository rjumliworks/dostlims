<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SaveClass
{
    public function save($request){

        $user = User::find(\Auth::user()->id);
        if ($user->profile->avatar) {
            Storage::disk('public')->delete($user->profile->avatar);
        }

        $imagePath = $request->file('image')->store('profile-pictures', 'public');
        $user->profile->avatar = $imagePath;
        $user->profile->save();

        return [
            'data' => [],
            'message' => 'Profile picture updated successfully.', 
            'info' => "The user's profile image has been changed to the new photo."
        ];
    }

    public function update($request){
        $data = User::find(\Auth::user()->id);
        $data->email = $request->email;
        if($data->save()){
            $profile = $data->profile;
            $profile->firstname = $request->firstname;
            $profile->middlename = $request->middlename;
            $profile->lastname = $request->lastname;
            $profile->sex = $request->sex;
            $profile->mobile = $request->mobile;
            $profile->save();
        }
        
        return [
            'data' => new UserResource($data),
            'message' => 'User information updated successfully.', 
            'info' => "All relevant fields have been refreshed with the latest data."
        ];
    }

    public function destroy($request)
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }
        $this->deleteOtherSessionRecords($request);
        return back(303);
    }

    protected function deleteOtherSessionRecords(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return;
        }
        \DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', $request->user()->getAuthIdentifier())
            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }
}

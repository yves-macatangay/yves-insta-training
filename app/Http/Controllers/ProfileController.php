<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id){
        $user_a = $this->user->findOrFail($id);

        return view('users.profile.show')
        ->with('user', $user_a);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')
                ->with('user', $user)->with('success_password', null);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,'.Auth::user()->id,
            'avatar' => 'mimes:jpg,jpeg,png,gif|max:1048',
            'introduction' => 'max:100'
        ]);

        $u = $this->user->findOrFail(Auth::user()->id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->introduction = $request->introduction;

        if($request->avatar){
            if($u->avatar){
                $this->deleteAvatar($u->avatar);
            }
            $u->avatar = $this->saveAvatar($request);
        }
        $u->save();
        
        return redirect()->route('profile.show', Auth::user()->id);
    }

    private function deleteAvatar($avatar_name){
        $file_path = self::LOCAL_STORAGE_FOLDER.$avatar_name;

        if(Storage::disk('local')->exists($file_path)){
            Storage::disk('local')->delete($avatar_path);
        }
    }

    private function saveAvatar($request){
        $avatar_name = time().".".$request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $avatar_name);

        return $avatar_name;
    }

    public function followers($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.followers')->with('user', $user);
    }

    public function following($id){
        $user = $this->user->findOrFail($id);

        return view('users.profile.following')->with('user', $user);
    }

    public function updatePassword(Request $request){
        $user = $this->user->findOrFail(Auth::user()->id);

        if(!Hash::check($request->current_password, $user->password)){
            return redirect()->back()->with('current_password_error', 'That\'s not your current password. Try again.')
            ->with('error_password', 'Unable to change your password');
        }

        if($request->current_password == $request->new_password){
            return redirect()->back()->with('new_password_error', 'New password cannot be the same as your current password. Try again.')->with('error_password', 'Unable to change your password.');
        }

        $request->validate([
            'new_password' => 'required|confirmed|min:8|string'
        ]);

       
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success_password', 'Password changed succesfully.');
    }
}

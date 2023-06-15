<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;
use App\Models\Level;

class ProfileController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user, Level $level){
        $this->user = $user;
        $this->level = $level;
    }

    public function show($id){
        $user = $this->user->findOrFail($id);
        return view('users.profile.show')
        ->with('user', $user);
    }

    public function edit(){
        $user = $this->user->findOrFail(Auth::user()->id);

        $all_levels = $this->level->all();

        return view('users.profile.edit')
        ->with('user', $user)
        ->with('all_levels', $all_levels);
    }

    public function update(Request $request){
        $user = $this->user->findOrFail(Auth::user()->id);

        $all_levels = $this->level->all();

        $request->validate([
            'avatar' => 'max:1048|mimes:jpeg,jpg,png,gif',
            'level_id' => 'required',
            'user_name' => 'required|max:250',
            'comment' => 'max:250',
            'email' => 'required|max:250'
        ]);

        $user->level_id = $request->level_id;
        $user->user_name = $request->user_name;
        $user->comment = $request->comment;
        $user->email = $request->email;

        if($request->avatar){
            if($user->avatar){
                $this->deleteAvatar($user->avatar);
            }
            $user->avatar = $this->saveAvatar($request);
        }
        $user->save();

        return redirect()->route('users.top', $user->id);
    }

    private function deleteAvatar($file_name){
        $file_path = self::LOCAL_STORAGE_FOLDER. $file_name;

        if(Storage::disk('local')->exists($file_path)){
            Storage::disk('local')->delete($file_path);
        }
    }

    private function saveAvatar($request){
        $file_name = time().".".$request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $file_name);

        return $file_name;
    }




}

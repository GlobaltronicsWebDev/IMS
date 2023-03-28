<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function editPassword()
    {
        return view('users.change-user-password');
    }


    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>['required', 'string','min:8','same:password']
        ]);


        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);


        if($currentPasswordStatus){


                User::findOrFail(Auth::user()->id)->update([
                    'password' => Hash::make($request->password),
                ]);
                return redirect()->back()->with('message','Password Updated Successfully');


        }else{


            return redirect()->back()->with('error','Current Password does not match with Old Password');
        }
    }


}

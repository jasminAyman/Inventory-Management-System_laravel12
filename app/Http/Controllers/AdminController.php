<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    //End Method

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view ('admin.admin_profile', compact('profileData'));
    }
    //End Method

    public function ProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $fileName = time(). '.'. $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $fileName);
            $data->photo = $fileName;

            if ($oldPhotoPath && $oldPhotoPath !== $fileName) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    //End Method

    private function deleteOldImage(string $oldPhotoPath): void{
        $fullPath = public_path('upload/user_images/'. $oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
    //End private Method

    public function PasswordUpdate(Request $request){

        $user = Auth::user();
        $request -> validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, $user->password)){
            $notification = array(
                'message' => 'Old Password does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }
    //End Method


    // public function AdminLogin(Request $request){

    //     $credentials = $request->only('email', 'password');

    //     if(Auth::attempt($credentials)){
    //         $user = Auth::user();
    //         $verificationCode = random_int(100000, 999999);

    //         session(['verification_code'=> $verificationCode , 'user_id'=> $user->id]);

    //         Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

    //         Auth::logout();

    //         return redirect()->route('custom.verification.form')->with('status', 'Verification code sent to your mail');
    //     }

    //     return redirect()->back()->withErrors(['email', 'Invalid Credentials Provided']);

    // }
    //End Method
}

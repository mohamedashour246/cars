<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(),[
             'name' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:6' ,
             'password_confirmation' => 'required|same:password'
        ],
        [
            'name.required' => 'من فضلك قم بتسجيل اسم المستخدم',
            'email.required' => 'من فضلك قم بتسجيل البريد الالكترونى',
            'email.email' => 'البريد الالكترونى مستخدم من قبل',
            'password.required' => 'من فضلك قم بتسجيل كلمة المرور',
            'password.min' => 'يجب الا تقل كلمة المرور عن 6 أحرف',
            'password_confirmation.required' => 'من فضلك قم بتسجيل تأكيد كلمة المرور',
            'password_confirmation.same' => 'يجب تطابق كلمتى المرور'
        ]
        );
        if ($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();

        if($user->save())
        {
            return redirect()->route('admin.users')->with('success','تم اضافة مستخدم جديد');
        }
        else {
            return redirect()->back()->with('fail','حدث خطأ ما');
        }

    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
             'email' => 'required',
             'password' => 'required|min:6' ,
        ],
        [
            'email.required' => 'من فضلك قم بتسجيل البريد الالكترونى',
            'password.required' => 'من فضلك قم بتسجيل كلمة المرور',
            'password.min' => 'يجب الا تقل كلمة المرور عن 6 أحرف',
        ]
        );

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        if(!Auth::attempt(['email' => $request['email'] , 'password' => $request['password']])){

            return redirect()->back()->with('fail','البريد الالكترونى او كلمة المرور غير صحيحة');
        }
        else {
            return redirect()->route('admin.users');
        }
    }

    public function getUsers()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function getProfile()
    {
       return view('admin.profile');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Dog;

class UserController extends Controller
{
    protected $request;
    protected $user;
    protected $dog;

    public function __construct(
        Request $request,
        User $user,
        Dog $dog
    ) {
        $this->request = $request;
        $this->user = $user;
        $this->dog = $dog;
    }

    public function login()
    {
        $message = [
            'status' => false,
            'message' => "อีเมลหรือรหัสผ่านไม่ถูกต้อง"
        ];

        if ($this->request->isMethod('post')) {
            if (Auth::attempt(['email' => $this->request->input('email'), 'password' => $this->request->input('password')])) {
                return redirect('dog/user/profile/' . auth()->user()->id);
            }

            return redirect('login')->with('message', $message);
        }

        return view('user.login');
    }

    public function logout()
    {
        $message = [
            'status' => true,
            'message' => "ท่านได้ทำการ Logout ออกจากระบบแล้วกรุณาเข้าสู่ระบบใหม่เมื่อต้องการใช้งาน"
        ];
        Auth::logout();
        return redirect('login')->with('message', $message);
    }
    
    public function register()
    {
        $message = [
            'status' => false,
            'message' => "ลงทะเบียนไม่สำเร็จ"
        ];

        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'first_name' => "required",
                'last_name' => "required",
                'email' => "required|unique:users,email",
                'password' => "required",
                'confirm_password' => "required|same:password",
            ]);

            $params = $this->request->all();
            $this->user->email = $params['email'];
            $this->user->password = bcrypt($params['password']);
            $this->user->first_name = $params['first_name'];
            $this->user->last_name = $params['last_name'];
            $this->user->uuid = uniqid('dog_');
            $this->user->role = "member";

            if ($this->user->save()) {
                $message['status'] = true;
                $message['message'] = "ลงทะเบียนสำเร็จ ท่านสามารถเข้าสู่ระบบได้แล้วค่ะ";
            }

            return redirect('login')->with('message', $message);
        }

        return view('user.register');
    }
    
    public function forgetPassword()
    {
        $message = [
            'status' => false,
            'message' => "ไม่พบข้อมูลนี้ในระบบ"
        ];

        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'email' => "required"
            ]);

            $user = $this->user
                ->where('email', $this->request->input('email'))
                ->first();

            if (!$user) {
                return redirect()->back()->with('message', $message);
            }

            $newPasswordString = rand();
            $passWord = bcrypt($newPasswordString);

            $user->password = $passWord;
            if ($user->save()) {
                $message = [
                    'status' => true,
                    'message' => "ระบบได้ส่งรหัสผ่านใหม่ไปยังอีเมลของท่านแล้ว"
                ];

                $mailData = [
                    'password' => $newPasswordString,
                    'to_email' => $user['email'],
                    'to_name' => $user['email'],
                    'subject' => 'ขอรหัสผ่านใหม่'
                ];

                $this->sendMail($mailData, 'elements.email_template.forget_password');
            }

            return redirect('login')->with('message', $message);
        }

        return view('user.forget_password');
    }

    public function profile($userId)
    {
        $response = [];
        $user = $this->user->find($userId);
        $dogs = $this->dog
            ->where('user_id', $user['id'])
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        $response['user'] = $user;
        $response['dogs'] = $dogs;

        return view('user.profile', $response);
    }

    public function update()
    {
        $response = [];
        $message = [
            'status' => false,
            'message' => "อัพเดทข้อมูลไม่สำเร็จ"
        ];

        $user = $this->user->find(auth()->user()->id);

        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'first_name' => "required",
                'last_name' => "required",
                'phone' => "required",
                'address' => "required",
                'bio' => "required",
            ]);

            if ($this->request->hasFile('image_profile')) {
                $upload = $this->uploadFileAsp($this->request->file('image_profile'), 'users', 400);
                if ($upload['status'] == false) {
                    $message['message'] = $upload['error_message'];
                    return redirect('dog/user/update')->with('message', $message);
                }

                $user->image_profile = $upload['file_name'];
            }

            $params = $this->request->all();
            $user->first_name = $params['first_name'];
            $user->last_name = $params['last_name'];
            $user->phone = $params['phone'];
            $user->address = $params['address'];
            $user->bio = $params['bio'];

            if ($user->save()) {
                $message['status'] = true;
                $message['message'] = "อัพเดทข้อมูลแล้ว";
            }

            return redirect('dog/user/update')->with('message', $message);
        }
        $response['user'] = $user;

        return view('user.update', $response);
    }
}

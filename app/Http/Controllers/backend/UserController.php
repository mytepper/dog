<?php
namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use Auth;
use App\User;

class UserController extends \App\Http\Controllers\Controller
{
    protected $request;
    protected $user;

    public function __construct(
        Request $request,
        User $user
    ) {
        $this->user = $user;
        $this->request = $request;
    }

    public function auth()
    {
        $response = [];
        if (Auth::check()) {
            return redirect('backend/dashboard');
        }

        if ($this->request->isMethod('post')) {
            $message = [];
            $params = $this->request->all();
            if (Auth::attempt([
                'email' => $params['email'], 
                'password' => $params['password'], 
                'activated' => 1])
            ) {
                return redirect('backend/dashboard');
            }

            $message = [
                'status' => false,
                'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'
            ];
            
            return redirect('backend')->with('message', $message);
        }
        
        return view('backend.login', $response);
    }
}
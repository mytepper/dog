@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>สมัครสมาชิก</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['id' => 'register-form', 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        {{ Form::text('first_name', '', ['id' => 'first-name', 'required', "class" => 'input-lg form-control', "placeholder" => "ชื่อ"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('last_name', '', ['id' => 'last-name', 'required', "class" => 'input-lg form-control', "placeholder" => "นามสกุล"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::email('email', '', ['id' => 'email', 'required', "class" => 'input-lg form-control', "placeholder" => "อีเมล"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['id' => 'password', 'required', "class" => 'input-lg form-control', "placeholder" => "รหัสผ่าน"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('confirm_password', ['id' => 'confirm-password', 'required', "class" => 'input-lg form-control', "placeholder" => "ยืนยันรหัสผ่านอีกครั้ง"]) }}
                    </div>
                    <button id="register" type="submit" class="btn btn-primary">ลงทะเบียน</button>
                {{ Form::close() }}
            </div>
            <div class="panel-footer">
                <a href="forget_password" class="forgot-pass">ลืมรหัสผ่าน</a>
                <small> มี Account แล้ว</small> <a href="login" class="signup"> เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</div>
@endsection
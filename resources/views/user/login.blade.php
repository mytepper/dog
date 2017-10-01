@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>เข้าสู่ระบบ</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['id' => 'login-form', 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        {{ Form::email('email', '', ['id' => 'email', 'required', "class" => 'input-lg form-control', "placeholder" => "อีเมล"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', ['id' => 'password', 'required', "class" => 'input-lg form-control', "placeholder" => "รหัสผ่าน"]) }}
                    </div>
                    <button id="register" type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                {{ Form::close() }}
            </div>
            <div class="panel-footer">
                <a href="forget_password" class="forgot-pass">ลืมรหัสผ่าน</a>
                <small> ไม่มี Account </small> <a href="register" class="signup"> ลงทะเบียน</a>
            </div>
        </div>
    </div>
</div>
@endsection
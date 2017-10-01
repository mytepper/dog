@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>ลืมรหัสผ่าน</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['id' => 'login-form', 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        {{ Form::email('email', '', ['id' => 'email', 'required', "class" => 'input-lg form-control', "placeholder" => "อีเมล"]) }}
                    </div>
                    <button id="register" type="submit" class="btn btn-primary">ส่งรหัสผ่านไปยังอีเมล</button>
                {{ Form::close() }}
            </div>
            <div class="panel-footer">
                <a href="login" class="forgot-pass">เข้าสู่ระบบ</a>
                <small> ไม่มี Account </small> <a href="resgister" class="signup"> ลงทะเบียน</a>
            </div>
        </div>
    </div>
</div>
@endsection
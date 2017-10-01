@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>อัพเดทข้อมูลส่วนตัว</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['files' => true, 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        {{ Form::file('image_profile', ["class" => 'input-sm form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('first_name', $user['first_name'], ['required', "class" => 'input-sm form-control', "placeholder" => "ชื่อ"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('last_name', $user['last_name'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => "นามสกุล"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('phone', $user['phone'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => "เบอร์โทรศัพท์"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::textarea('address', $user['address'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => "ที่อยู่"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::textarea('bio', $user['bio'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => "ข้อความแนะนำตัว"]) }}
                    </div>
                    <a role="button" href="dog/user/profile/{{ $user['id'] }}" class="btn btn-default">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary">อัพเดทข้อมูล</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
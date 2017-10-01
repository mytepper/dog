@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>ลงประกาศ</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['files' => true, 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        <small>พันธ์สุนัข</small>
                        {{ Form::select('type_id', $types, '', ['required', "class" => 'input-sm form-control']) }}
                    </div>
                    <div class="form-group">
                        <small>รูปภาพสุนัขขนาด 600*600 pixcel</small>
                        {{ Form::file('image', ["class" => 'input-sm form-control', 'required']) }}
                    </div>
                    <div class="form-group">
                        <small>ชื่อประกาศ</small>
                        {{ Form::text('name', '', ['required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>อายุ/เดือน</small>
                        {{ Form::number('age', '', ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>น้ำหนัก/กิโลกรัม</small>
                        {{ Form::number('weight', '', ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>ส่วนสูง/เซนติเมตร</small>
                        {{ Form::number('height', '', ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>ราคา/บาท</small>
                        {{ Form::number('price', '', ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>รายละเอียด</small>
                        {{ Form::textarea('description', '', ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="province-dropdown">
                        <div class="form-group">
                            <small>จังหวัด</small>
                            {{ Form::select('province_id', ['' => 'เลือกจังหวัด'] + $provinces, '', ['required', "class" => 'input-sm form-control']) }}
                        </div>
                        <div class="form-group">
                            <small>อำเภอ</small>
                            {{ Form::select('district_id', ['' => 'อำเภอ'], '', ['required', "class" => 'input-sm form-control']) }}
                        </div>
                    </div>
                    <a role="button" href="dog/store" class="btn btn-default">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary">ลงประกาศ</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
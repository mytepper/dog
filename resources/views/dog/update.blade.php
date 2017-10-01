@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>แก้ไขประกาศหมายเลข : {{ $dog['id'] }}</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['files' => true, 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        <small>พันธ์สุนัข</small>
                        {{ Form::select('type_id', $types, $dog['type_id'], ['required', "class" => 'input-sm form-control']) }}
                    </div>
                    <div class="form-group">
                        <small>รูปภาพสุนัขขนาด 600*600 pixcel</small>
                        {{ Form::file('image', ["class" => 'input-sm form-control']) }}
                    </div>
                    <div class="form-group">
                        <small>ชื่อประกาศ</small>
                        {{ Form::text('name', $dog['name'], ['required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>อายุ/เดือน</small>
                        {{ Form::number('age', $dog['age'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>น้ำหนัก/กิโลกรัม</small>
                        {{ Form::number('weight', $dog['weight'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>ส่วนสูง/เซนติเมตร</small>
                        {{ Form::number('height', $dog['height'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>ราคา/บาท</small>
                        {{ Form::number('price', $dog['price'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="form-group">
                        <small>รายละเอียด</small>
                        {{ Form::textarea('description', $dog['description'], ['last-name', 'required', "class" => 'input-sm form-control', "placeholder" => ""]) }}
                    </div>
                    <div class="province-dropdown">
                        <div class="form-group">
                            <small>จังหวัด</small>
                            {{ Form::select('province_id', ['' => 'เลือกจังหวัด'] + $provinces, $dog['province_id'], ['required', "class" => 'input-sm form-control']) }}
                        </div>
                        <div class="form-group">
                            <small>อำเภอ</small>
                            {{ Form::select('district_id', ['' => 'อำเภอ'] + $districts, $dog['district_id'], ['required', "class" => 'input-sm form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                            <small>สถานะ</small>
                            {{ Form::select('sale', [0 => 'ยังไม่ได้ขาย', 1 => 'ขายแล้ว'], $dog['sale'], ['required', "class" => 'input-sm form-control']) }}
                        </div>
                    <a role="button" href="dog/store" class="btn btn-default">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary">อัพเดทข้อมูล</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
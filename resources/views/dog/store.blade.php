@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>ค้นหาตามเงื่อนไข</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(['method' => 'get', 'class' => "form col-md-12 center-block"]) }}
                    <div class="form-group">
                        <small class="label label-primary">พันธ์สุนัข</small>
                        {{ Form::select('type_id', ['' => 'พันธ์สุนัขทั้งหมด'] + $types, '', ["class" => 'input-sm form-control']) }}
                    </div>
                    <div class="province-dropdown">
                        <div class="form-group">
                            <small class="label label-primary">จังหวัด</small>
                            {{ Form::select('province_id', ['' => 'เลือกจังหวัด'] + $provinces, '', ["class" => 'input-sm form-control']) }}
                        </div>
                        <div class="form-group">
                            <small class="label label-primary">อำเภอ</small>
                            {{ Form::select('district_id', $districts, '', ["class" => 'input-sm form-control']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <small class="label label-primary">ช่วงอายุ/เดือน</small>
                        <table>
                            <tr>
                                <td>
                                    <div class="range-slider">
                                        <input name="age_min" class="range-slider__range" type="range" value="{{ (request()->has('age_min')) ? request()->input('age_min') : '0' }}" min="0" max="{{ $max_age }}">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </td>
                                <td> </td>
                                <td>
                                    <div class="range-slider">
                                        <input name="age_max" class="range-slider__range" type="range" value="{{ (request()->has('age_max')) ? request()->input('age_max') : '1' }}" min="1" max="{{ $max_age }}">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group">
                        <small class="label label-primary">ช่วงราคา</small>
                        <table>
                            <tr>
                                <td>
                                    <div class="range-slider">
                                        <input name="p_min" class="range-slider__range" type="range" value="{{ (request()->has('p_min')) ? request()->input('p_min') : '0' }}" min="0" max="{{ $max_price }}">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </td>
                                <td> </td>
                                <td>
                                    <div class="range-slider">
                                        <input name="p_max" class="range-slider__range" type="range" value="{{ (request()->has('p_max')) ? request()->input('p_max') : '0' }}" min="0" max="{{ $max_price }}">
                                        <span class="range-slider__value">0</span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <a role="button" href="dog/store" class="btn btn-default">ยกเลิก</a>
                    <button type="submit" class="btn btn-primary">ค้นหาตามเงื่อนไข</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-8 panel panel-default">
        <br>
        @foreach($dogs as $dog)
            <div class="col-md-6 col-sm-6 box-fix-height-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{ $dog->name }}</h4>
                    </div>
                    <div class="panel-body">
                        <a href="dog/detail/{{ $dog->id }}">
                            <img src="image/dogs/{{ $dog['image'] }}" class="img-responsive pull-right">
                        </a>
                        <table class="table">
                            <tr>
                                <td>ราคา</td>
                                <td><h4 class="label label-success">{{ number_format($dog->price) }} บาท</h4></td>
                            </tr>
                            <tr>
                                <td>พันธ์</td>
                                <td>{{ $dog->type->name }}</td>
                            </tr>
                            <tr>
                                <td>ที่อยู่</td>
                                <td>{{ $dog->district->name_th }}/{{ $dog->province->name_th }}</td>
                            </tr>
                            <tr>
                                <td>โดย</td>
                                <td>{{ $dog->user->first_name }} {{ $dog->user->last_name }}</td>
                            </tr>
                            <tr>
                                <td>วันที่</td>
                                <td>{{ $dog->created_at }}</td>
                            </tr>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                </div> 
            </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {{ $dogs->links() }}
    </div>
</div>
@endsection
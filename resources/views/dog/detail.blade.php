@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if(auth()->user()->id === $dog['user_id'])
                        <div class="btn-group pull-right">
                            <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                จัดการ <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dog/update/{{ $dog->id }}">แก้ไขข้อมูล</a>
                                </li>
                                <li>
                                    <a href="dog/delete/{{ $dog->id }}" class="btn-danger">ลบข้อมูล</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <h4>{{ $dog->name }}</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1 class="label label-primary">{{ number_format($dog->price) }}</h1>
                            <img src="image/dogs/{{ $dog['image'] }}" class="img-responsive pull-right">
                            <table class="table">
                                <tr>
                                    <td width="150">วันที่ลงประกาศ</td>
                                    <td>{{ $dog->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>พันธ์</td>
                                    <td>{{ $dog->type->name }}</td>
                                </tr>
                                <tr>
                                    <td>อายุ</td>
                                    <td>{{ $dog->age }} เดือน</td>
                                </tr>
                                <tr>
                                    <td>น้ำหนัก</td>
                                    <td>{{ $dog->age }} กิโลกรัม</td>
                                </tr>
                                <tr>
                                    <td>ส่วนสูง</td>
                                    <td>{{ $dog->age }} เซนติเมตร</td>
                                </tr>
                                <tr>
                                    <td>อำเภอ</td>
                                    <td>{{ $dog->district->name_th }}</td>
                                </tr>
                                <tr>
                                    <td>จังหวัด</td>
                                    <td>{{ $dog->province->name_th }}</td>
                                </tr>
                                <tr>
                                    <td>อ่าน</td>
                                    <td>{{ $dog->view }}</td>
                                </tr>
                            </table>
                            <hr>
                            <div>
                                {!! $dog->description !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4>ความคิดเห็น</h4>
                                </div>
                                    <div class="panel-body">
                                        <img src="//placehold.it/150x150" class="img-circle pull-right"> 
                                        โดย : <a href="#"> Admin</a>
                                        <p>หมาน่ารักจังเลยค่ะ</p>
                                    <hr>
                                    <form>
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default"><i class="glyphicon glyphicon-share"></i></button>
                                        </div>
                                        <input class="form-control" placeholder="Add a comment.." type="text">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
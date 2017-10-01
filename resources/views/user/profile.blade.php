@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-md-8 col-sm-8 box-fix-height">
    	<div class="panel panel-default">
            <div class="panel-heading">
                @if(auth()->user()->id === $user['id'])
                    <a class="btn btn-primary btn-sm" href="dog/user/update" class="pull-right">อัพเดทข้อมูลส่วนตัว</a>
                @endif
                <h4>ข้อมูลส่วนตัวของ : {{ $user['first_name'] }} {{ $user['last_name'] }}</h4>
            </div>
            <div class="panel-body">
                แนะนำตัว : {{ $user['bio'] }}
                <hr>
                <div class="well well-sm">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#">
                            <img class="media-object" src="{{ ($user['image']) ?  'image/uers/' . $user['image'] : 'images/120.png' }}">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $user['first_name'] }} {{ $user['last_name'] }}</h4>
                            <table class="table">
                                <tr>
                                    <td>อีเมล</td>
                                    <td>{{ $user['email'] }}</td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร</td>
                                    <td>{{ $user['phone'] }}</td>
                                </tr>
                                <tr>
                                    <td>ที่อยู่</td>
                                    <td>{{ $user['address'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    @foreach ($dogs as $dog)
        @include('elements.dog_box')
    @endforeach
</div>
@endsection
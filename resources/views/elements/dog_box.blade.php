<div class="col-md-4 col-sm-4 box-fix-height">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if(auth()->user()->id === $user['id'])
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
            <h4>ประกาศหมายเลข : {{ $dog->id }}</h4>
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
                    <td>ชื่อประกาศ</td>
                    <td>{{ $dog->name }}</td>
                </tr>
                <tr>
                    <td>พันธ์</td>
                    <td>{{ $dog->type->name }}</td>
                </tr>
                <tr>
                    <td>ที่อยู่</td>
                    <td>{{ $dog->district->name_th }}/ {{ $dog->province->name_th }}</td>
                </tr>
                <tr>
                    <td>วันที่ลงประกาศ</td>
                    <td>{{ $dog->created_at }}</td>
                </tr>
            </table>
            <div class="clearfix"></div>
        </div>
    </div> 
</div>
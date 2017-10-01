<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
        <div class="navbar-header">
            @if(auth()->user())
                <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-dashboard" style="color:#dd1111;"></i> Dashboard <small><i class="glyphicon glyphicon-chevron-down"></i></small>
                </a>
                <ul class="nav dropdown-menu">
                    <li><a href="dog/user/profile/{{ auth()->user()->id }}"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Profile</a></li>
                    <li><a href="dog/logout" role="button">ออกจากระบบ</a></li>
                    <li class="nav-divider"></li>
                    <li><a href="dog/index"><i class="glyphicon glyphicon-plus"></i> จัดการข้อมูลสุนัข</a></li>
                    <li><a href="dog/condition"><i class="glyphicon glyphicon-plus"></i> จัดการข้อมูลฝากหาสุนัข</a></li>
                </ul>
            @endif
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse2">
            <ul class="nav navbar-nav navbar-right">
                @if(auth()->user())
                    <li class="{{ Request::is('dog/create') ? 'active' : '' }}"><a href="dog/create" role="button">ลงประกาศขายสุนัข</a></li>
                    <li class="{{ (Request::is('dog/store') || Request::is('dog/detail/*')) ? 'active' : '' }}"><a href="dog/store" role="button">ตามหาสุนัข</a></li>
                    <li class="{{ Request::is('condition/create') ? 'active' : '' }}"><a href="condition/create" role="button">ฝากหาสุนัข</a></li>
                @else
                    <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="register" role="button">ลงทะเบียน</a></li>
                    <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="login" role="button">เข้าสู่ระบบ</a></li>
                @endif
            </ul>
        </div>
     </div>	
</div>
<!DOCTYPE html>
<html>
    <head>
        <base href="{{ URL('/') }}/" target="">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Test</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all, follow">
        <link href="dog/css/bootstrap.min.css" rel="stylesheet">
        <link href="dog/css/rang-slider.css" rel="stylesheet">
        <link href="dog/css/styles.css" rel="stylesheet">
    </head>
    <body>
        
        @include('elements.nav')
        
        <!--main-->
        <div class="container" id="main">
            @yield('content')
        </div>
        <!--/main-->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="dog/js/bootstrap.min.js"></script>
		<script src="dog/js/rang-slider.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
        <script src="template/js/jquery.validate.min.js"></script>
        <script src="js/bootstrap-notify.js"></script>
        <script src="js/main.js"></script>
		<script src="dog/js/scripts.js"></script>
        
        @include('elements.message')
    
    </body>
</html>
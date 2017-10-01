@if (session('message'))
@php
    $message = session('message');
@endphp
    <script>
        $(function(e) {
            var app = new App;
            app.noti('{{ $message['message'] }}', {{ $message['status'] }});
        });
    </script>
@endif

@if (count($errors) > 0)
    <script>
        $(function(e) {
            var app = new App;
            @foreach ($errors->all() as $error)
                app.noti('{{ $error }}', false);
            @endforeach
        });
    </script>
@endif
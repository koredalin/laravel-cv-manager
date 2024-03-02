<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CV Мениджър')</title>

    <!--<title>{{ config('app.name', 'CV Мениджър') }}</title>-->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

    <!-- Scripts -->
    @vite([
        'resources/css/app.css',
        'resources/css/style.css',
        'resources/css/bootstrap-datepicker.min.css',
        'resources/js/app.js',
        'resources/js/bootstrap-datepicker.min.js',])
</head>
<body>

    <div class="container">
    @section('content')
        This is the master sidebar.
    @show
    </div>
    
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
       $('#dob_datepicker').datepicker();
    });
</script>    
</html>
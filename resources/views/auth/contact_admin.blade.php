<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasol</title>
    <link rel="stylesheet" href="{{ asset('assets/voler/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/voler/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/voler/app.css') }}">
</head>
<body>
<div id="error">

    <div class="container text-center pt-32">
        <h5 style="font-size: 6rem;">Please Contact Admin</h5>
        <div style="font-size: 1.2rem;">
            @foreach($admins as $admin)
                <h3>{{ $admin->name }} ({{ $admin->team->name }} Team)</h3>
            @endforeach
            <p>Please send the following data to Admin : Full Name, Office Email, Mobile Number & Team, Breakfast OR Lunch OR both</p>
        </div>
        <a href="/" class='btn btn-primary'>Go Home</a>
    </div>

    <div class="footer pt-32">
{{--        <p class="text-center">© 2020<script type="text/javascript">document.write( new Date().getFullYear() );</script></p>--}}
        <p class="text-center">© 2020</p>
    </div>
</div>
</body>
</html>

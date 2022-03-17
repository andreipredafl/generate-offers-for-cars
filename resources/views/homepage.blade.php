<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />

    </head>
    <body>
        <div class="w-100 mt-5 text-center" style="color: #537EDB;">
            
            <div style="max-width: 300px;" class="m-auto">
                <a href="{{ route('homepage') }}">
                	<img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
				</a>
            </div>
            <h2 class="mt-5">
                <br>
                Nothing to see here..
            </h2>
            <br>
            
            <div class="mt-3 ml-3">
                <h5>If you want an offer for a car you can contact us</h5>
                <h5>Email: sales@open-auction.nl</h5>
            </div>
            
            <div class="col-md-6 m-auto">
                <img src="{{ asset('/images/home-cars.png') }}" alt="Image with cars" class="img-fluid">
            </div>
            
            <a href="{{ route('login') }}" class="mt-5">Are you an admin? Login here</a>
        </div>
    </body>
</html>

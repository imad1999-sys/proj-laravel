<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Tammudu+2&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Hidden brand</a>
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }} <span class="sr-only">(current)</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md"style="font-family: 'Baloo Paaji 2', cursive;">
                    {{__('messages.editYourOffer')}}
                </div>
                @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success" role="alert" style="font-family: 'Baloo Tammudu 2', cursive;">
                    {{\Illuminate\Support\Facades\Session::get('success')}}
                </div>
                @endif
                <br>
                <form method="POST" action="{{route('offers.update',$offer->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerPhoto')}}</label>
                        <input type="text" class="form-control" name="photo" >
                        @error('photo')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerName')}}</label>
                        <input type="text" class="form-control" name="name" value="{{$offer -> name}}" placeholder="Enter the Name" style="font-family: 'Baloo Tammudu 2', cursive;">
                        @error('name')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerPrice')}}</label>
                        <input type="text" class="form-control" name="price" value="{{$offer -> price}}" placeholder="Enter the Price" style="font-family: 'Baloo Tammudu 2', cursive;">
                        @error('price')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.storeOffer')}}</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>

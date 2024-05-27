<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    @stack('css')

    <script src="https://kit.fontawesome.com/ca92620e44.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/gsap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    @stack('script')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('storage/default/misha_logo.png') }}" alt="" width="100"
                        height="24" class="d-inline-block align-text-top">
                    {{ env('APP_NAME') }}
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" aria-current="page" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('support') ? 'active' : '' }}" aria-current="page" href="{{ route('support') }}">Support</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" aria-current="page" href="{{ route('profile') }}">
                                {{ Str::of((auth()->user()->name))->ucfirst()->limit(8) ?? 'Profile' }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @method('post')
                                <button class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="alertWrapper">
        @if(Session::has('err_msg_'))
        <div class="alert">
            <strong>{{ session('message') }}</strong>
        </div>
        @endif
    </div>

    @yield('content')

</body>

</html>

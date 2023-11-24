<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHH</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" /> --}}
    <link rel="icon" type="image/x-icon" href="/CHHLogo.png">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <div class="card layout bg-white" style="width: 90%; height: 650px;">
        <nav class="navbar layoutnav">
            <div class="container-fluid d-flex justify-content-between">
                <div class="d-flex">
                    <img class="navlay" src="{{ asset('CHHLogo.png') }}" alt="CHH Logo">
                    <h3 class="mt-2">ADMIN</h3>
                </div>
                <div class="containernav d-flex">
                    <div class="navlink d-flex mt-2 mx-3">
                        <div class="home">
                            <a href="{{ route('admin') }}">Home</a>
                        </div>
                        <div class="proposal mx-3">
                            <a href="{{ route('adminproposal') }}">Proposal</a>
                        </div>
                        <div class="management">
                            <a href="{{ route('attendance') }}">Management</a>
                        </div>
                    </div>
                    <div class="logout ms-3">
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <button class="logoutbtn"><a><i class="fa-solid fa-arrow-right-from-bracket"></i></a></button>
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
          </nav>
          
          @yield('content')
          </div>
    </div>
    <script src="/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
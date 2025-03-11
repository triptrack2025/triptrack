@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TripTrack</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <meta property="og:title" content="TripTrack - Scan Track Explore">
    <meta property="og:description" content="Global Track & Trace Solutions for Everyday Valuables and Travel Essentials.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://triptrack.in">

    <meta property="og:image" content="{{ asset('assets/images/triptrack-logo-main.png?v=2') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" href="{{ asset('assets/images/triptrack-logo-main.png?v=2') }}" type="image/png">

   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icomoon/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .preview-container {
            border: 2px solid #ddd;
            padding: 10px;
            text-align: center;
            width: 300px;
            height:550px !important;
            margin: auto;
        }
        .preview-logo-front {
            max-width: 100px;
        }
        .preview-logo-back {
            max-width: 100px;
        }

        .back-side  {
            margin-left: 0px;
            padding-left: 0px;
            padding-right: 0px;
        }

        .front-content{
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            text-align: center;
            height: 500px;
        }

        .back-content{
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            text-align: center;
            height:100%;
        }

        .normalBtn{
            margin: 0;
            background-color: #f3f2ec;
            color: #777777;
            font-weight: 500;
        }
      

        @media (max-width: 768px) { 
            .main-logo {
                text-align: center;

            }
            .header-menu {
                padding-top:0;
            }
        }
    

      
    </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">


    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session("error") }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif


    <div id="header-wrap">

        <header class="header-logo" id="header">
			<div class="container-fluid">
				<div class="row ">
					<div class="col-md-2">
						<div class="main-logo">
                            <a href="/"><img src="{{ asset('assets/images/triptrack-logo-main.png') }}" alt="logo" width="50"></a>
						</div>

					</div>

					<div class="col-md-10" >    
						<nav id="navbar">
							<div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="menu-item {{ Request::is('collection/all') ? 'active' : '' }}">
                                        <a href="{{ url('/collection/all') }}">Product</a>
                                    </li>
                                    <li class="menu-item {{ Request::is('collection/page/about-us') ? 'active' : '' }}">
                                        <a href="{{ url('collection/page/about-us') }}">About Us</a>
                                    </li>
                                    <li class="menu-item {{ Request::is('collection/page/contact-us') ? 'active' : '' }}">
                                        <a href="{{ url('/collection/page/contact-us') }}">Contact Us</a>
                                    </li>

                                    @if(Auth::check())
                                        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                                            <a href="{{ url('dashboard') }}">Dashboard</a>
                                        </li>
                                        <li class="menu-item">
                                            <form class="mb-0" id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="normalBtn" type="submit">Logout</button>
                                            </form>
                                        </li>
                                    @else
                                        <li class="menu-item {{ Request::is('login') ? 'active' : '' }}">
                                            <a href="{{ url('login') }}">Login</a>
                                        </li>
                                        <li class="menu-item {{ Request::is('signUp') ? 'active' : '' }}">
                                            <a href="{{ url('signUp') }}">Sign Up</a>
                                        </li>
                                    @endif
                                </ul>
								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</header>

        <!-- <header id="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <div class="main-logo">
                            <a href="/"><img src="{{ asset('assets/images/triptrack-logo-main.png') }}" alt="logo" width="100"></a>
                        </div>
                    </div>
                    <div class="col-md-10 header-menu header-logo">
                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                          
                                <ul class="menu-list">
                                    <li class="menu-item active"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="menu-item"><a href="{{ url('/collection/all') }}">Product</a></li>
                                    <li class="menu-item"><a href="{{ url('collection/page/about-us') }}">About Us</a></li>
                                    <li class="menu-item"><a href="{{ url('/collection/page/contact-us') }}">Contact Us</a></li>
                                    
                                    @if(Auth::check())
                                        <li class="menu-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>

                                        <li class="menu-item">
                                            <form class="mb-0"  id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="normalBtn" type="submit">Logout</a>

                                            </form>
                                        </li>
                                    @else
                                        <li class="menu-item"><a href="{{ url('login') }}">Login</a></li>
                                        <li class="menu-item"><a href="{{ url('signUp') }}">Sign Up</a></li>
                                    @endif
                                </ul>

                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                        </nav>
                       
                    </div>
                </div>
            </div>
        </header> -->
    </div>

    <script>
        document.querySelector('.hamburger').addEventListener('click', function () {
            document.querySelector('.stellarnav').classList.toggle('active');
        });
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .selected {
            border-color: white;
            box-shadow: 0 0 10px black;
            background-color:#b7bcc2;
        }
    </style>


  </head>

  <body>

	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">

        <img src="{{ asset('images/logo.png') }}" class="" alt="" style="max-height: 60px; width: 70px;">
        
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('frontend.welcome') }}" class="nav-link">Home</a></li>
                <li class="nav-item {{ request()->is('front/services') ? 'active' : '' }}"><a href="{{ route('frontend.services') }}" class="nav-link">Services</a></li>
                <li class="nav-item {{ request()->is('front/quote') ? 'active' : '' }}"><a href="{{ route('frontend.quote') }}" class="nav-link">Quote</a></li>
                <li class="nav-item {{ request()->is('front/fleets') ? 'active' : '' }}"><a href="{{ route('frontend.fleets') }}" class="nav-link">Fleets</a></li>
                <li class="nav-item "><a href="#" class="nav-link">Contact</a></li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @guest
                        <a class="dropdown-item" href="{{ route('user.register.show') }}">Sign Up</a>
                        <a class="dropdown-item" href="{{ route('user.login.show') }}">Sign In</a>

                        @else
                        <span class="dropdown-item">Logged in as <b>{{ Auth::user()->name }}</b></span>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item " href="{{ route('user.logout') }}">Logout</a>
                        @endguest
                    </div>
                </li>
                <li class="nav-item {{ request()->is('front/booking') ? 'active' : '' }}"><a href="{{ route('frontend.booking') }}" class="nav-link btn btn-warning text-white my_booking_btn ">BOOK ONLINE</a></li>
            </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Booking<i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Booking</h1>
          </div>
        </div>
      </div>
    </section>

        <section class="ftco-section ftco-no-pt bg-light">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-12	featured-top">
                        <div class="row no-gutters">
                            <div class="col-md-12 d-flex align-items-center shadow">
                                <form action="{{ route('booking.store') }}" method="post" class="col-md-12 request-form ftco-animate bg-primary ">
                                    @displayErrors                                    @csrf
                                    <h2>Book Now</h2>
                                    <div class="form-group">
                                        <label for="" class="label">Select Request Type</label>
                                       <select name="request_type" class="form-control">
                                        <option value="booking" class="bg-primary">BOOKING</option>
                                        <option value="quote" class="bg-primary">QUOTE</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Select Payment Type</label>
                                       <select name="payment_type" class="form-control">
                                        <option value="stripe" class="bg-primary">CARD</option>
                                        <option value="paypal" class="bg-primary">PAYPAL</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Pick-up location</label>
                                        <input type="text" class="form-control" name="pickup_address" id="pickup_address" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Drop-off location</label>
                                        <input type="text" class="form-control" name="destination_address" id="destination_address" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Pick-up Date</label>
                                        <input type="datetime-local" class="form-control" name="pickup_date_time" >
                                    </div>


                                    <div class="form-group">
                                        <label for="" class="label">Name</label>
                                        <input type="text" class="form-control" name="name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Phone</label>
                                        <input type="number" class="form-control" name="phone" >
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Email</label>
                                        <input type="email" class="form-control" name="email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Number of Pessingers</label>
                                       <select name="no_of_passengers" class="form-control">
                                        <option value="1" class="bg-primary">1</option>
                                        <option value="2" class="bg-primary">2</option>
                                        <option value="2" class="bg-primary">3</option>
                                        <option value="2" class="bg-primary">4</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Child Seat</label>
                                       <select name="child_seat" class="form-control">
                                        <option value="1" class="bg-primary">1</option>
                                        <option value="2" class="bg-primary">2</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Suitcases</label>
                                       <select name="suitcases" class="form-control">
                                        <option value="1" class="bg-primary">1</option>
                                        <option value="2" class="bg-primary">2</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Hand Luggage</label>
                                       <select name="hand_luggage" class="form-control">
                                        <option value="1" class="bg-primary">1</option>
                                        <option value="2" class="bg-primary">2</option>
                                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label">Select Fleet</label>
                                        <div class="row">
                                            @foreach($data as $fleet)
                                            <div class="col-md-4 mb-4">
                                                <div type="button" class="card fleet-card" id="fleetCard{{ $fleet->id }}">
                                                    <img src="{{ asset('storage/'.$fleet->banner_image) }}" class="card-img-top" alt="{{ $fleet->title }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $fleet->title }}</h5>
                                                        <p class="text-dark">Max Passengers : {{ $fleet->max_passengers }}</p>
                                                        <p class="text-dark">Max Suitcase : {{ $fleet->max_suitcases }}</p>
                                                        <p class="text-dark">Max Hand Luggage : {{ $fleet->max_hand_luggage }}</p>
                                                        <p class="text-dark">Amount : $<span id="fleetPayable{{ $fleet->id }}"></span></p>
                                                        <span class="fleet-amount"></span>
                                                        <input type="hidden" name="fleet_id" value="{{ $fleet->id }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    
                                        <input type="hidden" class="form-control" name="payment_amount" id="payment_amount" >
                                    </div>
                                    <div class="d-flex">

                            <div class="form-group">
                            <input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
                            </div>
                                </form>
                            </div>

                        </div>
                    </div>
            </div>
           
        </section>


    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><a href="#" class="logo">Bristol<span> Cabwise</span></a></h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
                <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Customer Support</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">FAQ</a></li>
                <li><a href="#" class="py-2 d-block">Payment Option</a></li>
                <li><a href="#" class="py-2 d-block">Booking Tips</a></li>
                <li><a href="#" class="py-2 d-block">How it works</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	               <li><span class="icon icon-map-marker"></span><span class="text">Address :
                                        81 Blackberry Hill
                                        Bristol
                                        Bs161df</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2  07533225970</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
  <script src="{{ asset('js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtRWAKC7UW3kK8VNLlDe1EBHQQKu6ZTFo&libraries=places&callback=initMap"></script>


  <script src="{{ asset('js/google-map.js') }}"></script>
  <script src="{{ asset('js/main.js') }}"></script>
  <script>
    $(document).ready(function() {
        $('.fleet-card').click(function() {
            $('.fleet-card').removeClass('selected');
            $(this).addClass('selected');
            var fleetId = $(this).find('input[name="fleet_id"]').val();
        });
    });

</script>


<script src="{{ asset('js/distance.js') }}"></script>








  </body>
</html>

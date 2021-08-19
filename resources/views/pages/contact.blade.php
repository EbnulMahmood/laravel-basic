@extends('layouts.home-master')
@section('home-content')




<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Contact</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Contact</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Contact Section ======= -->
  <div class="map-section">
      <div class="mapouter">
        <div class="gmap_canvas">
          <iframe style="border:0; width: 100%; height: 350px;" id="gmap_canvas" src="https://maps.google.com/maps?q=United%20International%20University,%20Madani%20Avenue,%20Dhaka,%20Bangladesh&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
          <br>
          <style>.mapouter{position:relative;text-align:right;height:350px;width:100%;}</style>
          <style>.gmap_canvas {overflow:hidden;background:none!important;height:350px;width:100%;}</style></div>
      </div>
  </div>

  <section id="contact" class="contact">
    <div class="container">

      <div class="row justify-content-center" data-aos="fade-up">

        <div class="col-lg-10">

          <div class="info-wrap">
            <div class="row">
              <div class="col-lg-4 info">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>{{ $contact->address }}</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>{{ $contact->email }}</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>{{ $contact->phone }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">
          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <form action="{{ route('contact-form') }}" method="POST" class="info-wrap">
            @csrf
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"/>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
              </div>
              <div class="col-md-6 form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"/>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"/>
              @error('subject')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
              @error('message')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
            <div class="text-center"><button class="btn btn-success" type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->




@endsection
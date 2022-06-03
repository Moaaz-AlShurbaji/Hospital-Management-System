<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <style>
      label{
        display: inline-block;
        width: 200px;
      }
      
    </style>

    <base href="/public">
    @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')      <!-- partial -->

      @include('admin.navbar')
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        
        
        
        <div style="padding-top: 50px;" class="container" align="center">
          @if(session()->has('message'))
          <button type="button" class="close" data-dismiss='alert'>x</button>
          <div class="alert alert-success">{{ session()->get('message') }}</div>

          @endif
          <h1 style="font-size: 40px; padding-bottom:10px;">Reply to {{ $appointment->name }} appointment</h1>

            <form method="post" action="{{ route('sendMail',$appointment->id) }}">
                @csrf
                <div style="padding: 15px">
                    <label for="">Greeting</label>
                    <input style="color: #000;" type="text" name="greeting" placeholder="" size="70">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>

                <div style="padding: 15px">
                    <label for="">Body</label>
                    <input style="color: #000;" type="text" name="body" placeholder="" size="70">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>

                <div style="padding: 15px">
                    <label for="">Action Text</label>
                    <input style="color: #000;" type="text" name="actiontext" placeholder="" size="70">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>

                <div style="padding: 15px">
                    <label for="">Action URL</label>
                    <input style="color: #000;" type="text" name="actionURL" placeholder="" size="70">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>

                <div style="padding: 15px">
                    <label for="">End Part</label>
                    <input style="color: #000;" type="text" name="endpart" placeholder="" size="70">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror  
                </div>

                <div style="padding: 15px">
                <input style="padding: 10px 20px 10px 20px;" type="submit" class="btn btn-success">
              </div>

            </form>  
            
        </div>
    <!-- container-scroller -->

      </div>
    <!-- plugins:js -->
    @include('admin.scripts')
    <!-- End custom js for this page -->
  </body>
</html>
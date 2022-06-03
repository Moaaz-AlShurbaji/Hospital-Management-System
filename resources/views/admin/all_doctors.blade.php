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
          
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Room</th>
                    <th scope="col">Image</th>
                    <th scope="col">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                        <th scope="row">{{ $doctor->id }}</th>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->phone }}</td>
                        <td>{{ $doctor->speciality }}</td>
                        <td>{{ $doctor->room }}</td>
                        <td><img width="200" src="doctor_image/{{ $doctor->image }}" alt=""></td>
                        <td><a class="btn btn-success" href="{{ route('update_doctor', $doctor->id) }}">Update</a>
                        <a class="btn btn-danger" onclick="return confirm('Are You Sure You want to delete this doctor ?')" href="{{ route('delete_doctor', $doctor->id) }}">Delete</a>
                        </td>
                        </tr>   
                    @endforeach
                    
                    
                    
                </tbody>
            </table>
        </div>
    <!-- container-scroller -->

      </div>
    <!-- plugins:js -->
    @include('admin.scripts')
    <!-- End custom js for this page -->
  </body>
</html>
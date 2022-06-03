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
                    <th scope="col">Customer Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                        <th scope="row">{{ $appointment->id }}</th>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->doctor }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->status }}</td>
                        @if ($appointment->status == 'Approved')
                          <td><a class="btn btn-success disabled" href="{{ route('approve', $appointment->id) }}">Approve</a>
                          <a class="btn btn-danger" href="{{ route('cancel', $appointment->id) }}">Cancel</a>
                          <a class="btn btn-primary" href="{{ route('Email_view', $appointment->id) }}">Send Mail</a>
                          </td>
                        @elseif ($appointment->status == 'Canceled')  
                          <td><a class="btn btn-success" href="{{ route('approve', $appointment->id) }}">Approve</a>
                            <a class="btn btn-danger disabled" onclick="return confirm('Are You Sure You want to cancel this appointment ?')" href="{{ route('cancel', $appointment->id) }}">Cancel</a>
                            <a class="btn btn-primary" href="{{ route('Email_view', $appointment->id) }}">Send Mail</a>
                          </td>
                        @else
                          <td><a class="btn btn-success" href="{{ route('approve', $appointment->id) }}">Approve</a>
                          <a class="btn btn-danger" onclick="return confirm('Are You Sure You want to cancel this appointment ?')" href="{{ route('cancel', $appointment->id) }}">Cancel</a>
                          <a class="btn btn-primary" href="{{ route('Email_view', $appointment->id) }}">Send Mail</a>
                          </td>
                        @endif




                        
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
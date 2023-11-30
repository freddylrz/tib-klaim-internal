@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-fluid">
    
  <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Workshop Management</b> show</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Workshop Management show</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
      <div class="card card-primary card-outline">
        <form role="GET" method="GET" id="idws" enctype="multipart/form-data">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" style="border-right: 1px solid #ddd;">

                <div class="form-group">
                  <label>Name</label>
                  <p id="nama"></p>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <p id="address"></p>
                </div>

                <div class="form-group">
                  <label>Post Code</label>
                  <p id="postcode"></p>
                </div>

                <div class="form-group">
                  <label>Phone</label>
                  <p id="phone_no"></p>
                </div>
              </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label>Fax Number</label>
                  <p id="fax_no"></p>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <p id="email"></p>
                </div>

                <div class="form-group">
                  <label>NPWP</label>
                  <p id="npwp"></p>
                </div>
                <!-- <hr> -->
              
                <div class="form-group">
                  <label>PIC</label>
                  <p id="pic"></p>
                </div>

                <div class="form-group">
                  <label>PIC Phone</label>
                  <p id="pic_no"></p>
                </div>

                <div class="form-group ">
                  <label>PIC Email</label>
                  <p id="pic_email"></p>
                </div>
              </div>
              
            </div>
          </div>
          <input type="hidden" id="inws" value="{{ request()->idws }}">
        </form>
        <div class="card-footer">
           <div class="card-footer" style="text-align: right;">
       <a href="/utility/ws/update/{{ request()->idws }}">
      <button class="btn btn-primary"> Update </button>
        <a href="/utility/ws/list">
        <button class="btn btn-primary"> Back </button>
        </a>
      </div>
        </div>
      </div> 
     </div>
</div>
@endsection

@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
     <script src ="{{ asset('storage/utility/workshop.js') }}"> </script>
     <script>
     $(function() { 
  
       getwsDetail()
	});
</script>
@endpush
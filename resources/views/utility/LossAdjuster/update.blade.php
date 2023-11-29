@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-fluid">
    
  <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Loss Adjuster Management</b> Input</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Loss Adjuster Management Input</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
      <div class="card card-primary card-outline">
        <form role="post" method="post" id="Updatelar" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" id="idlar" name="lossAdjId" value="{{ request()->idlar }}">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" style="border-right: 1px solid #ddd;">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label>Post Code</label>
                  <input type="text" class="form-control" id="post_code" name="post_code" >
                </div>

                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="phone_no" name="phone_no" >
                </div>
                <div class="form-group">
                  <label>Fax Number</label>
                  <input type="text" class="form-control" id="fax_no" name="fax_no" >
                </div>
              </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" id="email" name="email" >
                </div>

                <div class="form-group">
                  <label>NPWP</label>
                  <input type="text" class="form-control" id="npwp" name="npwp" >
                </div>
                
                <div class="form-group">
                  <label >PIC </label>
                  <input type="text" class="form-control" id="pic" name="pic" >
                </div>

                <div class="form-group">
                  <label >PIC Phone</label>
                  <input type="text" class="form-control" id="pic_no" name="pic_no" >
                </div>

                <div class="form-group ">
                  <label>PIC Email</label>
                  <input type="text" class="form-control" id="pic_email" name="pic_email" >
                </div>
              </div>
              
            </div>
          </div>
          <input type="submit" id="SavelarUpdate" style="display: none;">
        </form>
        <div class="card-footer">
          <button class="btn btn-primary float-right" onclick="SavelarUpdate()"><i class="fas fa-save"></i> Save</button>
        </div>
      </div> 
     </div>

</div>
  @endsection
   @push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src ="{{ asset('storage/utility/lossAdjuster.js') }}"> </script>
     <script>
        $(function() {
         getlarUpdate()
        });
    </script>
@endpush
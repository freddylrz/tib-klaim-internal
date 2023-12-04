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
        <form role="post" method="post" id="inlar" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" style="border-right: 1px solid #ddd;">

                <div class="form-group">
                  <label for="insured_name" >Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="name" required="true"
                </div>

                <div class="form-group">
                    <label for="interest_insured">Address <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3" required="true"></textarea>
                </div>

                <div class="form-group">
                  <label for="insured_name">Post Code <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="post_code" name="post_code" placeholder="Post Code" required="true">
                </div>

                 <div class="form-group">
                  <label for="insured_name">Fax Number</label>
                  <input type="text" class="form-control" id="fax_no" name="fax_no" placeholder="Fax Number">
                </div>

                <div class="form-group">
                  <label for="insured_name">Phone <span style="color: red;">*</span></label>
                  <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Phone" required="true">
                </div>
              </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="insured_name">Email <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">NPWP <span style="color: red;">*</span></label>
                  <input type="number" class="form-control" id="npwp" name="npwp" placeholder="NPWP" required="true">
                </div>
                <!-- <hr> -->
              
                <div class="form-group">
                  <label for="insured_name">PIC <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">PIC Phone <span style="color: red;">*</span></label>
                  <input type="tel" class="form-control" id="pic_no" name="pic_no" placeholder="PIC Phone" required="true">
                </div>

                <div class="form-group ">
                  <label for="insured_name">PIC Email <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" id="pic_email" name="pic_email" placeholder="PIC Email" required="true">
                </div>
              </div>
              
            </div>
          </div>
          <input type="submit" id="saveAlllar" style="display: none;">
       
        <div class="card-footer">
         <em>note: tanda <strong>(<span style="color: red;">*</span>)</strong> wajib di isi</em>
          <button class="btn btn-primary float-right"  type="submit"><i class="fas fa-edit"></i> Save</button>
        </div>
         </form>
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
     <script src ="{{ asset('storage/utility/lossAdjuster.js') }}"> </script>
     <script>
     $(function() { 
     $('#inlar').on('submit', async function(e) {
        e.preventDefault()

       saveAlllar()
	});
})
  </script>
@endpush
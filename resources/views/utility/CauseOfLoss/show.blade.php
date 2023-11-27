@extends('layouts.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Cause Of Loss Management</b> Detail</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Cause of Loss Management Detail</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-body">

        <div class="row">
                        <div class="col-md-6">
                <div class="form-group">
                  <label>COB/Type Of Cover</label>
                  <!--  -->
                 <p id="toccfl"></p>
                  <!--  -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="interest_insured">TC description </label>
                    <p id="desccfl"></p>
            </div>
            <input type="hidden" id="idcfl" value="{{ request()->idcfl }}">
          </div>
        </div>
      </div>

       <a href="/utility/cfl/list">
      <div class="card-footer" style="text-align: right;">
        <button class="btn btn-primary"> Back </button>
        </a>
      </div>
    </div>
  </div>
  <!-- /.box -->
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
    <script src ="{{ asset('storage/utility/causedOfloss.js') }}"> </script>
    <script>
        $(function() {
          getDetail()
        });
    </script>
@endpush
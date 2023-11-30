@extends('layouts.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1 class="m-0"><b>Cause of Loss Management</b> Edit</h1>
	  </div><!-- /.col -->
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="/">Home</a></li>
			<li class="breadcrumb-item active">Cause of Loss Management Edit</li>
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
			<form role="post" method="post" id="Updatecfl" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Type Of Cover</label>
                <div class="select2-purple">
                  <select class="form-control select2bs4 filter" name="cobId" id="cobid"required>
                       
                    </select>
                  <input type="hidden" id="idcfl" name="causedId" value="{{ request()->idcfl }}">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Description</label>
                <input class="form-control" rows="6" style="width: 100%;" id="description" name="description" required></input>
              </div>
            </div>
          </div>
        </div>
        <input type="submit" id="saveBtn" style="display: none;">
              </form>
      <div class="card-footer">
      <a href="/utility/cfl/list">
        <button class="btn btn-primary float-right " style="margin-left:5px"> Back </button>
        </a>
       	<button class="btn btn-primary float-right" onclick="SaveUpdate()"><i class="fas fa-edit"></i> Save Update</button>
      </div>
      
		</div>
	</div>
</div>
  <!-- /.box -->
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
    <script src ="{{ asset('storage/utility/causedOfloss.js') }}"> </script>
     <script>
        $(function() {
           $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
          getDataAsset()
          getUpdate()
        });
    </script>
@endpush

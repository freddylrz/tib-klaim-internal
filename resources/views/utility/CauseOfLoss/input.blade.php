@extends('layouts.app')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Cause of Loss Management</b> Input</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Cause of Loss Management Input</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card-body">
        <div class="card card-primary card-outline">
          <form role="form">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleDropdown">Select an option <span style="color: red;">*</span></label>
                    <select class="form-control" id="exampleDropdown"required>
                       <option value="">pilih opsi </option>
                      <option value="option1">Option 1</option>
                      <option value="option2">Option 2</option>
                      <option value="option3">Option 3</option>
                    </select>
                    <!-- <small class="text-muted">Please select an option from the dropdown.</small> -->
                    <br>
                   <br>
                    <br>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleTextarea">Textarea</label>
                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Enter text"></textarea>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
            <em style="text-align: left;">note: tanda<strong> (<span style="color: red;">*</span>) </strong> wajib diisi</em>
              <button class="btn btn-primary float-right"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true
            });
        });
    </script>
@endpush
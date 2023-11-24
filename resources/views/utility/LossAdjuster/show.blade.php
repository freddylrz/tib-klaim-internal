@extends('layouts.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>Loss Adjuster Management</b> Detail</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Loss Adjuster Management Detail</li>
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
                  <input class="form-control" id="" type="text" placeholder="" readonly>
                  <!--  -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="interest_insured">TC description </label>
                    <textarea class="form-control" rows="6" style="width: 100%;" id="description" name="description" readonly></textarea>
            </div>
          </div>
        </div>
      </div>

       <a href="/utility/lar/list">
      <div class="card-footer" style="text-align: right;">
        <button class="btn btn-primary"> Back </button>
        </a>
      </div>
    </div>
  </div>
  <!-- /.box -->
</div>



  
  @endsection
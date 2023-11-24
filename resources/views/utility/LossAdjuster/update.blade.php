@extends('layouts.app')
@section('content')
<div class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1 class="m-0"><b>Loss Adjuster Management</b> Edit</h1>
	  </div><!-- /.col -->
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="/">Home</a></li>
			<li class="breadcrumb-item active">Loss Adjuster Management Edit</li>
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
			<form role="post" method="post" id="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="mefGNcxoeibe38qw0GOYMIUKubBhyCXcRxHG11cd">
                <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>COB/Type Of Cover</label>
                <div class="select2-purple">
                  <select class="select2"   style="width: 100%;" ">
                    <option selected disabled style=" margin-top: -7px;">Select a State</option>
                                            
            </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>TC description </label>
                <textarea class="form-control" rows="6" style="width: 100%;" id="description" name="description" required>THEFT</textarea>
              </div>
            </div>
          </div>
        </div>
        <input type="text" value="1" id="clmId" style="display: none;">
        <input type="submit" id="saveBtn" style="display: none;">
              </form>
      <div class="card-footer" style="text-align: right;">
       	<button class="btn btn-primary" onclick="$('#saveBtn').click();"><i class="fas fa-edit"></i> Save Update</button>
      </div>
      
		</div>
	</div>
</div>
  <!-- /.box -->
  @endsection
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
        <div class="card">
          <form role="form">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleDropdown">Select an option <span style="color: red;">*</span></label>
                    <select class="form-control" id="exampleDropdown">
                      <option value="option1">Option 1</option>
                      <option value="option2">Option 2</option>
                      <option value="option3">Option 3</option>
                    </select>
                    <!-- <small class="text-muted">Please select an option from the dropdown.</small> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" style="padding-right: 5px;">
                    <label for="exampleTextarea">Textarea <span style="color: red; ">*</span></label>
                    <textarea class="form-control" id="exampleTextarea" rows="5" placeholder="Enter text"></textarea>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer" style="text-align: right;">
              <button class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

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
      <div class="card">
        <form role="post" method="post" id="form" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="bE6ymmcfhZbvzxhHm8lk6or5L9Vx81ocaT8voczb">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" style="border-right: 1px solid #ddd;">

                <div class="form-group">
                  <label for="insured_name" >Name <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="name" required="true">
                </div>

                <div class="form-group">
                    <label for="interest_insured">Address <span style="color: red;">*</span></label>
                    <textarea class="form-control" id="address" name="address" placeholder="Address" rows="3" required="true"></textarea>
                </div>

                <div class="form-group">
                  <label for="insured_name">Post Code <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">Phone <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Phone" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">Email <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">NPWP <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP" required="true">
                </div>
                <!-- <hr> -->
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="insured_name">PIC <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="pic" name="pic" placeholder="PIC" required="true">
                </div>

                <div class="form-group">
                  <label for="insured_name">PIC Phone <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="pic_no" name="pic_no" placeholder="PIC Phone" required="true">
                </div>

                <div class="form-group ">
                  <label for="insured_name">PIC Email <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="pic_email" name="pic_email" placeholder="PIC Email" required="true">
                </div>
                 <hr>
                  <em>note: tanda<strong> (bintang merah wajib di isi) </strong>wajib diisi</em>
              </div>
               <hr>
              
            </div>
          </div>
          <input type="submit" id="saveBtn" style="display: none;">
        </form>
        <div class="card-footer" style="text-align: right;">
          <button class="btn btn-primary" onclick="$('#saveBtn').click();"><i class="fas fa-save"></i> Save</button>
        </div>
      </div> 
     </div>

</div>
@endsection
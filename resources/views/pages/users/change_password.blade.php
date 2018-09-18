
@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"  style="color:#00318D;font-weight: 600"><i class="fas fa-unlock-alt" style="color:#00c0ef"></i> CHANGE PASSWORD</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                 <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
    
   {{--  <div>
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div> --}}
</div>
 <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<hr>
<div class="row" style="margin-top:50px">
      <div class="col-md-12">
        @include('errors.with_error')
        @include('errors.success')
    </div>

  <div class="col-md-1"></div>
    <div class="col-md-6">
        {!! Form::open(array('method'=>'PATCH','name'=>'change_password','id'=>'change_password','action' => array('PasswordController@update', $user->id) )) !!}

        <div class="col-md-9">             
    <label for="current-password" class="col-sm-4 control-label">Current Password <span style="color:red">*</span></strong></label>
    <div class="col-sm-8">
      <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
        <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Current Password">
      </div>
    </div>
    <label for="password" class="col-sm-4 control-label">New Password <span style="color:red">*</span></strong></label>
    <div class="col-sm-8">
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
      </div>
    </div>
    <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password <span style="color:red">*</span></strong></label>
    <div class="col-sm-8">
      <div class="form-group">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-7 col-sm-3">
        <button class="btn btn-info" onClick="return confirm('Confirm Changing Password?')"><i class="fa fa-floppy-o"></i> Save</button>
    </div>
  </div>




        {!! Form::close() !!}

    </div>
@endsection

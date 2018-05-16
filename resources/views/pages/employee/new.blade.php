@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">New Employee</h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('sl')}}">SL</a></li>
                <li class="breadcrumb-item active">New</li>
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
<div class="row">
          <div class="col-md-12">
            @include('errors.with_error')
            @include('errors.success')
        </div>

    <div class="col-md-12">
        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">Employee Info</h4>
                            </div>
                            <div class="card-body">
                            {!! Form::open(array('name'=>'add_employee','id'=>'add_employee','files'=>true,'action'=>'EmployeeController@store')) !!}
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Emp ID. No. <span style="color:red">*</span></label>
                                                    <input type="text" onkeyup="home_employee_search();" id="empidnum" name="empidnum" class="form-control" value="{{old('empidnum')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Name <span style="color:red">*</span></label>
                                                    <input type="text" id="name" name="name" class="form-control"  value="{{old('name')}}">
                                                </div>
                                            </div>
                                            <!--/span-->
                                       
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Company <span style="color:red">*</span></label>
                                                    <select class="form-control custom-select" id="company" name="company">
                                                        <option value="">-- Please Select --</option>
                                                        <option value="skylogistics" style="color:red;font-weight: 500">SkyLogistics Philippines Inc</option>
                                                        <option value="skykitchen" style="color:#7f29ad;font-weight: 500">SkyKitchen Philippines Inc</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->


                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Department </label>
                                                    <input type="text" id="department" name="department" value="{{old('department')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-groupr">
                                                    <label class="control-label">Division </label>
                                                    <input type="text" id="division" name="division" value="{{old('division')}}" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Shift</label>
                                                    <input type="text" id="shift" name="shift" value="{{old('shift')}}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-groupr">
                                                    <label class="control-label">Day-Off</label>
                                                    <input type="text" id="dayoff" name="dayoff" value="{{old('dayoff')}}" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            </div>
                                        <!--/row-->

                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" onclick="return confirm('Are you sure you want to add this Employee?')" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
    </div>
    
</div><!--R O W -->
@endsection



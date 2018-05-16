@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">New Sick Leave</h3>
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
        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">SL Form</h4>
                            </div>
                            <div class="card-body">
                                <form action="#">
                                    <div class="form-body">
                                        <h3 class="card-title">Employee Info</h3>
                                        <hr>

                                        <div class="row p-t-20">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Emp ID. No. <span style="color:red">*</span></label>
                                                    <input type="text" id="empidnum" name="empidnum" onkeyup="home_employee_search();" class="form-control" placeholder="Type emp id to search...">

                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                  <label class="control-label">&nbsp;</label>
                                                <button type="button" class="btn btn-danger btn-sm" style="display:none" id="employeefound" data-toggle="modal" data-target="#myModal">Employee Found</button>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Name <span style="color:red">*</span></label>
                                                    <input type="text" id="name" onkeyup="home_employee_search_by_name()" name="name" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                       
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Company <span style="color:red">*</span></label>
                                                    <select class="form-control custom-select" id="company" name="company">
                                                        <option value="">-- Please Select --</option>
                                                        <option  style="color:red;font-weight: 500">Skylogistics</option>
                                                        <option style="color:#7f29ad;font-weight: 500">Skykitchen</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/row-->


                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Department</label>
                                                    <input type="text" id="department" name="department" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-groupr">
                                                    <label class="control-label">Division</label>
                                                    <input type="text" id="division" name="division" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->

                                        <div class="row p-t-5">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Shift</label>
                                                    <input type="text" id="shift" name="shift" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-groupr">
                                                    <label class="control-label">Day-Off</label>
                                                    <input type="text" id="dayoff" name="dayoff" class="form-control form-control-danger" placeholder="">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            </div>
                                        <!--/row-->

                            <h3 class="card-title">Sick Leave Details</h3>
                                        <hr>
                                        <div class="row p-t-5">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">From <span style="color:red">*</span></label>
                                                    <input type="date" class="form-control" placeholder="Y-m-d" value="{{date('Y-m-d')}}" >
                                                    {{-- <input type="text" name="date_discovered" class="form-control" placeholder="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" id="date_discovered"> --}}

                                                 </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">To<span style="color:red">*</span></label>
                                                    <input type="date" class="form-control" placeholder="Y-m-d" value="{{date('Y-m-d')}}" >
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">No. of Days<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" value="" >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <label  class="control-label">Reason<span style="color:red">*</span></label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <label  class="control-label">Remarks</label>
                                                        <textarea class="form-control" rows="5"></textarea>
                                                    </div>
                                            </div>

                                        </div>
                                        <!--/row-->
                                        
<hr>


                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

      
    </div>
    
</div><!--R O W -->
@endsection

@section('js')

<script type="text/javascript">

    function home_employee_search()
    {
        $empidnum = $("#empidnum").val();

        $.ajax({
            type: "GET",
            url: "../sl/home_employee_search",
            data: {empidnum: $empidnum,},
             dataType: 'json',
             success: function(data) {
                // $('#referral').slideUp().slideDown();
                $("#name_1").val(data.name);
                $("#department_1").val(data.department);
                $("#division_1").val(data.division);
                $("#shift_1").val(data.shift);
                $("#dayoff_1").val(data.dayoff);
                $("#company_1").val(data.company);

                if(data.name != "")
                {
                    $("#employeefound").fadeIn();
                }else
                {
                   $("#employeefound").fadeOut(); 
                }
              
                // $("#medium_price").val(data.medium);
                // $("#large_price").val(data.large);
                
            },
        });
    }


    function home_employee_search_by_name()
    {
     
        $name = $("#name").val();

        if($name.length > 3)
        {
            $.ajax({
                type: "GET",
                url: "../sl/home_employee_search_by_name",
                data: {name: $name,},
                 dataType: 'json',
                 success: function(data) {
                    // $('#referral').slideUp().slideDown();
                    $("#name_1").val(data.name);
                    $("#department_1").val(data.department);
                    $("#division_1").val(data.division);
                    $("#shift_1").val(data.shift);
                    $("#dayoff_1").val(data.dayoff);
                    $("#company_1").val(data.company);

                    if(data.name != "")
                    {
                        $("#employeefound").fadeIn();
                    }else
                    {
                       $("#employeefound").fadeOut(); 
                    }
                  
                    // $("#medium_price").val(data.medium);
                    // $("#large_price").val(data.large);
                    
                },
            });

        }else
        {
             $("#employeefound").fadeOut(); 
        }
    }



    function useInfo()
    {
        $("#name").val( $("#name_1").val() );
        $("#department").val( $("#department_1").val() );
        $("#division").val( $("#division_1").val() );
        $("#shift").val( $("#shift_1").val() );
        $("#dayoff").val( $("#dayoff_1").val() ); 
        $("#company").val($("#company_1").val() );
    }
    
</script>
    
@endsection


@section('modal')
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Employee Found!</h4>
        </div>
        <div class="modal-body">
          <label class="control-label">Name</label>
          <input type="text" class="form-control" name="name_1" id='name_1'>

          <label class="control-label">Company</label>
          <input type="text" class="form-control" name="company_1" id='company_1'>

          <label class="control-label">Department</label>
          <input type="text" class="form-control" name="department_1" id='department_1'>

          <label class="control-label">Division</label>
          <input type="text" class="form-control" name="division_1" id='division_1'>

          <label class="control-label">Shift</label>
          <input type="text" class="form-control" name="shift_1" id='shift_1'>

          <label class="control-label">Day-Off</label>
          <input type="text" class="form-control" name="dayoff_1" id='dayoff_1'>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" onclick="useInfo()" data-dismiss="modal">Use Employee Details</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

@endsection



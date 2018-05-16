@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor" style="color:#1BA196"><strong>EMPLOYEE LISTS</strong></h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">List</li>
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
        
    <div class="col-md-1"></div>
    <div class="col-md-10">

            <table class="table color-bordered-table inverse-bordered-table">
                <thead>
                    <tr>
                       <th>ID Num</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Department</th>
                        <th>Division</th>
                        <th>Shift</th>
                        <th>Day-Off</th>
                        <th></th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{$employee->empidnum}}</td>
                            <td>{{ucwords($employee->name)}}</td>
                            <td>
                                @if($employee->company =="skylogistics")
                                <span style="color:red;font-weight: 500">SkyLogistics Philippines Inc</span>
                                @else
                                <span style="color:#7f29ad;font-weight: 500">SkyKitchen Philippines Inc</span>
                                @endif
                            </td>
                            <td>{{ucwords($employee->department)}}</td>
                            <td>{{ucwords($employee->division)}}</td>
                            <td>{{ucwords($employee->shift)}}</td>
                             <td>{{ucwords($employee->dayoff)}}</td>

                             

                             <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                     <div class="dropdown-menu animated flipInX" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                        <table class="dropdown-item">
                            <tr>
                                <td>
                                 {!! Form::open(['method'=>'GET', 'action' => ['EmployeeController@edit', $employee->id]]) !!}
                                    <button class="btn waves-effect btn-sm waves-light btn-info" title="Click to Edit {{ ucwords($employee->name)}}?">
                                    <i class="fas fa-edit fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>
                                <td>
                                {!! Form::open(['method'=>'DELETE', 'action' => ['EmployeeController@destroy', $employee->id]]) !!}
                                   <button class="btn waves-effect btn-sm  waves-light btn-danger" onclick="return confirm('Are you sure you want to delete {{ucwords($employee->name)}} ?')" title="Click to Delete{{ucwords($employee->name)}}?">
                                    <i class="fa fa-times fa-2x"></i>
                                   </button>
                                  {!! Form::close() !!}
                                </td>
                             </tr>
                       </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                                        </tbody>
                                    </table>
                                </div>

</div>
@endsection




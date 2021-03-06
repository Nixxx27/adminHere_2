@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 style="color:#d91f2a;font-weight:700"><i class="fas fa-map-marked-alt"></i> <i class="fas fa-map-marker-alt"></i> LOCATIONS </h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Location Lists</li>
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


    <div class="col-md-12" style="margin-bottom: 10px" ><button class="btn btn-danger" title="Add Location"  data-toggle="modal" data-target="#responsive-modal"><i class="fas fa-plus-square fa-2x"></i></button></div> 


   <div class="col-md-10">
    <div class="table-responsive">
            <table class="table color-bordered-table warning-bordered-table">
                <thead>
                    <tr>
                       <th>LOCATION</th>
                        <th>REMARKS</th>
                        <th></th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{strtoupper($location->location)}}</td>
                            <td>{{$location->remarks}}</td>
                            
                             <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                     <div class="dropdown-menu animated flipInX" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                        <table class="dropdown-item">
                            <tr>
                                <td>
                                 {!! Form::open(['method'=>'GET', 'action' => ['LocationController@edit', $location->id]]) !!}
                                    <button class="btn waves-effect btn-sm waves-light btn-info" title="Click to Edit {{ ucwords($location->location)}}?">
                                    <i class="fas fa-edit fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>
                                <td>
                                {!! Form::open(['method'=>'DELETE', 'action' => ['LocationController@destroy', $location->id]]) !!}
                                   <button class="btn waves-effect btn-sm  waves-light btn-danger" onclick="return confirm('Are you sure you want to delete {{ucwords($location->location)}} ?')" title="Click to Delete{{ucwords($location->location)}}?">
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

</div>
@endsection

@section('modal')

<!--ADD-->
 <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title">Add New Location</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           </div>
        
        <div class="modal-body">
        {!! Form::open(array('name'=>'add_location','id'=>'add_location','files'=>true,'action'=>'LocationController@store')) !!}
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Location Name: <span style="color:red;">*</span> </label>
                    <input type="text" class="form-control" id="location" name="location" value="{{old('location')}}">
                </div>
               <div class="form-group">
                    <label for="message-text" class="control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks">{{old('remarks')}}</textarea>
                 </div>
   
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            <button type="submit" onclick="return confirm('Are you sure you want to Add this Location?')" class="btn btn-danger waves-effect waves-light"><i class="fas fa-save"></i> Save</button>
        </div>
         {!! Form::close() !!}
        
        </div><!--modal-content-->
    
    </div>
</div><!--ADD-->


                            
                       
              

@endsection




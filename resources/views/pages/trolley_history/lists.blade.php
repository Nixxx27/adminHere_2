@extends('layouts.app_template')
@section('css')
<style type="text/css">
  tbody
  {
    font-size:12px;
  }
</style>

@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-7 align-self-center">
            <a href="{{url('trolleys')}}">
            <button type="button"  style="margin-bottom:10px" title="Back to Location Lists" class="btn  btn-warning"><i class="fas fa-chevron-circle-left"></i> Back</button> 
          </a>

            <h3 style="color:#d91f2a;font-weight:700"><i class="fas fa-map-marked-alt"></i> <span style="color:#00318D"><i class="fas fa-history"></i> VIEW HISTORY OF </span> <span style="font-size:110%;font-weight: 1000">TROLLEY # {{$trolley->tracking_number}} - {{ucwords($trolley->theTrackingSeries->location_description)}}</span> </h3>
        </div>

        <div class="col-md-5 align-self-center">
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


    <div class="col-md-12" style="margin-bottom: 10px" ><button class="btn btn-success" title="Export to Excel"><i class="fas fa-file-excel fa-2x"></i></button></div> 


   <div class="col-md-12">
    <div class="table-responsive">
             <table class="table color-bordered-table warning-bordered-table">
                <thead>
                    <tr>
                      <th>DATE & TIME</th>
                      {{-- <th>TRACKING NO.</th> --}}
                      <th>LOCATION</th>
                      <th>FLIGHT NO.</th>
                      <th>STATUS</th>
                      <th>REMARKS</th>
                      <th colspan="2"></th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>
                            {{$history->created_at->format('M d Y h:i A D')}}</td>
                            {{-- <td>{{strtoupper($history->theTrolley->tracking_number)}}</td> --}}
                            <td>{{strtoupper($history->theCurrentLocation->location)}}</td>
                            <td> - </td>
                            
                            <td>
                              @if($history->status == "forretain")
                                <i class="fas fa-check-circle fa-2x" style="color:green" title="Found in Right Location "></i>
                              @else
                                <span style="color:red;font-weight:bold">FOR RETURN</span>
                                  @if($history->status == "forreturn" AND $history->is_returned == 1)
                                  <i class="fas fa-check-circle" style="color:green" title="Trolley Returned! "></i>
                                  @endif

                              @endif
                            </td> 
                            
                            <td style="width:250px">@if($history->remarks)
                              <textarea style="background: #F4F6F9;border: 0px;font-size: 12px;" class="form-control">{{$history->remarks}}</textarea>
                              @endif
                             </td>
                            
                               <td >
                                @if($history->status == "forreturn" AND $history->is_returned == 0)

                                
                                 <button class="btn waves-effect btn-sm waves-light btn-success" title="Click if this Trolley is Returned to right Location "  data-toggle="modal" data-target="#responsive-modal{{$history->id}}">RETURN</button>


                                 <!--MODAL START-->
                                 <div id="responsive-modal{{$history->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                                <h4 class="modal-title">RETURN TROLLEY # <span style="color:#d10b0b;font-weight: bold">{{$trolley->tracking_number}}</span></h4>
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                           </div>
                                        
                                        <div class="modal-body">
                                         {{ Form::open(array('url' => 'trolleys/history/returntrolley/' . $history->id,'method' => 'POST','name' => 'returntrolley','id' => 'returntrolley')) }}

                                              <div class="form-group">
                                                <span style="font-weight: bold;color:#00318d">DATE & TIME :</span> <span style="font-weight: bold">{{$history->created_at->format('M d Y h:i A D')}}</span>
                                               </div>
                                                
                                               <div class="form-group">
                                                    <label for="returned_remarks" class="control-label">Add Remarks:</label>
                                                        <textarea class="form-control" id="returned_remarks" name="returned_remarks">{{old('returned_remarks')}}</textarea>
                                                 </div>
                                   
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" onclick="return confirm('Are you sure you want to Return this Trolley?')" class="btn btn-danger waves-effect waves-light"><i class="fas fa-save"></i> Save</button>
                                        </div>
                                         {!! Form::close() !!}
                                        
                                        </div><!--modal-content-->
                                    
                                    </div>
                                </div>     <!--MODAL END-->
                                @endif

                                 @if($history->status == "forreturn" AND $history->is_returned == 1)
                                  <br><span style="">Returned by {{ucwords($history->theReturnedBy->name)}} on {{$history->returned_date->format('M d Y h:i A D')}} <br> @if($history->returned_remarks) {{$history->returned_remarks}} @endif</span>
                                  @endif

                               </td>

                               <td style="padding-right:40px">
                              <button class="btn waves-effect btn- waves-light btn-info" title="Add Remarks"  data-toggle="modal" data-target="#addRemarks{{$history->id}}"><i class="fas fa-plus-square"></i> </button>
                         
                                 <!--MODAL START-->
                                 <div id="addRemarks{{$history->id}}" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                           <div class="modal-header">
                                                <h4 class="modal-title"> ADD REMARKS</h4>
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                           </div>
                                        
                                        <div class="modal-body">
                                         {{ Form::open(array('url' => 'trolleys/history/addremarks/' . $history->id,'method' => 'POST','name' => 'addremarks','id' => 'addremarks')) }}

                                               <div class="form-group">
                                         <textarea class="form-control" id="remarks" name="remarks">{{old('remarks')}}</textarea>
                                                 </div>
                                   
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" onclick="return confirm('Confirm Remarks?')" class="btn btn-danger waves-effect waves-light"><i class="fas fa-save"></i> Save</button>
                                        </div>
                                         {!! Form::close() !!}
                                        
                                        </div><!--modal-content-->
                                    
                                    </div>
                                </div>     <!--MODAL END-->


                            </td>
                           {{--   <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                     <div class="dropdown-menu animated flipInX" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                        <table class="dropdown-item">
                            <tr>
                                <td>
                                 {!! Form::open(['method'=>'GET', 'action' => ['TrolleyController@edit', $location->id]]) !!}
                                    <button class="btn waves-effect btn-sm waves-light btn-info" title="Click to Edit {{ ucwords($location->location)}}?">
                                    <i class="fas fa-edit fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>
                                
                             </tr>
                       </table>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>

                          

                    @endforeach

                                        </tbody>
                                    </table>
                                </div>
</div>
</div>
@endsection

@section('modal')


                            
                       
              

@endsection




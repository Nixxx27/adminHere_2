<?php  
use App\MyApp\NewClass;
$myclass = new NewClass();

?>
@extends('layouts.app_template')

@section('css')
<style type="text/css">
  .strikeThrough{
        text-decoration: line-through;
        text-decoration-color: red;
  }

  th
  {
    border:1px solid white !important;
    /*text-align:center !important;*/
    font-weight: bold !important;
  }


</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 style="color:#d91f2a;font-weight:700"><i class="fas fa-list-ol"></i> TROLLEYS </h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Trolleys</li>
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


    <div class="col-md-12" style="margin-bottom: 10px" ><button class="btn btn-danger btn-sm" title="Add Tracking number Series"  data-toggle="modal" data-target="#responsive-modal"><i class="fas fa-plus-square fa-2x"></i></button>

      <button class="btn btn-success btn-sm" title="Export to Excel"><i class="fas fa-file-excel fa-2x"></i></button>

       <button type="button" class="btn btn-warning btn-sm" title="Toggle Search" onclick="toggleSearch()" style="cursor:pointer"><i class="fas fa-search fa-2x"></i></button>



    </div> 
</div>
<div class="row" style="margin-bottom: 10px;display:none" id="search_div">
 
      <div class="col-md-10">
        <form class="app-search" style="display: block;">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search Tracking Number">
      
      </div>
      <div class="col-md-1">
            <button class="btn btn-info btn-sm" title="GO!"><i class="fas fa-chevron-circle-right fa-2x"></i></button>
          {{--   <button type="button" class="btn btn-warning btn-sm" title="Toggle Search" onclick="toggleSearch()" style="cursor:pointer"><i class="fas fa-search fa-2x"></i></button> --}}
      </div>
      </form>

</div>
<div class="row">
   <div class="col-md-11">
    <div class="table-responsive">
        <table class="table color-bordered-table warning-bordered-table">
                <thead>
                    <tr>
                      <th>TRACKING NO.</th>
                      <th>AREA</th>
                      <th>LOCATION</th>
                      <th>FLIGHT NO</th>
                      <th>REMARKS</th>
                      <th style="background:#e5b438">CURRENT LOC.</th>
                       <th style="background:#e5b438">STATUS</th>
                      <th style="background:#e5b438"></th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($trolleys as $trolley)
                        <tr>
                            <td>{{$trolley->tracking_number}}</td>
                            
                              @if($trolley->user_defined_location_id)
                                <td>{{strtoupper($trolley->theUserDefinedLocation->theLocation->location)}}</td>
                                <td>{{strtoupper($trolley->theUserDefinedLocation->location_description)}}</td>
                              @elseif ($trolley->tracking_series_id)
                                <td>{{strtoupper($trolley->theTrackingSeries->theLocation->location)}}</td>
                                <td>{{strtoupper($trolley->theTrackingSeries->location_description)}}</td>
                              @endif
                            
                            <td></td>
                            <td>{{$trolley->remarks}}</td>

                            <?php $trolleyCurrentLocation = $myclass->trolleyLastHistory($trolley->id); ?>
                              @if(!empty($trolleyCurrentLocation)) 
                                <td>{{strtoupper($trolleyCurrentLocation->theCurrentLocation->location)}}</td>
                                <td> @if($trolleyCurrentLocation->status == "forretain")
                                      <i class="fas fa-check-circle" style="color:green" title="Found in Right Location "></i>
                                    @else
                                      
                                        @if($trolleyCurrentLocation->status == "forreturn" AND $trolleyCurrentLocation->is_returned == 1)
                                          <i class="fas fa-check-circle" style="color:green" title="Returned in Right Location "></i>
                                        @else
                                          <span style="color:#d10b0b;font-size:12px;font-weight: bold">FOR RETURN</span>
                                        @endif

                                    @endif
                            </td>
                              @else
                                 <td></td>
                                 <td></td>
                              @endif

                           
                             <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </button>
                                     <div class="dropdown-menu animated flipInX" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    
                        <table class="dropdown-item">
                            <tr>
                               <td>
                                 {{ Form::open(array('url' => '/trolleys/history/' . $trolley->id,'method' => 'GET','name' => 'trolleyHistoryForm','id' => 'trolleyHistoryForm')) }}
                                    <button class="btn waves-effect btn-xs waves-light btn-info" title="Show History of Trolley # {{ ucwords($trolley->tracking_number)}}?">
                                    <i class="fas fa-history fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>

                                <td>
                                 {!! Form::open(['method'=>'GET', 'action' => ['TrolleysController@edit', $trolley->id]]) !!}
                                    <button class="btn waves-effect btn-xs waves-light btn-primary" title="Click to Edit Trolley # {{ ucwords($trolley->tracking_number)}}?">
                                    <i class="fas fa-edit fa-2x"></i>
                                    </button>
                                {!! Form::close() !!}
                                </td>
                                <td>
                                {!! Form::open(['method'=>'DELETE', 'action' => ['TrolleysController@destroy', $trolley->id]]) !!}
                                   <button class="btn waves-effect btn-xs  waves-light btn-danger" onclick="return confirm('Are you sure you want to delete Trolley # {{ucwords($trolley->tracking_number)}} ?')" title="Click to Delete Trolley # {{ucwords($trolley->tracking_number)}}?">
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



<div class="col-md-3"></div><div class="col-md-6 col-sm-12" style="margin-bottom:10px">
    {!! $trolleys->appends(['search' => Input::get('search') ])->render() !!}
</div>


</div>
@endsection

@section('modal')

<!--ADD-->
 <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <h4 class="modal-title">Add New Trolley</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           </div>
        
        <div class="modal-body">
        {!! Form::open(array('name'=>'add_trolley','id'=>'add_trolley','files'=>true,'action'=>'TrolleysController@store')) !!}
                

                <div class="form-group">
                    <label for="tracking_number" class="control-label">Tracking Number : <span style="color:red;">*</span></label>
                      <input type="text" required="required"  class="form-control" onkeyup="seriesNum()" id="tracking_number" name="tracking_number" value="{{old('tracking_number')}}">
                </div>

                <div class="form-group">
                    <label for="" class="control-label">Location : <span style="color:red;">*</span></label>
                      <span id="auto_location_label" class=""></span>
                      <input type="hidden" id="tracking_series_id" name="tracking_series_id" value="{{old('auto_location_text')}}">
                </div>

                <div class="form-group">
                    <label for="user_defined_location_id" class="control-label">or Specified a Location : </label>
                    <select name="user_defined_location_id" onchange="userDefinedLocation();" id="user_defined_location_id" class="form-control">
                      <option value="">--Please Select--</option>
                      @foreach($series as $series)
                        <option value="{{$series->id}}">{{strtoupper($series->location_description)}}</option>
                      @endforeach
                    </select>
                </div>


                  <div class="form-group">
                    <label for="remarks" class="control-label">Remarks:</label>
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

@section('js')

<script type="text/javascript">
  function seriesNum()
  {
    var trackingNumber =$("#tracking_number").val();
    var trackingNumberLength = trackingNumber.length;
      if(trackingNumberLength >=7)
      {

          $.ajax({
          type:'GET',
          url:"./trolleys/trackingseries",
          // dataType: 'json',
          data: {trackingNumber:trackingNumber},
          success:function(data){
            $("#auto_location_label").text(data.location_description);
            $("#tracking_series_id").val(data.id);
            // console.log(data);
          },
          error : function() {
              console.log('error');
                  }       
          });

      }else{
             $("#auto_location_label").text("");
            $("#tracking_series_id").val("");
      }

   }

    function userDefinedLocation()
    {
      if($("#user_defined_location_id").val() == "")
      {
        $("#auto_location_label").removeClass("strikeThrough");
      }else{
        $("#auto_location_label").addClass("strikeThrough");
      }
      console.log($("#user_defined_location_id").val())
    }

    function toggleSearch()
    {

      $("#search_div").slideToggle();
    }
</script>
@endsection




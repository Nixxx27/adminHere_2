@extends('layouts.app_template')

@section('css')

<style type="text/css">
   .spanStyle
   {
    font-family: 'century gothic';
    font-size:18px;
    font-weight:bold;
   }
</style>
@endsection

@section('content')
 
<div class="row" style="margin-top:10px">
    <div class="col-md-4">
            @include('errors.with_error')
            @include('errors.success')
        </div>
</div>

<div class="row">
 <div class="col-md-6" >
  <div class="card" style="border:4px double #4d4d4d">
  <div class="card-header"  style="background:#4D4D4D;color:white;font-weight: bold">
    BARCODE : TROLLEY TRACKING NUMBER | @if($user->theLocation)<SPAN onclick="update_user_status()"  title="Your Location is in {{$user->theLocation->location}} Click to Change" style="color:#ffa739;margin-left:10px;cursor:pointer"><i class="fas fa-map-marker-alt"></i> <span style="text-decoration: underline;font-size:18px">{{$user->theLocation->location}}</span></SPAN>@else <SPAN onclick="update_user_status()" style="color:#ffa739;margin-left:10px;cursor:pointer"><i class="fas fa-map-marker-alt"></i> PLEASE SELECT YOUR LOCATION </span> @endif
{{--     <i class="fas fa-exchange-alt fa-2x" onclick="update_user_status()" title="Change Your Location" style="margin-left:20px;color:#ffa739;cursor:pointer"></i> --}}
    <div id="app">
       @{{name}}
    </div>

        <div id="update_user_status" style="display:none">
             {{ Form::open(array('url' => '/updateuserlocation/','method' => 'POST','name' => 'updateuserlocation','id' => 'updateuserlocation')) }}
        <table>
            <tr>
                <td> <label>Change Your Location : </label></td>
                <td> <select class="form-control" name="location_id" id="location_id" style="border-top:0px;border-left:0px;border-right:0px;border-bottom:2px solid red;font-weight:bold">

                @if($user->location_id)
                   <option style="font-weight:bold" value="{{$user->location_id}}">{{$user->theLocation->location}}</option>
                @else
                    <option value="">--Select--</option>
                @endif
                @foreach($locations as $location)
                    <option style="font-weight:bold" value="{{$location->id}}">{{$location->location}}</option>
                @endforeach
            </select></td>
            <td><button onclick="return confirm('Are you sure you want to Change your Location?')" class="btn btn-warning btn-sm" style="margin-left:20px"><i class="fas fa-chevron-circle-right"></i></button></td>
            </tr>
        </table>
       
      {!! Form::close() !!}
        </div><!--update_user_status-->

  </div><!--header-->
  <div class="card-body">
    <input type="text" class="form-control" id="tracking_number" onkeyup="trackingNumberDetails()"  autofocus="" autocomplete="off" style="height:80px !important;font-size:40px;font-weight: bold;color:#ffa433!important;background:black!important" placeholder="Tracking #..." name="tracking_number">
    {{-- <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a> --}}

     <div id="error_details" style="margin-top:10px;display:none">
        <span style="color:red;font-weight:bold;">Tracking Number Cannot be Found!</span>
     </div>

    <div id="tracking_details" style="margin-top:10px;display:none">

         <table class="table">
             <tr>
                <td style="width:150px">Trolley No</td>
                <td align="left"><span id="trolleyNum" class="spanStyle"></span> 
                </td>
             </tr>
             <tr>
                <td style="width:150px">Location</td>
                <td align="left"><span id="trolleyLocation" class="spanStyle"></span> 
                </td>
             </tr>

             <tr>
                <td style="width:150px">Status</td>
                <td><span id="locationStatus" class="spanStyle"></span></td>
             </tr>
{{ Form::open(array('url' => '/addtrolleyhistory/','method' => 'POST','name' => 'addTrolleyToHistory','id' => 'addTrolleyToHistory')) }}
            <tr>
                <td style="width:150px">Add Remarks</td>
                <td><textarea class="form-control" style="border:1px solid black" name="remarks" id="remarks"></textarea>
                </td>
             </tr>
             <tr>
                 <td colspan="2" align="center">
                       
                    <input type="hidden" placeholder="trolley_ml_id" name="trolley_ml_id" id="submit_trolley_ml_id">
                    <input type="hidden" placeholder="user_current_location_id" name="user_current_location_id" id="submit_user_current_location_id">
                    <input type="hidden" placeholder="status" name="status" id="submit_status">

                    <button class="btn btn-info btn-lg text-center" onclick="return confirm('Confirm Trolley Details?')">SUBMIT</button>

                      
                 </td>
             </tr>
    {!! Form::close() !!}
         </table>
    </div><!--tracking_details-->
  </div><!--card body-->
</div>
      
    </div><!--div 6-->
</div>
@endsection

@section('js')
<script type="text/javascript">
  function trackingNumberDetails()
  {
    var trackingNumber =$("#tracking_number").val();
    trackingNumber=  trackingNumber.replace(/ /g,'');
    console.log(trackingNumber +  " " + trackingNumber.length)
    var trackingNumberLength = trackingNumber.length;
      if(trackingNumberLength >= 7)
      {

          $.ajax({
          type:'GET',
          url:"./barcode/trolleydetails",
          dataType: 'json',
          data: {trackingNumber:trackingNumber},
          success:function(data){
            if(data.trolleyCount==1)
            {
                // var trolleyNum = trackingNumber;
                var trolleyArea = data.trolleyArea;
                var trolleyLocation = data.trolleyLocation;
                var userLocation = data.userLocation;
                
                $("#trolleyNum").text(trackingNumber);
                $("#trolleyLocation").text(trolleyLocation);
                // console.log(trolleyArea + " = " + userLocation);

                $("#submit_trolley_ml_id").val(data.trolleyId);
                $("#submit_user_current_location_id").val(data.userLocationId);

                if(trolleyArea == userLocation)
                {
                    $("#locationStatus").html('RIGHT LOCATION <i class="fas fa-check-circle fa-2x" style="color:green"></i>')
                    $("#submit_status").val("forretain");
                }else
                {
                   $("#locationStatus").html('FOR RETURN TO ' + trolleyArea + ' <i class="fas fa-times-circle fa-2x" style="color:red"></i>')
                    $("#submit_status").val("forreturn");
                
                }

                $("#error_details").slideUp();
                $("#tracking_details").slideDown();
            }else if(data.trolleyCount==0)
            {
                $("#tracking_details").slideUp();
                $("#error_details").slideDown();
            }
           

           // console.log(data.trolleyCount);
          },
          error : function() {
                console.log('error');
                }       
          });

      }else{
            $("#trolleyLocation").text("");
            $("#tracking_details").slideUp();
            $("#error_details").slideUp();
            // $("#tracking_series_id").val("");
      }

   }


   function update_user_status()
   {
    $("#update_user_status").slideToggle();
   }
</script>



@endsection
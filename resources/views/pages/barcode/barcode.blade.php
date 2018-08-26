@extends('layouts.app_template')

@section('css')

<style type="text/css">
::placeholder {
    color: white !important;
    opacity: 1  !important;; /* Firefox */
}


   .spanStyle
   {
    font-family: 'century gothic';
    font-size:18px;
    font-weight:bold;
   }

   .fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }


  .inputDefaultStyle
  {
    height:80px !important;
    font-size:40px !important;
    font-weight: bold !important;
    color:#ffa433!important;
    background:black!important;
  }

  .inputDefaultStyle::placeholder
  {
        color: #ffa433!important;
    opacity: 1  !important;; /* Firefox */
  }

  .inputRightLocationStyle
  {
    height:80px !important;
    font-size:40px !important;
    font-weight: bold !important;
    color:white!important;
    background:#008000!important;
  }


    .inputWrongLocationStyle
  {
    height:80px !important;
    font-size:40px !important;
    font-weight: bold !important;
    color:white!important;
    background:#ec0505!important;
  }

  ul {
 list-style-type: square;
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
<div id="app">
<div class="row">
 <div class="col-md-6" >
  <div class="card" style="border:4px double #4d4d4d">
  <div class="card-header"  style="background:#4D4D4D;color:white;font-weight: bold">
    BARCODE : TROLLEY TRACKING NUMBER | @if($user->theLocation)<SPAN onclick="update_user_status()"  title="Your Location is in {{$user->theLocation->location}} Click to Change" style="color:#ffa739;margin-left:10px;cursor:pointer"><i class="fas fa-map-marker-alt"></i> <span style="text-decoration: underline;font-size:18px">{{$user->theLocation->location}}</span></SPAN>@else <SPAN onclick="update_user_status()" style="color:#ffa739;margin-left:10px;cursor:pointer"><i class="fas fa-map-marker-alt"></i> PLEASE SELECT YOUR LOCATION </span> @endif
{{--     <i class="fas fa-exchange-alt fa-2x" onclick="update_user_status()" title="Change Your Location" style="margin-left:20px;color:#ffa739;cursor:pointer"></i> --}}

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


      <input type="text" class="form-control" v-model="trackingNumber" v-on:Keyup="trolleyDetails()"  autocomplete="off" v-bind:class="{ inputDefaultStyle: isDefaultLocation, 'inputRightLocationStyle': isRightLocation, 'inputWrongLocationStyle': isWrongLocation }" placeholder="Tracking #...">

  <transition name="fade">
    <div v-if="show">
       <table class="table">
             <tr>
                <td style="width:150px">Trolley No</td>
                <td align="left"><span v-html="rTrackingNumber" class="spanStyle"></span> 
                </td>
             </tr>
             <tr>
                <td style="width:150px">Location</td>
                <td align="left"><span v-html="rLocation" class="spanStyle"></span> 
                </td>
             </tr>

             <tr>
                <td style="width:150px">Status</td>
                <td><span v-html="rStatus" class="spanStyle"></span></td>
             </tr>
        </table>
    </div><!--vifShow-->
    <div v-if="notFound" style="margin-top:10px;">
        <span style="color:red;font-weight:bold;">Tracking Number Cannot be Found!</span>
     </div><!--vifnotFound-->

  </transition>


  </div><!--card body-->
</div>
      
</div><!--div 6-->

  <transition name="fade">    

    <div class="col-md-4"  v-if="hasItem">
      <h3 style="margin-bottom:1px"><strong> <i class="fas fa-barcode" style="color:#002065"></i> YOUR BARCODED TROLLEY LISTS / @{{count}} </strong><br><span style="font-size:12px;font-style:italic">(Temporary Lists)</span></h3>
      <hr>
        <div style="height:800px; overflow:auto;">
          <ul><li v-for="item in items"> @{{ item.message }}</li></ul>
        </div>
          
    </div><!--div 3-->
</transition>


</div>    <!--row-->

</div><!--divApp-->
@endsection

@section('js')


<script type="text/javascript">
  var app = new Vue({
  el: '#app',

  data:{
    name: "nikko zabala",
    trackingNumber: '',
    trackingNumberLength: 0,
    
    trackingId: '',
    rTrackingNumber: '',
    rLocation: '',
    rStatus: '',
    show: false,
    notFound: false,
    userCurrentLocation : @if(\Auth::user()->location_id ){{\Auth::user()->location_id }} @endif,
    
    isRightLocation: false,
    isWrongLocation: false,
    isDefaultLocation:  true,


    items: [],
    hasItem:false,
    count:0,
    
    },//data

  // created()
  //  {
  //    this.listen();
  //  },
  mounted()
  {
    // this.trolleyDetails();
  },

  methods:{

    trolleyDetails: function()
    {

      var vm = this;

      this.trackingNumber=  this.trackingNumber.replace(/ /g,'');
      // console.log(this.trackingNumber);
      this.trackingNumberLength = this.trackingNumber.length
      if(this.trackingNumberLength >= 7)
      {

        // console.log(" 7 AND GREATER THAN");
 
       this.trolleyNum = this.trackingNumber;
        axios.get('./api/barcode/trolleydetails/' + vm.trackingNumber)
            .then(function (response) {
              // handle success
              // console.log(response.data);
              // console.log(response.data.data.location);
              var dbStatus;
              vm.trackingId = response.data.data.id;
              vm.rTrackingNumber =response.data.data.trackingNumber,
              vm.rLocation = response.data.data.trolleyLocation;
              vm.show = true;
              vm.notFound = false;


             // console.log(vm.userCurrentLocation);
              // console.log(response.data.data.trolleyAreaId);
              if(vm.userCurrentLocation == response.data.data.trolleyAreaId)
              {
                vm.rStatus = 'PROPER LOCATION <i class="fas fa-check-circle fa-2x" style="color:green"></i>';
                vm.itemStatus = "PROPER LOCATION";
                dbStatus = 'forretain';

                vm.isWrongLocation= false;
                vm.isDefaultLocation =  false;
                vm.isRightLocation=true;


              }else
              {
                vm.rStatus = 'FOR RETURN TO ' + response.data.data.trolleyArea + ' <i class="fas fa-times-circle fa-2x" style="color:red"></i>'
                vm.itemStatus = "FOR RETURN TO " + response.data.data.trolleyArea ;
                dbStatus = 'forreturn';

                  vm.isRightLocation=false;
                  vm.isDefaultLocation =  false;
                  vm.isWrongLocation= true;
              }

            axios.post('./api/barcode/addtohistory', {
              trolley_ml_id: response.data.data.id,
              user_current_location_id: vm.userCurrentLocation,
              status: dbStatus
            })
            .then(function (response) {
                // console.log("ADDED");
          
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });

              vm.count++;
              vm.hasItem = true;
              vm.items.unshift({
                 message : vm.trackingNumber + " " +  vm.itemStatus 
              })

              vm.trackingNumber = "";
  
              
            })
            .catch(function (error) {
              // handle error
   
              vm.trackingId = "";
              vm.rLocation = "";
              vm.show = false;
              vm.notFound = true;

              vm.isRightLocation=false;
              vm.isWrongLocation= false;
              vm.isDefaultLocation =  true;

              // console.log(error);

            })
            .then(function () {
              // always executed
             });

       }else
      {
        this.show = false;
        this.notFound = false;
        this.isRightLocation=false;
        this.isWrongLocation= false;
        this.isDefaultLocation =  true;
      }
            
    
    },
    barcodedTrolley: function($id)
    {
      var vm = this;
          axios.post('../api/barcode/trolley/' + $id,
             {
              firstName: 'Fred',
              lastName: 'Flintstone'
            })
            .then(function (response) {
                vm.fetchInternational();
          
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
            .then(function () {
              // always executed
            });
    },

}

});
</script>


@endsection
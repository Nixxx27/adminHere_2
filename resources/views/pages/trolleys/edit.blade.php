@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">   
        <a href="{{url('trolleys')}}">
            <button type="button"  style="margin-bottom:10px" title="Back to Location Lists" class="btn  btn-warning"><i class="fas fa-chevron-circle-left"></i> Back</button> 
          </a>

            <h3 style="color:#d91f2a;font-weight:700">EDIT : <span style="color:#00318D">Trolley # {{strtoupper($trolley->tracking_number)}}</span>  DETAILS </h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item "><a href="{{url('trolleys')}}">Trolley Lists</a></li>
                 <li class="breadcrumb-item active">Trolley # {{$trolley->tracking_number}}</li>
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


  <div class="col-md-6">

             {!! Form::open(array('method'=>'PATCH','name'=>'edit_trolley','id'=>'edit_trolley','action' => array('TrolleysController@update', $trolley->id) )) !!}

                <div class="form-group">
                    <label for="tracking_number" class="control-label">Tracking Number : <span style="color:red;">*</span></label>
                      <input type="text" required="required"  class="form-control" onkeyup="seriesNum()" id="tracking_number" name="tracking_number" value="@if(old('tracking_number')){{old('tracking_number')}}@else{{$trolley->tracking_number}}@endif">
                </div>

                <div class="form-group">
                    <label for="location" class="control-label">Location :  <span style="color:red;">*</span></label>
                    <select name="location" id="location" class="form-control">
                      @if($trolley->user_defined_location_id)
                        <option value="{{$trolley->theUserDefinedLocation->id}}">{{strtoupper($trolley->theUserDefinedLocation->location_description)}}</option>
                              @elseif ($trolley->tracking_series_id)
                        <option value="{{$trolley->theTrackingSeries->id}}">{{strtoupper($trolley->theTrackingSeries->location_description)}}</option>
                     @endif


                      @foreach($series as $series)
                        <option value="{{$series->id}}">{{strtoupper($series->location_description)}}</option>
                      @endforeach
                    </select>
                </div>


                  <div class="form-group">
                    <label for="remarks" class="control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks">@if(old('remarks')){{old('remarks')}}@else{{$trolley->remarks}}@endif</textarea>
                 </div>

                <button type="submit" onclick="return confirm('Are you sure you want to Edit this Trolley?')" class="btn btn-danger waves-effect waves-ligh pull-right"><i class="fas fa-save"></i> Save</button>
             {!! Form::close() !!}
   
    </div>
</div>

@endsection



@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">   
        <a href="{{url('trackingseries')}}">
            <button type="button"  style="margin-bottom:10px" title="Back to Location Lists" class="btn  btn-warning"><i class="fas fa-chevron-circle-left"></i> Back</button> 
          </a>

            <h3 style="color:#d91f2a;font-weight:700">EDIT : <span style="color:#00318D">{{strtoupper($series->location_description)}}</span>  DETAILS </h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item "><a href="{{url('trackingseries')}}">Tracking Numbers Series</a></li>
                 <li class="breadcrumb-item active">{{$series->location_description}}</li>
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

             {!! Form::open(array('method'=>'PATCH','name'=>'edit_series','id'=>'edit_series','action' => array('TrackingSeriesController@update', $series->id) )) !!}

                <div class="form-group">
                    <label for="recipient-name" class="control-label">Location Name:</label>
                    <select name="location_id" id="location_id" class="form-control">
                      <option value="{{$series->theLocation->id}}">{{$series->theLocation->location}}</option>
                      @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->location}}</option>
                      @endforeach
                    </select>
                </div>

                  <div class="form-group">
                    <label for="recipient-name" class="control-label">Description:</label>
                    <input type="text" required="required"  class="form-control" id="location_description" name="location_description" value="@if(old('location_description')){{old('location_description')}}@else{{$series->location_description}}@endif">
                </div>

                <div class="form-group">
                  <label for="recipient-name" class="control-label">Series:</label>
                      <div class=" input-group">
                        <input type="number" value="@if(old('series_from')){{old('series_from')}}@else{{$series->series_from}}@endif" required="required"  class="form-control" name="series_from">
                        <span class="input-group-addon bg-info b-0 text-white">to</span>
                        <input type="number" value="@if(old('series_to')){{old('series_to')}}@else{{$series->series_to}}@endif" required="required"  class="form-control" name="series_to">
                      </div>
                </div>

                  <div class="form-group">
                    <label for="message-text" class="control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks">@if(old('remarks')){{old('remarks')}}@else{{$series->remarks}}@endif</textarea>
                 </div>

                <button type="submit" onclick="return confirm('Are you sure you want to Edit this Location?')" class="btn btn-danger waves-effect waves-ligh pull-right"><i class="fas fa-save"></i> Save</button>
             {!! Form::close() !!}
   
    </div>
</div>

@endsection



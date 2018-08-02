@extends('layouts.app_template')

@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">   
        <a href="{{url('locations')}}">
            <button type="button"  style="margin-bottom:10px" title="Back to Location Lists" class="btn  btn-warning"><i class="fas fa-chevron-circle-left"></i> Back</button> 
          </a>

            <h3 style="color:#d91f2a;font-weight:700">EDIT : <span style="color:#00318D">{{strtoupper($location->location)}}</span>  DETAILS </h3>
        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item "><a href="{{url('locations')}}">Location Lists</a></li>
                 <li class="breadcrumb-item active">{{$location->location}}</li>
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

             {!! Form::open(array('method'=>'PATCH','name'=>'edit_location','id'=>'edit_location','action' => array('LocationController@update', $location->id) )) !!}

                <div class="form-group">
                    <label for="recipient-name" class="control-label">Location Name:</label>
                    <input type="text" class="form-control" id="location" name="location" value="@if(old('location')){{old('location')}}@else{{$location->location}}@endif">
                </div>
               <div class="form-group">
                    <label for="message-text" class="control-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks">@if(old('remarks')){{old('remarks')}}@else{{$location->remarks}}@endif</textarea>
                 </div>

                <button type="submit" onclick="return confirm('Are you sure you want to Edit this Location?')" class="btn btn-danger waves-effect waves-ligh pull-right"><i class="fas fa-save"></i> Save</button>
             {!! Form::close() !!}
   
    </div>
</div>

@endsection



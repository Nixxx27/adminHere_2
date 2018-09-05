
@extends('layouts.app_template')
@section('css')
<style type="text/css">
    .quickLinks
    {
        color:white;font-weight:bold;
    }


    .quickLinks:hover
    {
        color:#25aae1;
    }


  ul {
  list-style-type: none;
  }

.notes {
 background: url({{url('public/images/notebook.png')}}) repeat-y;
 /*width: 270px;*/
 height: 360px;
 font: normal 14px verdana;
 line-height: 25px;
 padding: 2px 10px;
 overflow: auto;
 color:#1D1D1D;
}
.style3 {
    border-top: 1px dotted #8c8b8b;
  border-bottom: 1px dotted #fff;
}
</style>
@endsection
@section('content')

 <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 style="color:#00318D"><i class="fas fa-shopping-cart"></i> <strong><span class="welcome"> </span></strong></h3>
        </div>

       {{--  <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div> --}}
    
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
   <div class="col-md-5">
                        <div class="card card-inverse card-warning" style="background: #ffa739">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><strong># OF TROLLEYS FOR RETURN</strong> </h4></div>
                            <div class="card-body">
                                <span style="font-size:50px;color:white;"><strong>4 </strong></span>
                                <br>
                                <button class="btn btn-sm btn-inverse">View details</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card card-inverse card-warning" style="background: #EF5350">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><strong>QUICK LINKS..</strong> </h4></div>
                            <div class="card-body">
                                <ul style="color:white;font-size:14px;">
                                    <li><a class="quickLinks" title="Click to go to Barcode App" href="{{url('barcode')}}"><i class="fas fa-chevron-circle-right"></i> BARCODE APP</a></li>

                                     <li><a class="quickLinks" title="Click to go to Trolleys Lists" href="{{url('trolleys')}}"><i class="fas fa-chevron-circle-right"></i> TROLLEYS</a></li>

                                    <li><a class="quickLinks" title="Click to Create new Location" href="{{url('locations')}}"><i class="fas fa-chevron-circle-right"></i>  CREATE NEW LOCATION</a></li>


                                    <li><a class="quickLinks" title="Click to Create New Tracking Series" href="{{url('trackingseries')}}"><i class="fas fa-chevron-circle-right"></i>  CREATE NEW TRACKING SERIES</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        

</div><!--row-->

       <hr><br>
<div class="row">
    <div class="col-md-5">

 
<h2><span class="mdi mdi-file-document"></span> <strong>Notes : <i class="fa fa-plus-square pull-right" data-toggle="modal" title="Add Note" data-target="#reminder_modal" style="cursor: pointer;font-size:30px;color:#2086bf;margin-right:10px"></i> </strong></h2>

<div class="notes" readonly="readonly" style="word-wrap: break-word;padding-bottom:10px">

  <br>

  @foreach($notes as $note)
     {!! Form::open(['method'=>'DELETE', 'action' => ['HomeController@destroy', $note->id]]) !!}
      <button class="btn btn-danger btn-xs pull-right" onclick="return confirm('Are you sure you want to delete this Notes?')" title="Delete Note?"><i class="fa fa-minus-circle"></i></button>
      {!! Form::close() !!}
     <span style="color:#253b4b">{{$note->notes}}</span>
    <br>
    <span style="font-size:11px;color:#515151"> by: {{ ucwords($note->theencoder->name)}} | {{ $note->updated_at->format('M-d-y h:m a')}} </span>
    <div class="style3"></div><br>

@endforeach

</div>

    </div>
</div>


@endsection


@section('modal')
<!-- Message Modal -->
    <div class="modal fade" id="reminder_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="mif-file-text"></span> New Note</h4>
                </div>
                <div class="modal-body">
                      
                       {!! Form::open(array('name'=>'add_notes','id'=>'add_notes','files'=>true,'action'=>'HomeController@store')) !!}
                    
                    <textarea class="form-control" rows="10" style="color:black" name="notes" placeholder="Hi, {{ucwords(\Auth::user()->name)}}! Type in your notes...">{{old('notes')}}</textarea>
                    
                    <button onclick="return confirm('Are you sure you want to save this Notes?')" class="btn pull-right btn-info"><i class="fa fa-floppy-o"></i> Save</button>
                   
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection

@section("js")
<script src="{{url('public/js/typed.min.js')}}"></script>
<script type="text/javascript">
     $(function(){
      $(".welcome").typed({
        strings: ['TROLLEY <span style="color:#bf2834">TRACKING</span> SYSTEM</strong>'],
        typeSpeed: 0
      });


  });

</script>
@endsection
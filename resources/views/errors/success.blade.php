 @if(Session::has('flash_message'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
    </div>
@endif
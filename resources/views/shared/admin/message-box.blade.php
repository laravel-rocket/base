@if(Session::has('message-success'))
    <div class="alert alert-success">
        <h4><i class="icon fa fa-check"></i> Success!</h4>
        {{ Session::get('message-success') }}
    </div>
@endif
@if(Session::has('message-failed'))
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-check"></i> Failed!</h4>
        {{ Session::get('message-failed') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

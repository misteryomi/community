@if(session()->get('error'))
<div class="col-md-12">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>An error occured!</strong><br/>{{ session()->get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif
@if($errors->any())
<div class="col-md-12">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>You have the following errors with your form</strong><br/>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif
@if(session()->get('message'))
<div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif
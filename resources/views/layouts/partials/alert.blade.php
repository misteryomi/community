@if(session()->get('error'))
<div class="col-md-12">
    <div class="uk-alert-danger" uk-alert>
        <strong>An error occured!</strong><br/>{{ session()->get('error') }}
        <a class="uk-alert-close" uk-close></a>
    </div>
</div>
@endif
@if($errors->any())
<div class="col-md-12">
    <div class="uk-alert-danger" uk-alert>
        <strong>You have the following errors with your form</strong><br/>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        <a class="uk-alert-close" uk-close></a>
    </div>
</div>
@endif
@if(session()->get('message'))
<div class="col-md-12">
    <div class="uk-alert-success" uk-alert>
        {{ session()->get('message') }}
        <a class="uk-alert-close" uk-close></a>
    </div>
</div>
@endif
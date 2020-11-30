@if(session()->get('error'))
<div class="bg-danger uk-light" uk-alert>
    <strong>An error occured</strong><br/>{{ session()->get('error') }}
    <a class="uk-alert-close" uk-close></a>
</div>
@endif
@if($errors->any())
<div class="bg-danger uk-light" uk-alert>
    <strong>You have the following errors with your form</strong><br/>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
    <a class="uk-alert-close" uk-close></a>
</div>
@endif
@if(session()->get('message'))
<div class="bg-success uk-light" uk-alert>
    {{ session()->get('message') }}
    <a class="uk-alert-close" uk-close></a>
</div>
@endif
@php
    $title = "";
    $link = route('register.complete').'?token='.$token;
    $button_title = "Complete Registration";
    $name = $user->name;
    $content = "
        <p>Your IRS account has been created successfully. Please click the button below to complete your registration process.</p>";
@endphp
@include('emails.template')

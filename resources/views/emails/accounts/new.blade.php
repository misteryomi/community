@php
    $title = "";
    $link = route('tickets.vendor.login');
    $button_title = "Login to continue";
    $content = $msg;
@endphp
@include('emails.template')

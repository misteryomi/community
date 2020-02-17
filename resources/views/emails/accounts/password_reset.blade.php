@php
    $title = "";
    $link = route('forgot-password', ['token' => $token]);
    $button_title = "Reset Password";
    $name = $user->name;
    $content = "
        <p>To complete your password reset process, please click the button below:</p>";
@endphp
@include('emails.template')

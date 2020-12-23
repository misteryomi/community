<div class="my-4 uk-text-center">
    <h1 class="mb-2"> Sign in  </h1>
    <p class="my-2">New here?
    <a href="{{ route('register') }}" class="uk-link text-primary">Create an account</a> </p>
</div>
<div class="text-center mt-3">
    <a href="login/google" class="button danger  text-white mb-2">
        <i class="fa fa-google mr-3"></i> Continue with Google
    </a>
</div>
<hr/>

<form action="{{ route('post.login') }}{{ request()->has('utm_redirect') ? '?utm_redirect='.request()->utm_redirect : '?utm_redirect='.request()->fullUrl() }}" method="POST">
  @csrf
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <label class="form-control-label" for="username">Username or Email address</label>
            <input class="uk-input bg-secondary" type="text" required name="username" placeholder="Enter Username or Email address">
        </div>
    </div>
    <div class="uk-form-group">
        <div class="uk-position-relative">
            <label class="form-control-label" for="password">Password</label>
            <input class="uk-input bg-secondary" type="password" name="password" required placeholder="Enter password">
        </div>
    </div>
    <button type="submit" class="button primary large block mb-4">Log in</button>
</form>
<a href="{{ route('forgot-password') }}" class="text-center uk-display-block"> Forgot your password?</a>


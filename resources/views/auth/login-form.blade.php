<form action="{{ route('post.login') }}{{ request()->has('utm_redirect') ? '?utm_redirect='.request()->utm_redirect : '?utm_redirect='.request()->fullUrl() }}" method="POST">
    @csrf
    <div class="form-group">
      <label class="form-control-label" for="username">Username or Email address</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Enter username/email">
    </div>
    <div class="form-group">
      <label class="form-control-label" for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="*********">
    </div>
    <button type="submit" class="btn btn-block btn-default">Login</button>
</form>

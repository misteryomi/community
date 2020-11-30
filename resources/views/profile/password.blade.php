@extends('profile.settings_template')


@section('settings_page')

        <div class="uk-card-default rounded">
            <div class="p-3">
                <h5 class="mb-0"> Update Password </h5>
            </div>
            <hr class="m-0">
            <form  action="{{ route('profile.password.settings.post') }}" method="POST" class="uk-child-width-1-2@s uk-grid-small p-4" uk-grid>
              @csrf
                <div style="width: 100%">
                    <h5 class="uk-text-bold mb-2"> Old Password</h5>
                    <input type="password" name="old_password" class="uk-input" id="old_password">          
                    <small>Can't remember your old password? <a href="{{ route('logout') }}">Logout, then reset your password</a></small>      
                </div>
                <div style="width: 100%">
                    <h5 class="uk-text-bold mb-2"> New password</h5>
                    <input type="password" name="password" class="uk-input" id="password">                
                </div>
                <div style="width: 100%">
                    <h5 class="uk-text-bold mb-2"> Confirm Password</h5>
                    <input type="password" name="password_confirmation" class="uk-input" id="password_confirmation">                
                </div>


                  <div style="width: 100%">
                      <button type="submit" class="button block primary">Update Password</button>
                  </div>
            </form>

        </div>


@endsection
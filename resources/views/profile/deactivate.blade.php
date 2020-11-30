@extends('profile.settings_template')


@section('settings_page')

        <div class="uk-card-default rounded">
            <div class="p-3">
                <h5 class="mb-0"> Deactivate Account</h5>
            </div>
            <hr class="m-0">
            <form action="{{ route('profile.deactivate.settings.post') }}" method="POST" class="uk-child-width-1-2@s uk-grid-small p-4 text-center" uk-grid>
              @csrf
                <div style="width: 100%">
                    <p class="mb-4">By choosing to deactivate your account, you will not be able to log in, create topics nor communities, neither would you be able to engage posts and inidivduals on this platform</p>
                    <h5 class="uk-text-bold mb-2"> Enter password to continue</h5>
                    <input type="password" name="password" class="uk-input" id="password">          
                </div>


                  <div style="width: 100%">
                      <button type="submit" class="button block primary">I agree, Deactivate Account</button>
                  </div>
            </form>

        </div>


@endsection
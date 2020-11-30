@extends('profile.settings_template')


@section('settings_page')

    <div class="uk-card-default rounded">
            <div class="p-3">
                <h5 class="mb-0"> Personal Information </h5>
            </div>
            <hr class="m-0">
            <form  action="{{ route('profile.settings.post') }}" method="POST" class="uk-child-width-1-2@s uk-grid-small p-4" uk-grid>
              @csrf
                <div>
                    <h5 class="uk-text-bold mb-2"> First Name </h5>
                    <input type="text" class="uk-input" required placeholder="First name"  name="first_name" value="{{ $user->details->first_name }}">
                </div>
                <div>
                    <h5 class="uk-text-bold mb-2"> Last Name </h5>
                    <input type="text" class="uk-input" required placeholder="Last name" name="last_name" value="{{ $user->details->last_name }}">
                </div>
                <div style="width: 100%">
                    <h5 class="uk-text-bold mb-2"> What's your location? </h5>
                    <input type="text" class="uk-input" placeholder="Location"  name="location" value="{{ $user->details->location }}">
                </div>
                <div style="width: 100%">
                    <h5 class="uk-text-bold mb-2"> Tell us about yourself</h5>
                    <textarea name="bio" class="uk-textarea" id="bio" rows="6">{{ $user->details->bio }}</textarea>
                </div>
                <div>
                    <h5 class="uk-text-bold mb-2"> Instagram Handle </h5>
                    <input type="text" class="uk-input" name="instagram" value="{{ $user->details->instagram }}">
                </div>
                <div>
                    <h5 class="uk-text-bold mb-2"> Twitter Handle </h5>
                    <input type="text" class="uk-input" name="twitter" value="{{ $user->details->twitter }}">
                </div>
                <div>
                    <h5 class="uk-text-bold mb-2"> Facebook URL </h5>
                    <input type="text" class="uk-input" name="facebook" value="{{ $user->details->facebook }}" >
                </div>
                <div>
                    <h5 class="uk-text-bold mb-2"> Your website </h5>
                    <input type="text" class="uk-input" name="website" value="{{ $user->details->website }}" >
                </div>

                <!-- <div style="width: 100%">
                  <div class="uk-flex uk-flex-right p-4"> -->
                  <!-- </div> -->

                  <div style="width: 100%">
                    <button class="button primary block" type="submit">Save Changes</button>
                  </div>
            </form>

        </div>



@endsection

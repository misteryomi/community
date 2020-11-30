@extends('profile.settings_template')


@section('settings_page')

    <div class="uk-card-default rounded">
            <div class="p-3">
                <h5 class="mb-0"> Profile Picture </h5>
            </div>
            <hr class="m-0 p-4">
            <form action="{{ route('profile.avatar.settings.post') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="text-center p-4">
                    <img src="{{ $user->avatar }}" class="avatar img-circle" alt="avatar">
                    
                        <div class="uk-margin" uk-margin="">
                            <div uk-form-custom="target: true" class="uk-form-custom uk-first-column">
                                <input type="file" name="avatar" id="profile-picture" >
                                <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled="">
                            </div>
                        <button class="uk-button uk-button-primary" type="submit">Upload</button>
                  </div>
            </form>

        </div>



@endsection

@extends('layouts.app')

@section('content')
    <script src="{{mix('/js/user_profile.js')}}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{route('saveProfile')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" value="{{ $model->name }}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">{{ __('LastName') }}</label>
                        <input type="text" class="form-control" id="last_name" value="{{$model->last_name ?? ''}}" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="dob">{{ __('Date of birth') }}</label>
                        <input type="date" class="form-control" id="dob" data-format="d/m/y" value="{{$model->dob ?? ''}}" name="dob">
                    </div>
                    <div class="form-group">
                        <label for="location">{{ __('Location') }}</label>
                        <input type="text" class="form-control" id="location" value="{{ $model->location ?? ''}}" name="location">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Num. Telephone') }}</label>
                        <input type="text" class="form-control" id="phone" value="{{ $model->phone ?? ''}}" name="phone">
                    </div>
                    <button type="submit" class="save-profile-button btn btn-primary">{{ __('Save') }}</button>
                </form>
                    <div class="messages msg-float">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

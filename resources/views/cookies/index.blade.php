@extends('layouts.app')
@section('content')
    <div class="test">
        <div class="test-content">
            <form action="{{ route('test.cookie.store') }}"
                  data-url="{{ route('test.cookie.index') }}"
                  class="test-content__form form-inline js-send-form"
                  id="cookie-form"
            >
                @csrf

                <div class="form-group mx-sm-4 mb-1">
                    <label for="hourly" class="form-label">{{ __('Test.Label.Hourly') }}</label>
                    <input type="text"
                           class="form-control"
                           name="numberHourly"
                           id="hourly"
                           placeholder="{{ __('Test.Placeholder.Hourly') }}"
                    />
                </div>

                <div class="form-group mx-sm-4 mb-1">
                    <label for="session" class="form-label">{{ __('Test.Label.Session') }}</label>
                    <input type="text"
                           class="form-control"
                           id="session"
                           name="numberForever"
                           placeholder="{{ __('Test.Placeholder.Session') }}"
                    />
                </div>

                <button class="btn btn-success mb-2">{{ __('Test.Send.Cookie') }}</button>
            </form>

            <div class="row js-cookies">
                @foreach($models as $class => $cookie)

                <div
                    class="alert alert-success {{ $class }} col-5 mr-5 test-content__cookie"
                >{{ __('Test.Message.Cookie', [
                        'class' => $class === "cookie_hourly" ? "by 1 hour" : "forever",
                        'cookie' => $cookie
                    ]) }}</div>

                @endforeach
            </div>

        </div>
        <hr>
        <div class="test-content">
            <form action="{{ route('api.word') }}" class="test-content__form js-send-form row" id="split-form">
                @csrf

                <div class="form-group col-10">
                    <label for="wordSplit" class="form-label">{{ __('Test.Label.Split-word') }}</label>
                    <input type="text"
                           class="form-control"
                           id="wordSplit"
                           name="wordSplit"
                           placeholder="{{ __('Test.Placeholder.Split-word') }}"
                    />
                    <div class="alert alert-success test-content__split mt-lg-2" style="display: none;"></div>


                </div>
                <button class="btn btn-success col-2">{{ __('Test.Send.Split-word') }}</button>
            </form>
        </div>
        <hr>
        <div class="test-content">
            <form action="{{ route('api.text') }}" class="test-content__form js-send-form row" id="text-form">
                @csrf

                <div class="form-group col-10">
                    <label for="text" class="form-label">{{ __('Test.Label.Text') }}</label>
                    <textarea class="form-control"
                              name="text"
                              id="text"
                              placeholder="{{ __('Test.Placeholder.Text') }}"
                    ></textarea>
                    <div class="alert alert-success test-content__text mt-lg-2" style="display: none;"></div>
                </div>

                <button class="btn btn-success col-2">{{ __('Test.Send.Text') }}</button>
            </form>
        </div>

    </div>
@endsection

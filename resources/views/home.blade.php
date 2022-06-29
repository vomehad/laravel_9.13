@extends('layouts.app')
@section('content')
    <div class="home-content">
        <div class="form-wrap">
{{--            <form action="{{ route('Create') }}" method="post" class="row g-3 needs-validation" novalidate>--}}
{{--                @csrf--}}

{{--                <div class="col-md-12">--}}
{{--                    <label for="validationCustomUsername" class="form-label">{{ __('Auth.Label.Username') }}</label>--}}
{{--                    <div class="input-group has-validation">--}}
{{--                        <span class="input-group-text" id="inputGroupPrepend">@</span>--}}
{{--                        <input type="text"--}}
{{--                               class="form-control @error('username') border-danger @enderror"--}}
{{--                               id="validationCustomUsername"--}}
{{--                               aria-describedby="inputGroupPrepend"--}}
{{--                               name="username"--}}
{{--                               placeholder="{{ __('Auth.Placeholder.Username') }}"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                    @error('username')--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <span>{{ $message }}</span>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="name">{{ __('Auth.Label.Name') }}</label>--}}
{{--                        <input type="text"--}}
{{--                               class="form-control @error('name') border-danger @enderror"--}}
{{--                               name="name"--}}
{{--                               placeholder="{{ __('Auth.Placeholder.Name') }}"--}}
{{--                               id="name"--}}
{{--                        >--}}
{{--                    </div>--}}
{{--                    @error('name')--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <span>{{ $message }}</span>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="email">{{ __('Auth.Label.Email') }}</label>--}}
{{--                        <input type="text"--}}
{{--                               class="form-control @error('email') border-danger @enderror"--}}
{{--                               name="email"--}}
{{--                               placeholder="{{ __('Auth.Placeholder.Email') }}"--}}
{{--                               id="email"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                    @error('email')--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <div class="">--}}
{{--                            <span>{{ $message }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="subject">{{ __('Auth.Label.Subject') }}</label>--}}
{{--                        <input type="text"--}}
{{--                               name="subject"--}}
{{--                               class="form-control @error('subject') border-danger @enderror"--}}
{{--                               placeholder="{{ __('Auth.Placeholder.Subject') }}"--}}
{{--                               id="subject"--}}
{{--                        >--}}
{{--                    </div>--}}
{{--                    @error('subject')--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <div class="">--}}
{{--                            <span>{{ $message }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="col-md-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="message">{{ __('Auth.Label.Message') }}</label>--}}
{{--                        <textarea class="form-control @error('message') border-danger @enderror"--}}
{{--                                  name="message"--}}
{{--                                  placeholder="{{ __('Auth.Placeholder.Message') }}"--}}
{{--                                  id="message"--}}
{{--                                  rows="12"--}}
{{--                        ></textarea>--}}
{{--                    </div>--}}
{{--                    @error('message')--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <div class="">--}}
{{--                            <span>{{ $message }}</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="ml-5">--}}
{{--                    <button type="submit" class="btn btn-success">{{ __('Auth.Send.Offer') }}</button>--}}
{{--                </div>--}}
{{--            </form>--}}
        </div>
    </div>
@endsection

@section('aside')
    @parent
    <div class="container">
        @foreach($models as $contact)
            <span>{{ $contact->name }}</span>
            <span>{{ $contact->username }}</span>
            <span>{{ $contact->email }}</span>
        @endforeach
    </div>
@endsection

@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Kinsman $model */ @endphp
    <div class="content">
        <div class="form-wrap">
            <form action="{{ route('kinsmans.store') }}" method="post" class="row">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">{{ __('Kinsman.Label.Name') }}</label>
                    <input type="text"
                           class="form-control @error('name') border-danger @enderror"
                           name="name"
                           placeholder="{{ __('Kinsman.Placeholder.Name') }}"
                           id="name"
                           value="{{ old('name', $model->name) }}"
                    >
                </div>
                @error('name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="middle_name" class="form-label">{{ __('Kinsman.Label.MiddleName') }}</label>
                    <input type="text"
                           class="form-control @error('middle_name') border-danger @enderror"
                           name="middle_name"
                           placeholder="{{ __('Kinsman.Placeholder.MiddleName') }}"
                           id="middle_name"
                           value="{{ old('middle_name', $model->middle_name) }}"
                    >
                </div>
                @error('middle_name')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="gender" class="form-label">{{ __('Kinsman.Label.Gender') }}</label>
                    <select name="gender" id="gender" class="@error('gender') border-danger @enderror">
                            <option value="male">{{ __('Kinsman.Select.Male') }}</option>
                            <option value="female">{{ __('Kinsman.Select.Female') }}</option>
                    </select>
                </div>
                @error('gender')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="father" class="form-label">{{ __('Kinsman.Label.Father') }}</label>
                    <select name="father" id="father" class="@error('father') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($fathers as $father)
                            <option value="{{ $father->id }}">{{ $father->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('father')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="mother" class="form-label">{{ __('Kinsman.Label.Mother') }}</label>
                    <select name="mother" id="father" class="@error('mother') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($mothers as $mother)
                            <option value="{{ $mother->id }}">{{ $mother->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('mother')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="kin" class="form-label">{{ __('Kinsman.Label.Kin') }}</label>
                    <select name="kin" id="father" class="@error('kin') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($kins as $kin)
                            <option value="{{ $kin->id }}">{{ $kin->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kin')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('Kinsman.Button.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    @php
        /** @var \App\Models\Kinsman $model */
        /** @var \App\Dto\SelectedDto $selected */
     @endphp
    <div class="content">
        <div class="form-wrap">
            <form action="{{ route('kinsmans.update', $model->id) }}" method="post" class="row">
                @csrf
                <input type="hidden" name="id" value="{{ $model->id }}" />
                @method('PUT')

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
                        @foreach(['male', 'female'] as $gender)
                            <option value="{{ $gender }}" {{ $gender === $model->gender ? 'selected' : '' }}>{{ __('Kinsman.Select.' . $gender) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('gender')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="father" class="form-label">{{ __('Kinsman.Label.Father') }}</label>
                    <select name="father_id" id="father" class="@error('father_id') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($fathers as $father)
                            <option value="{{ $father->id }}" {{ ($father->id === $selected->fatherId) ? 'selected' : '' }}>{{ $father->name }} {{ $father->middle_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('father_id')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="mother" class="form-label">{{ __('Kinsman.Label.Mother') }}</label>
                    <select name="mother_id" id="father" class="@error('mother_id') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($mothers as $mother)
                            <option value="{{ $mother->id }}" {{ ($mother->id === ($model->mother->id ?? null)) ? 'selected' : '' }}>{{ $mother->name }} {{ $mother->middle_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('mother_id')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="col-md-12">
                    <label for="kin" class="form-label">{{ __('Kinsman.Label.Kin') }}</label>
                    <select name="kin_id" id="kin" class="@error('kin_id') border-danger @enderror">
                        <option value="{{ null }}"></option>
                        @foreach($kins as $kin)
                            <option value="{{ $kin->id }}" {{ ($kin->id === ($model->kin->id ?? null)) ? 'selected' : '' }}>{{ $kin->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kin_id')
                <div class="alert alert-danger">
                    <span>{{ $message }}</span>
                </div>
                @enderror

                <div class="ml-5">
                    <button type="submit" class="btn btn-success">{{ __('Kinsman.Button.Update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    @php
        /** @var \App\Models\Kinsman $model */
        /** @var \App\Models\Kinsman[] $children */
     @endphp

    <a href="{{ route('platform.kinsman.edit', $model->id) }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
        </svg>
    </a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('kinsmans.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('kinsmans.index') }}"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
        </svg>
    </button>
    <a href="{{ route('kinsmans.index') }}" class="btn btn-success">Список</a>

    <main role="main" class="container">
        <style type="text/css">
            img {
                max-width: 100%;
                max-height: 100%;
            }

            h1 {
                font-size: 50px;
                margin-top: 30px;
                margin-bottom: 20px;
            }

            h2 {
                margin-top: 40px;
                margin-bottom: 20px;
            }

            p {
                font-size: 18px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <h2>{{ $model->name }} {{ $model->middle_name }} {{ $model->kin->name ?? '' }}</h2>
                </div>
                {{--<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <img src="img.url">
                </div>--}}
            </div>
        </div>
        @if(!empty($model->life->id))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('Kinsman.Label.Bio') }}</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @if(!empty($model->life->birth_date))
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                        <p>{{ Carbon\Carbon::make($model->life->birth_date)->format('j F Y') }} - Дата рождения</p>
{{--                        <p>{{ Carbon\Carbon::make($model->life->birth_date)->format('H:i') }} - Время рождения</p>--}}
                    </div>
                    @endif

                    @if(!empty($model->life->end_date))
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <p>{{ Carbon\Carbon::make($model->life->end_date)->format('j F Y') }} - Дата смерти</p>
                    </div>
                    @endif

                    @if($model->nativeCity->first() && !empty($model->nativeCity->first()->name))
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <p>{{ $model->nativeCity->first()->name }} - Город рождения</p>
                        </div>
                    @endif
                </div>
            </div>
        <hr>
        @endif

        @if(isset($model->father->id) || isset($model->mother->id))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('Kinsman.Label.Parents') }}</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @isset($model->father->id)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <p>
                            <a href="{{ route('kinsmans.show', $model->father->id) }}"
                               class="btn btn-warning"
                            >{{ $model->father->name }} {{ $model->father->middle_name }}</a>
                        </p>
                    </div>
                    @endif
                    @isset($model->mother->id)
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                            <p>
                                <a href="{{ route('kinsmans.show', $model->mother->id) }}"
                                   class="btn btn-warning"
                                >{{ $model->mother->name }} {{ $model->mother->middle_name }}</a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        <hr>
        @endif

        @if(!empty($model->gender === 'male' ? $model->wife : $model->husband))
            @if(isset($model->wife->first()->id) && !empty($model->wife->first()->id))
                <h2>{{ __('Kinsman.Label.Wife') }}</h2>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <p>
                        <a href="{{ route('kinsmans.show', $model->wife->first()->id) }}"
                           class="btn btn-warning"
                        >{{ $model->wife->first()->getFullNameAttribute() }}</a>
                    </p>
                </div>
                <hr>
            @endif
            @if(isset($model->husband->first()->id) && !empty($model->husband->first()->id))
                <h2>{{ __('Kinsman.Label.Husband') }}</h2>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <p>
                        <a href="{{ route('kinsmans.show', $model->husband->first()->id) }}"
                           class="btn btn-warning"
                        >{{ $model->husband->first()->getFullNameAttribute() }}</a>
                    </p>
                </div>
                <hr>
            @endif
        @endif
        @if($children->count())
        <h2 class="">{{ __('Kinsman.Children.List') }}</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><div>{{ __('Kinsman.Table.Name') }}</div></th>
                <th scope="col"><div>{{ __('Kinsman.Table.BirthDate') }}</div></th>
                <th scope="col"><div>{{ __('Kinsman.Table.Father') }}</div></th>
                <th scope="col"><div>{{ __('Kinsman.Table.Mother') }}</div></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($children as $child)
            <tr>
                <th scope="row"><a href="{{ $child->id }}" class="starter-template">{{ $child->name }}</a></th>

                @if(!empty($child->life->birth_date))
                    <th scope="row">{{ Carbon\Carbon::make($child->life->birth_date)->format('j M Y') }}</th>
                @else
                    <td><div class="starter-template">{{ '-' }}</div></td>
                @endif

                @if(isset($child->father->id) && $child->father->id !== $model->id)
                    <td><a href="{{ route('kinsmans.show', $child->father->id) }}">{{ $child->father->name }}</a></td>
                @else
                    <td><div class="starter-template">{{ $child->father->name ?? '-'}}</div></td>
                @endif

                @if(isset($child->mother->id) && $child->mother->id !== $model->id)
                    <td><a href="{{ route('kinsmans.show', $child->mother->id) }}">{{ $child->mother->name }}</a></td>
                @else
                    <td><div class="starter-template">{{ $child->mother->name ?? '-' }}</div></td>
                @endif

                <td>
                    <a href="{{ route('kinsmans.show', $child->id) }}" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </a>
                    <a href="{{ route('platform.kinsman.edit', $child->id) }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </a>
                    <a href="{{ route('kinsmans.destroy', $child->id) }}" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </main>
@endsection

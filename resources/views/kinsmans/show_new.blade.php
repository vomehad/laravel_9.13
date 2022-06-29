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
    <a href="{{ route('kinsmans.index') }}" class="btn btn-success">Вернуться к списку</a>

    <main role="main" class="container">

        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <h2>
                        <span>{{ $model->presenter()->title() }}</span>
                        <span {!! $model->presenter()->color() !!}>{{ $model->kin->name ?? '' }}</span>
                    </h2>
                </div>
                <picture>
                    <source class="rounded-circle" srcset="{{ $model->presenter()->image() }}">
                    <img class="rounded-circle" src="{{ $model->presenter()->image() }}">
                </picture>
            </div>
        </div>
        @if(!empty($model->life->id))
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>{{ __('Kinsman.Label.Bio') }}</h2>
                    </div>
                </div>
                <div class="row">
                    @if(!empty($model->life->birth_date))
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
                        <p>{{ $model->presenter()->birthDate() }} - Дата рождения</p>
                    </div>
                    @endif

                    @if(!empty($model->life->end_date))
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <p>{{ $model->presenter()->deathDate() }} - Дата смерти</p>
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
                <div class="row people">
                    @isset($model->father->id)
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box" style="background-color: {{ $model->father->presenter()->color() }}">
                            <a href="{{ route('kinsmans.show', $model->father->id) }}">
                                <img class="rounded-circle" src="{{ $model->father->presenter()->image() }}">
                            </a>
                            <div class="info-wrap" {!! $model->father->presenter()->color() !!}>
                                <a href="{{ route('kinsmans.show', $model->father->id) }}">
                                    <h3 class="name">{{ $model->father->presenter()->title() }}</h3>
                                </a>
                                @if(!empty($model->father->life->birth_date))
                                    <p class="title">{{ $model->father->presenter()->birthDate() }}</p>
                                @endif
                                @if(!empty($model->father->kin->name))
                                    <p class="description">{{ $model->father->kin->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @isset($model->mother->id)
                        <div class="col-md-6 col-lg-4 item">
                            <div class="box" style="background-color: {{ $model->mother->presenter()->color() }}">
                                <a href="{{ route('kinsmans.show', $model->mother->id) }}">
                                    <img class="rounded-circle" src="{{ $model->mother->presenter()->image() }}">
                                </a>
                                <div class="info-wrap" {!! $model->mother->presenter()->color() !!}>
                                    <a href="{{ route('kinsmans.show', $model->mother->id) }}">
                                        <h3 class="name">{{ $model->mother->presenter()->title() }}</h3>
                                    </a>
                                    @if(!empty($model->mother->life->birth_date))
                                        <p class="title">{{ $model->mother->presenter()->birthDate() }}</p>
                                    @endif
                                    @if(!empty($model->mother->kin->name))
                                        <p class="description">{{ $model->mother->kin->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        <hr>
        @endif

        @if(!empty($model->presenter()->wed()) && isset($model->presenter()->wed()->id))
            <div class="container">
                <h2>{{ __('Kinsman.Label.' . $model->presenter()->wedKey(true)) }}</h2>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box">
                        <a href="{{ route('kinsmans.show', $model->presenter()->wed()->id) }}">
                            <img class="rounded-circle" src="{{ $model->presenter()->wed()->presenter()->image() }}">
                        </a>
                        <div class="info-wrap" {!! $model->presenter()->wed()->presenter()->color() !!}>
                            <a href="{{ route('kinsmans.show', $model->presenter()->wed()->id) }}">
                                <h3 class="name">{{ $model->presenter()->wed()->presenter()->title() }}</h3>
                            </a>
                            @if(!empty($model->presenter()->wed()->life->birth_date))
                                <p class="title">{{ $model->presenter()->wed()->presenter()->birthDate() }}</p>
                            @endif
                            @if(!empty($model->presenter()->wed()->kin->name))
                                <p class="description">{{ $model->presenter()->wed()->kin->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($children->count())
            <div class="container">
                <h2 class="child-box">{{ __('Kinsman.Children.List') }}</h2>
                <div class="row people">
                @foreach($children as $child)
                    @php /** @var \App\Models\Kinsman $child */ @endphp
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $child->id) }}">
                                <img class="rounded-circle" src="{{ $child->presenter()->image() }}">
                            </a>
                            <div class="info-wrap" {!! $child->presenter()->color() !!}>
                                <a href="{{ route('kinsmans.show', $child->id) }}">
                                    <h3 class="name">{{ $child->presenter()->title() }}</h3>
                                </a>
                                @if(!empty($child->life->birth_date))
                                    <p class="title">{{ $child->presenter()->birthDate() }}</p>
                                @endif
                                @if(!empty($child->kin->name))
                                    <p class="description">{{ $child->kin->name }}</p>
                                @endif

                                <div class="info-wrap__child mt-2">
                                    @if(isset($child->mother->id) && $child->mother->id !== $model->id)
                                        <hr>
                                        <a href="{{ route('kinsmans.show', $child->mother->id) }}">
                                            <div {!! $child->mother->presenter()->color() !!}>
                                                <h4>{{ __('Kinsman.Label.Mother') }}</h4>
                                                <span>{{ $child->mother->presenter()->title() }}</span>
                                            </div>
                                        </a>
                                    @endif
                                    @if(isset($child->father->id) && $child->father->id !== $model->id)
                                        <hr>
                                        <a href="{{ route('kinsmans.show', $child->father->id) }}">
                                            <div class="info-wrap__child" {!! $child->father->presenter()->color() !!}>
                                                <h4>{{ __('Kinsman.Label.Father') }}</h4>
                                                <span>{{ $child->father->presenter()->title() }}</span>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        @endif
    </main>
@endsection

@extends('layouts.app')
@section('content')
    <div class="team-boxed">
        <div class="container">
            <div class="row people">
                @foreach($models as $kinsman)
                    @php /** @var \App\Models\Kinsman $kinsman */ @endphp
                    <div class="col-md-6 col-lg-4 item">
                        <div class="box">
                            <a href="{{ route('kinsmans.show', $kinsman->id) }}">
                                <img class="rounded-circle" src="{{ $kinsman->presenter()->image() }}">
                            </a>
                            <div class="info-wrap" {!! $kinsman->presenter()->color() !!}>
                                <a href="{{ route('kinsmans.show', $kinsman->id) }}">
                                    <h4 class="name">{{ $kinsman->presenter()->title() }}</h4>
                                </a>
                                @if(!empty($kinsman->life->birth_date))
                                    <p class="title">{{ $kinsman->presenter()->birthDate() }}</p>
                                @endif
                                @if(!empty($kinsman->kin->name))
                                    <p class="description">{{ $kinsman->kin->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $models->onEachSide(5)->links() }}
    </div>
@endsection

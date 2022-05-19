@extends('layouts.app')
@section('content')
    @php
    /** @var array $source */
    /** @var array $bubbled */
    @endphp
   {{-- <form action=""></form>
    <input type="number" value="{{}}" />--}}
    <div class="sorting__begin">{{ implode(' ', $source) }}</div>
    <hr>
    <div class="sorting__bubble">{{ implode(' ', $bubbled) }}</div>
@endsection

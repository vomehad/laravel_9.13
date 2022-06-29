@extends('layouts.app')
@section('content')
    <form class="input" action="{{ route('kins.search') }}" method="post">
        @csrf
        <div class="form-outline">
            <input type="search" name="search"
                   id="search-input"
                   class="form-control"
                   value="{{ $string ?? '' }}"
            />
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Kin.Button.Search') }}</button>
    </form>

    <div class="control">
        <a href="{{ route('kins.create') }}"
           class="btn btn-success"
        >{{ __('Kin.Button.Create') }}</a>
    </div>

    <div class="content">
        <table>
            <thead>
            <tr>
                <th><div class="btn btn-default">{{ __('Kin.Table.Name') }}</div></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
        @foreach($models as $kin)
            @php /** @var \App\Models\Kin $kin */ @endphp

            <tr>
                <td><div class="btn btn-default">{{ $kin->name }}</div></td>

                <td><a href="{{ route('kins.show', $kin->id) }}" class="btn btn-success">{{ __('Kin.Button.View') }}</a></td>
                <td><a href="{{ route('kins.edit', $kin->id) }}" class="btn btn-primary">{{ __('Kin.Button.Update') }}</a></td>
                <td><a href="{{ route('kins.destroy', $kin->id) }}" class="btn btn-danger">{{ __('Kin.Button.Delete') }}</a></td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@endsection

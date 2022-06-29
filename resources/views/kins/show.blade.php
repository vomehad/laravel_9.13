@extends('layouts.app')
@section('content')
    @php /** @var \App\Models\Kin $model */ @endphp

    <a href="{{ route('kins.edit', $model->id) }}"
       class="btn btn-primary"
    >{{ __('Kin.Button.Update') }}</a>
    <button class="btn btn-danger js-delete"
            data-ref="{{ route('kins.destroy', $model->id) }}"
            data-csrf="{{ csrf_token() }}"
            data-redirect="{{ route('kins.index') }}"
    >{{ __('Kin.Button.Delete') }}</button>

    <main role="main" class="container">
        <table>
            <thead>
            <tr>
                <th><div class="btn btn-default">{{ __('Kin.Table.Name') }}</div></th>
                <th><div class="btn btn-default">{{ __('Kin.Table.Slug') }}</div></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div class="starter-template">{{ $model->name }}</div></td>
                    <td><div class="starter-template">{{ $model->slug }}</div></td>
                </tr>
            </tbody>
        </table>
    </main>
@endsection

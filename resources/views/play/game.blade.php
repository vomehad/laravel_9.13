@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="game-content">
        <div id="game" class="container">
            <table>

            @for($iH = 1; $iH <= $rows; $iH++)
                <tr>
                    @for($iV = 1; $iV <= $rows; $iV++)
                        <td class="td__cell">{{ $item++ }}</td>
                    @endfor
                </tr>
            @endfor

            </table>

            <button id="start" class="btn btn-success">{{ __('Game.Start') }}</button>

            <p id="timer"></p>

            <div id="winner">
                <p id="youWin">{{ __('Game.Win') }}</p>
                <p id="yourTime">{{ __('Game.Your-time') }}</p>
                <button id="theEnd" class="btn btn-danger">{{ __('Game.New-game') }}</button>
            </div>
        </div>
    </div>

@endsection

@section('body')
    <script src="{{ mix('/js/find-pairs.js') }}"></script>
@endsection



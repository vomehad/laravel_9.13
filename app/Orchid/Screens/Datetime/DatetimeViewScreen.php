<?php

namespace App\Orchid\Screens\Datetime;

use DateTimeInterface;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class DatetimeViewScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        return [
            'begin' => $request->begin,
            'end' => $request->end,
            'days' => $request->days,
            'month' => $request->month,
            'years' => $request->years,
            'now' => now(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'DatetimeViewScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('platform::messages.datetime'),
            Layout::legend('', [
                Sight::make('begin'),
                Sight::make('end'),
                Sight::make('days'),
                Sight::make('month'),
                Sight::make('years'),
                Sight::make('now'),
                Sight::make('begin day')->render(function () {
                    return date_create(now()->format('Ymd'))->format(DateTimeInterface::ISO8601);
                }),
                Sight::make('end day')->render(function () {
                    return date_create(now()->modify('+1 day')->format('Ymd'))
                        ->modify('-1 second')
                        ->format(DateTimeInterface::ISO8601);
                }),
                Sight::make('Дата завтра')->render(function () {
                    return now()->modify('+1 day')->format('d M Y');
                }),
                Sight::make('Дата через неделю')->render(function () {
                    return now()->modify('+1 week')->format('d M Y');
                }),
                Sight::make('Дата через месяц')->render(function () {
                    return now()->modify('+1 month')->format('d M Y');
                }),
            ])->title(''),
        ];
    }
}

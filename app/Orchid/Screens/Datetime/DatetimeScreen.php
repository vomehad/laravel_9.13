<?php

namespace App\Orchid\Screens\Datetime;

use App\Http\Requests\DateRequest;
use App\Services\ExamService;
use DateTimeInterface;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class DatetimeScreen extends Screen
{
    private ExamService $service;

    public function __construct(ExamService $service)
    {
        $this->service = $service;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'DatetimeScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Datetime.Button.Diff'))
                ->method('showDiff')
                ->block()
                ->novalidate()
                ->icon('bag'),

            ModalToggle::make(__('Datetime.Button.Modal'))
                ->modal('diffTime')
                ->method('showDiff')
                ->icon('full-screen'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([

                DateTimer::make('begin')->title('begin')->enableTime()->format24hr(),

                DateTimer::make('end')->title('end')->enableTime()->format24hr(),

                Button::make('showDiff')
                    ->modal('diffTime')
                    ->method('showDiff')
                    ->type(Color::INFO()),

            ])->title('period'),

        ];
    }

    public function showDiff(DateRequest $request)
    {
        $dto = $request->createDto();

        [$begin, $end, $days, $month, $years] = $this->service->diffTwoDates($dto);

        return redirect()->route('platform.datetime.view', [
            'begin' => $begin->format(DateTimeInterface::ISO8601),
            'end' => $end->format(DateTimeInterface::ISO8601),
            'days' => $days,
            'month' => $month,
            'years' => $years,
        ]);
    }
}

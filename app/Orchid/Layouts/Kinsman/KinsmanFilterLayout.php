<?php

namespace App\Orchid\Layouts\Kinsman;

use App\Orchid\Filters\Kin\KinFilter;
use Orchid\Screen\Layouts\Selection;

class KinsmanFilterLayout extends Selection
{
    public function filters(): array
    {
        return [
            KinFilter::class,
        ];
    }
}

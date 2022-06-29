<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface InheritInterface
{
    public function getChildren(int $id)/*: ?Model*/;
}

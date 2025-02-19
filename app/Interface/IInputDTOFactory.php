<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface IInputDTOFactory
{
    public static function createFromRequest(Request $request);
}

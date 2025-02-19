<?php

declare(strict_types=1);

namespace App\Factory\Account;

use Illuminate\Http\Request;

use App\Interface\IInputDTOFactory;
use App\Dto\Account\GetOneAccountInput;

class GetOneAccountInputFactory implements IInputDTOFactory
{
    public static function createFromRequest(Request $request): GetOneAccountInput
    {
        // validations
        //

        return new GetOneAccountInput((int) $request->get('numero_conta'));
    }
}

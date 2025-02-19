<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Factory\Account\CreateAccountInputFactory;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function create(CreateAccountRequest $request)
    {
        $input = CreateAccountInputFactory::createFromRequest($request);

//        $useCase = new UseCase(Repository, Input);
//        $output = $useCase->execute($input);

//        return 200 & json
    }
}

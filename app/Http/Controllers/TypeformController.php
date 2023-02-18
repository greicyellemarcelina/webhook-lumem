<?php

namespace App\Http\Controllers;

use App\Services\BKOMessage;
use App\Services\SlackService;
use Laravel\Lumen\Http\Request;
use App\Services\TypeFormService;

class TypeformController extends Controller
{
    public function webhook(Request $request)
    {
        $typeForm = new TypeFormService($request->json()->all());

        if ($typeForm->hasCause("Não recebi o meu pedido")) {
            $slack = new SlackService();
            $message = new BKOMessage($typeForm);
            $slack->postMessage($message->toString());
        }
    }
}

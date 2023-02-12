<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Http\Request;
use App\Models\TypeFormResponse;

class TypeformController extends Controller
{
    public function webhook(Request $request)
    {
        $typeform = new TypeFormResponse($request->json()->all());
        
        return [
            "token" => $typeform->getToken(),
            "submitedAt" => $typeform->getSubmitedAt(),
            "nota" => $typeform->getNota(),
            "motivo" => $typeform->getMotivo(),
            "satisfacao" => $typeform->getSatisfacao(),
            "temComentario" => $typeform->getTemComentario(),
            "comentario" => $typeform->getComentario(),
            "order" => $typeform->getOrder(),
        ];
    }

  
}

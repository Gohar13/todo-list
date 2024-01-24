<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class GeneralJsonException extends Exception
{
    public function render($request): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage()
            ]
        ], $this->code);
    }
}

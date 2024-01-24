<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedApiCall extends GeneralJsonException
{
    protected $code = 401;

    protected $message = 'Unauthorized API call!';
}

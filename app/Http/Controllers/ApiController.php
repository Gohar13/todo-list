<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0"
 * ),
 * @OA\PathItem(
 *     path="/api/"
 * )
 * @OA\SecurityScheme(
 *      securityScheme="api_key",
 *      type="apiKey",
 *      in="header",
 *      name="API-KEY",
 *      description="API key for authentication",
 *  )
 */
class ApiController extends Controller
{
}

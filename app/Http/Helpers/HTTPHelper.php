<?php

namespace App\Helpers;
use Illuminate\Http\Request;


class HTTPHelper
{
    private $errorStatuses = [
        "1x002" => [
            "name" => "Unauthorized",
            "message" => "You don't have permission to access this resource",
            "HTTPCode" => 401,
        ],
        "1x003" => [
            "name" => "Bad Request",
            "message" => "You're request contains invalid or missing data",
            "HTTPCode" => 400
        ]
    ];

    // protected int $status;
    // protected string $code;
    // protected string $name;
    // protected string $message;
    // protected mixed $data;


    // TODO: Probably should add some logging features in here
    function __construct(string $code, string $message = null, mixed $data = null)
    {
        $statusInfo = self::$errorStatuses[$code];
        return response()->json([
            "name" => $statusInfo['name'],
            "message" => isset($message) ? $message : $statusInfo['message'],
            "code" => $code,
            "data" => isset($data) ? $data : null,
        ]);
    }

    public static function HTTPSuccessResponse(Request $request, $data = null)
    {
        return response()->json([
            "name" => null,
            "message" => null,
            "code" => "1x000",
            "data" => $data,
        ]);
    }

    public static function HTTPErrorResponse(Request $request, string $statusCode, string $customMessage = null)
    {
        $statusInfo = self::$errorStatuses[$statusCode];
        return response()->json([
            "name" => $statusInfo['name'],
            "message" => isset($customMessage) ? $customMessage : $statusInfo['message'],
            "code" => $statusCode,
            "data" => null,
        ]);
    }
}
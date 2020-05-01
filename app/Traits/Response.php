<?php

namespace App\Traits;

trait Response
{
    public function sendJson(array $data = [], string $message = "", $statusCode = 200) : object
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

}

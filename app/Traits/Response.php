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

    public function customPagination(string $table, object $paginated)
    {
        $data = $paginated->toArray();

        return collect([
            $table   => $data['data'],

            'pagination' => [
                'to'        => $data['to'],
                'from'      => $data['from'],
                'total'     => $data['total'],
                'per_page'  => $data['per_page'],
                'last_page' => $data['last_page'],
                'current_page'  => $data['current_page'],
                'last_page_url' => $data['last_page_url'],
                'next_page_url' => $data['next_page_url'],
                'prev_page_url' => $data['prev_page_url'],
                'first_page_url' => $data['first_page_url'],
            ]
        ]);
    }
}

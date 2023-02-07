<?php

namespace App\Traits\Api;

trait ResponseHandler
{
    protected $response = [
        'status' => 'success',
        'code' => 200,
    ];

    protected function errorResponse()
    {
        return [
            'status' => 'error',
            'code' => 403,
            'message' => 'Invalid token'
        ];
    }

    protected function response()
    {
        return response()->json($this->response, $this->response['code']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\IndexRequest;
use App\Services\Api\ApiService;
use App\Traits\Api\ResponseHandler;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    use ResponseHandler;

    private ApiService $service;

    public function __construct(ApiService $service)
    {
        $this->service = $service;
    }

    public function index(IndexRequest $request)
    {
        try {
            switch ($request->get('method'))
            {
                case 'rates':
                    $response = $this->rates($request->except('method'));
                    break;
                case 'convert':
                    $response = $this->convert($request->except('method'));
                    break;
            }

            $this->response['data'] = $response;
        } catch (\Throwable $e) {
            Log::info($e);
            $this->response = $this->errorResponse();
        } finally {
            return $this->response();
        }
    }

    private function rates(array $requestData)
    {
        return $this->service->rates($requestData);
    }

    private function convert(array $requestData)
    {
        return $this->service->convert($requestData);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Support\Response\Response;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * JsonResponse object to return data...
     *
     * @var $response null
     */
    protected $response = null;


    public function __construct()
    {
        $this->response = new Response();
    }

    public function setResponse($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }
}

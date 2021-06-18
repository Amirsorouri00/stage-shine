<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Optimus\Bruno\LaravelController;

class Controller extends LaravelController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Stageshine OpenApi Demo Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="amirsorouri26@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )
     *
     * @OA\Tag(
     *     name="Stageshine Project APIs",
     *     description="API Endpoints of the Project"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

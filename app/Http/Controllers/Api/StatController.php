<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Api\ApiController;
use App\Core\Services\StatService;
use App\Core\Transformers\StatTransformer;

/**
 * Class StatController
 * @package App\Http\Controllers\Api
 */
class StatController extends ApiController {

  /**
   * calls parent constructor and call jwt.auth middleware
   */
  function __construct(
  StatService $statService
  )
  {
    parent::__construct();
    $this->statService = $statService;
  }
  public function getStat(){
      $inputs = request()->all();
      $stats = $this->statService->getPlayerStats($inputs);
      return $this->respondWithPagination($stats,$inputs,new StatTransformer);
  }

}

<?php

namespace App\Core\Services;

use App\Core\Models\Roster;

class StatService {

  function __construct()
  {
  }

  function getPlayerStats($inputs){
     return Roster::paginate(5);
  }

}

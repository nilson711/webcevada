<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

      // Acesso a todas as rotas restrito a usuários autenticados.
      public function __construct()
      {
          $this->middleware('auth');
      }


    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($data = null) {
        if($data == null) {
            $data = [];
        }
        return array(
            'status' => 'success',
            'data' => $data
        );
    }

    public function fail($data) {
        return array(
            'status' => 'fail',
            'data' => $data
        );
    }
}

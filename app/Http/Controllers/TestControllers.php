<?php

namespace App\Http\Controllers;

use App\Http\Traits\ServiceAPI;
use Illuminate\Http\Request;

class TestControllers extends Controller
{
    use ServiceAPI;
    function index() {
        $data = $this->requestData('users');
        dd($data);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PHPConfController extends Controller
{
    public function php_info()
    {
        phpinfo();
    }
}

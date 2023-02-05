<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PHPConfController extends Controller
{
    public function php_info()
    {
        phpinfo();
    }
}

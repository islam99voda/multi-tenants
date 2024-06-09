<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;

class HomePAgeController extends Controller
{
    public function index()
    {
        dd(DB::getDefaultConnection());
    }
}

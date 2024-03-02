<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Penerimaan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lamaran()
    {
        return view('products/02_penerimaan.lamaran');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class manageSaleEntryController extends Controller
{
    public function manageSaleEntry(Request $request)
    {

        return view('layouts/manageSaleEntry');
    }
}

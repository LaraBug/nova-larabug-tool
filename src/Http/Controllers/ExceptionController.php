<?php

namespace Larabug\NovaLarabugTool\Http\Controllers;

use Illuminate\Routing\Controller;
use Larabug\NovaLarabugTool\Utilities\Larabug;

class ExceptionController extends Controller
{
    public function index()
    {
        $laraBug = new Larabug;

        return response()->json($laraBug->recentExceptions(request('page')));
    }

    public function show($id)
    {
        $laraBug = new Larabug;

        return response()->json($laraBug->getException($id));
    }
}

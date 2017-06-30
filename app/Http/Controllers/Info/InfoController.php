<?php

namespace App\Http\Controllers\info;

use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    /**
     * Show corporation info.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info()
    {
        return view('info.info');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Station;

class MainController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('frontend/home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function map()
    {
        return view('frontend/map');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function route($id)
    {
        $route = Route::findOrFail($id);
        return view('frontend/route', ['route' => $route]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function station($route_id, $arr_id)
    {

        $station = Station::with('route')
            ->where('route_id', $route_id)
            ->where('arr_id', $arr_id)
            ->first();

        return view('frontend/station', ['station' => $station, 'arr_id' => ($arr_id - 1)]);
    }
}

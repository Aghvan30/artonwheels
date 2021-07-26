<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Station;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function deleteRoute()
    {
        try {

//            $route = Route::get();
//            return view('backend/route/index', ['data' => $route]);
            return \request('id');
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    public function deleteRouteImg()
    {
        try {
            $route = Route::find(\request('id'));

            if (\request('img') == 'image') {
                $img_name = $route->image;
                $image = storage_path() . env('UPLOAD_STORAGE_PATH') . $img_name;
                if (file_exists($image))
                    unlink($image);
                $route->image = null;
            } else {
                $img_name = $route->image_map;
                $image = storage_path() . env('UPLOAD_STORAGE_PATH') . $img_name;
                if (file_exists($image))
                    unlink(storage_path() . env('UPLOAD_STORAGE_PATH') . $image);

                $route->image_map = null;
            }
            $route->save();
            return response()->json(['msg' => 'ok'], 200);

        } catch (\Throwable $e) {
            report($e);
            return response()->json(['msg' => $e], 500);
        }
    }

    public function deleteStationImg()
    {
        try {
            $route = Route::find(\request('id'));


            $img_name = json_decode($route->stations);

            $img = $img_name[\request('arr_id')]->img_name;
//dd(storage_path() . env('UPLOAD_STORAGE_PATH') . $img_name);
            unlink(storage_path() . env('UPLOAD_STORAGE_PATH') . $img);
            $img_name[\request('arr_id')]->img_name = "";
            $route->stations = json_encode($img_name);

            $route->save();
            return response()->json(['msg' => 'ok'], 200);

        } catch (\Throwable $e) {
            report($e);
            return response()->json(['msg' => $e], 500);
        }
    }

    public function deleteImg()
    {
        //todo transaction
        try {
            $station = Station::find(\request('id'));
            $img = $station->image;

            unlink(storage_path() . env('UPLOAD_STORAGE_PATH') . $img);

            $station->image = "";
            return $station->save() ?
                response()->json(['msg' => 'ok'], 200) :
                response()->json(['msg' => "error"], 500);

        } catch (\Throwable $e) {
            report($e);
            return response()->json(['msg' => $e], 500);
        }
    }

    public function getRouteById()
    {
        try {

            $route = Route::find(\request('id'));
            if (!empty($route))
                return response()->json(['data' => $route], 200);
            else
                return response()->json(['error' => 'error'], 500);
        } catch (\Throwable $e) {
            report($e);
            return response()->json(['msg' => $e], 500);
        }
    }
}

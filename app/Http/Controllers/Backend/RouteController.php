<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RouteEditRequest;
use App\Http\Requests\RouteRequest;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $routes = Route::get();
            return view('backend/route/index', ['data' => $routes]);

        } catch (\Throwable $e) {
            report($e);
            return redirect()->with('danger', __('messages.danger'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('backend/route/create');
        } catch (\Throwable $e) {
            report($e);
            return redirect()->with('danger', __('messages.danger'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {

        DB::beginTransaction();
        try {

            $imageName = __('messages.artonwheels') . '_' . time() . '.' . $request->image->extension();
            $imageMap = __('messages.artonwheels') . '_' . (time() +1). '.' . $request->image_map->extension();

            $station_img = $request->stations_img;
            $st = [];
            foreach ($request->stations as $index => $station) {
                $st[$index]['name'] = $station;

                $st[$index]['img_name'] = "station_".($index+1).".".$station_img[$index]->extension();
                $station_img[$index]->move(storage_path('app/public/upload'), $st[$index]['img_name']);
            }

            $request->image->move(storage_path('app/public/upload'), $imageName);
            $request->image_map->move(storage_path('app/public/upload'), $imageMap);
            $data = new Route();
            $data->title = $request['title'];
            $data->content = $request['content'];
            $data->image = $imageName;
            $data->image_map = $imageMap;
            $data->stations = json_encode($st, true);
            DB::commit();
            return ($data->save()) ?
                redirect('/backend/routes')->with('success', __('messages.success'))
                :
                redirect('/backend/routes')->with('danger', __('messages.danger'))->withInput();

        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Route::findOrFail($id);

            return view('backend/route/edit', compact('data'));
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(RouteEditRequest $request, $id)
    {

        try {
            $data = Route::find($id);
            if (!empty($request->image)) {
                $imageName = __('messages.artonwheels') . '_' . time() . '.' . $request->image->extension();
                $request->image->move(storage_path('app/public/upload'), $imageName);
                $data->image = $imageName;
            }
            if (!empty($request->image_map)) {
                $imageMap = __('messages.artonwheels') . '_' . time() . '.' . $request->image_map->extension();
                $request->image_map->move(storage_path('app/public/upload'), $imageMap);
                $data->image_map = $imageMap;
            }
            $station_img = $request->stations_img;

            $st = [];

            foreach ($request->stations as $index => $station) {
                $st[$index]['name'] = $station;

                if(!empty($request->stationsImg[$index])) {
                    $st[$index]['img_name'] = $request->stationsImg[$index];
                }
                if(!empty($station_img[$index])) {
                    $st[$index]['img_name'] = "station_" . ($index + 1) . "." . $station_img[$index]->extension();
                    $station_img[$index]->move(storage_path('app/public/upload'), $st[$index]['img_name']);
                }
            }
            $data->title = $request['title'];
            $data->content = $request['content'];
            $data->stations = json_encode($st, true);

            if ($data->save())
                return redirect('backend/routes')->with('success', __('messages.success'));
            else
                return back()->with('danger', __('messages.danger'))->withInput();

        } catch (\Throwable $e) {
            report($e);
            return redirect()->with('danger', __('messages.danger'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $route = Route::find($id);
            $route->delete();
            DB::commit();

            return redirect()->back()->with('success', __('messages.deleted'));
        }catch (\Throwable $e){
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //
            $stations = Station::get();
//            dd($stations);
            return view('backend/station/index', ['data' => $stations]);
//
        } catch (\Throwable $e) {
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'));
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
            $routes = Route::pluck('title', 'id');
            return view('backend/station/create', ['routes' => $routes]);
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStation()
    {
        try {
            $sts = Route::select('stations')
                ->where('id', \request('id'))->first();
            $sts = json_decode($sts->stations);

            $data = $sts[\request('step')];

            $data->id = \request('id');
            $data->arr_id = \request('step');

            return view('backend/station/add_station', ['data' => $data]);
        } catch (\Throwable $e) {
            report($e);
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//dd($request);
        DB::beginTransaction();
        try {
            $data = new Station();
            if (!empty($request->image)) {
                $image = __('messages.artonwheels') . '_' . time() . '.' . $request->image->extension();
                $request->image->move(storage_path('app/public/upload'), $image);
                $data->image = $image;
            }

            $data = $this->saveToData($data, $request);

            DB::commit();
            return ($data->save()) ?
                redirect('/backend/stations')->with('success', __('messages.success'))
                :
                redirect('/backend/stations')->with('danger', __('messages.danger'))->withInput();

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
    public
    function edit($id)
    {
        try {

            $data = Station::findOrFail($id);
            //   dd($data);

            return view('backend/station/edit', compact('data'));
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
    public function update(Request $request, $id)
    {


        DB::beginTransaction();
        try {
            $data = Station::find($id);

            if (!empty($request->image)) {

                $image = __('messages.artonwheels') . '_' . time() . '.' . $request->image->extension();
                $request->image->move(storage_path('app/public/upload'), $image);
                $data->image = $image;
            }
            $data = $this->saveToData($data, $request);


            DB::commit();
            return ($data->save()) ?
                redirect('/backend/stations')->with('success', __('messages.success'))
                :
                redirect('/backend/stations')->with('danger', __('messages.danger'))->withInput();
        } catch (\Throwable $e) {
            dd($e);
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = Station::find($id);
            $image_path = 'app/public/upload' . $data->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $data->delete();

            DB::commit();
            return redirect()->back()->with('success', __('messages.deleted'));
        } catch (\Throwable $e) {
            dd($e);
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }

    public function saveToData($data, $request)
    {
        $data->route_id = $request['id'];
        $data->arr_id = $request['arr_id'];
        $data->title = $request['title'];
        $data->content = $request['content'];
        $data->lang = $request['lang'];
        $data->lat = $request['lat'];

        $data->map_coordinates = $request['google_map'];
        return $data;
    }
}

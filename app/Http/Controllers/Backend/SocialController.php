<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        try {
            $socials = Social::get();
            return view('backend/social/index', ['socials' => $socials]);
        }catch (\Throwable $e){
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
            return view('backend/social/add');
        }catch (\Throwable $e){
            report($e);
            return false;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $social = new Social();
            $social->name = $request['name'];
            $social->link = $request['link'];
            DB::commit();
            $social->save();
            return redirect('/backend/social')->with('success', __('messages.success'));
        }catch (\Throwable $e){
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $edit = Social::findOrFail($id);
            return view('backend/social/edit', ['edit' => $edit]);
        }catch (\Throwable $e){
            report($e);
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $update = Social::find($id);
            $update->name = $request['name'];
            $update->link = $request['link'];
            $update->save();
            DB::commit();

            return redirect('/backend/social')->with('success', __('messages.success'));
        }catch (\Throwable $e){
            DB::rollBack();
            report($e);

            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $social = Social::find($id);
            $social->delete();
            DB::commit();

            return redirect()->back()->with('success', __('messages.deleted'));
        }catch (\Throwable $e){
            DB::rollBack();
            report($e);
            return redirect()->back()->with('danger', __('messages.danger'))->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $redirectTo = '/backend';

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::get();

        return view('backend/user/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {


        return view('backend/user/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $use = new User();
        $use->name = $request['name'];
        $use->email = $request['email'];
        $use->password = Hash::make($request['password']);
        $use->save();
        return redirect('/backend/users');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = User::findOrFail($id);

        return view('backend/user/edit-user', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|string
     */
    public function update(Request $request, $id)
    {
        try {

            $user = User::find($id);
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return redirect()->route('logout');

        } catch (\Throwable $e) {
            report($e) . 'errr';

            return false;
        }

//            $user->update();
//
//            return redirect('/backend/users')->with('status', 'Update date');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function editPass($id)
    {
        $edit = User::findOrFail($id);

        return view('backend/user/change-password', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|string
     */
    public function changePass(Request $request)
    {
        try {


            $user = User::find($request['id']);
            $old_pass = $request['old_pass'];
            $new_pass = $request['new_pass'];
            $confirm_Pass = $request['c_pass'];

            $db_pass = Auth::User()->password;

            if (Hash::check($old_pass, $db_pass)) {
                if ($new_pass === $confirm_Pass) {
                    $user->password = Hash::make($new_pass);
                    $user->save();
                    return redirect()->route('logout');
                }
            } else {
                return redirect()->back()->with('danger', __('messages.old_pass_error'));

            }
        } catch (\Throwable $e) {
            report($e) . 'errr';

            return false;
        }

//            $user->update();
//
//            return redirect('/backend/users')->with('status', 'Update date');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/backend/users')->with('status', 'delete User');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::select("*");

        if ($request->has('trashed')) {
            $users = $users->onlyTrashed();
        }

        $users = $users->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);

        Password::sendResetLink($request->only(['email']));

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        if ($user->save()){
            $request->session()->flash('success', __('users.controller.create.success'));
        }else{
            $request->session()->flash('error', __('users.controller.create.error'));
        }

        return redirect(route('admin.users.index'));
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
        return view(
            'users.edit',
            [
                'user' => User::find($id)
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $request->session()->flash('error', __('users.controller.update.not_found'));
            return redirect(route('admin.users.index'));
        }

        $user->fill($request->only(['name', 'email']));
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        if ($user->save()){
            $request->session()->flash('success', __('users.controller.update.success'));
        }else{
            $request->session()->flash('error', __('users.controller.update.error'));
        }

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            $request->session()->flash('success', __('users.controller.delete.success'));
        }else{
            $request->session()->flash('error', __('users.controller.delete.not_found'));
        }

        return redirect(route('admin.users.index'));
    }

    /**
     * restore specific user
     *
     * @return void
     */
    public function restore($id, Request $request)
    {
        User::withTrashed()->find($id)->restore();

        $request->session()->flash('success', trans_choice('users.controller.restore.success',1));
        return redirect(route('admin.users.index'));
    }

    /**
     * restore all user
     *
     * @return response()
     */
    public function restoreAll(Request $request)
    {
        User::onlyTrashed()->restore();

        $request->session()->flash('success', trans_choice('users.controller.restore.success',2));
        return redirect(route('admin.users.index'));
    }
}

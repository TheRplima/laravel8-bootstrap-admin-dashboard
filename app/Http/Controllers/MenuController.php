<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request){
        if($request->parent_id == null){
            $request->parent_id = 0;
            $parent_title = '';
        }else{
            $parent_title = ' > '.(__('menus.subs_of')).' '.Menu::find($request->parent_id)->title;
        }
        $menus = Menu::select("*")->where('parent_id', '=', $request->parent_id);
        $menus = $menus->paginate(10);

        return view('menus.index', compact('menus','parent_title'));
    }

    public function create(){
        $menus = Menu::where('parent_id', '=', 0)->get();
        $allMenus = Menu::pluck('title','id')->all();
        return view('menus.create',compact('menus','allMenus'));
    }

    public function store(Request $request)
    {
        $menu = new Menu;
        $menu->fill($request->except(['_token']));
        $menu->parent_id = empty($request->parent_id) ? 0 : $request->parent_id;

        if ($menu->save()){
            $request->session()->flash('success', __('menus.controller.create.success'));
        }else{
            $request->session()->flash('error', __('menus.controller.create.error'));
        }

        return redirect(route('admin.menus.index'));
    }

    public function show(Menu $menu)
    {
        $menus = Menu::where('parent_id', '=', $menu)->get();
        return view('menus.show',compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $allMenus = Menu::pluck('title','id')->all();

        return view(
            'menus.edit',
            [
                'menu' => $menu,
                'allMenus' => $allMenus
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Menu $menu, Request $request)
    {
        // $menu = Menu::find($id);

        if (!$menu) {
            $request->session()->flash('error', __('menus.controller.update.not_found'));
            return redirect(route('admin.menus.index'));
        }

        $menu->fill($request->except(['_token']));

        if ($menu->save()){
            $request->session()->flash('success', __('menus.controller.update.success'));
        }else{
            $request->session()->flash('error', __('menus.controller.update.error'));
        }

        return redirect(route('admin.menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, Request $request)
    {
        // $menu = Menu::find($id);
        if($menu){
            Menu::destroy($menu->id);
            $request->session()->flash('success', __('menus.controller.delete.success'));
        }else{
            $request->session()->flash('error', __('menus.controller.delete.not_found'));
        }

        return redirect(route('admin.menus.index'));
    }
}

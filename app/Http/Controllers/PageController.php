<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{

    function __construct()
    {
        // set permission
         $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','show']]);
         $this->middleware('permission:page-create', ['only' => ['create','store']]);
         $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->parent_id == null){
            $request->parent_id = 0;
            $parent_title = '';
        }else{
            $parent_title = ' > '.(__('pages.subs_of')).' '.Page::find($request->parent_id)->title;
        }
        $pages = Page::select("*")->where('parent_id', '=', $request->parent_id);

        if ($request->has('trashed')) {
            $pages = Page::select("*")->onlyTrashed();
        }

        $pages = $pages->paginate(10);

        return view('pages.index', compact('pages','parent_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->fill($request->except(['_token']));
        $page->slug = Str::slug($request->title, '-');

        if ($page->save()){
            $request->session()->flash('success', __('pages.controller.create.success'));
        }else{
            $request->session()->flash('error', __('pages.controller.create.error'));
        }

        return redirect(route('admin.pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view(
            'pages.edit',
            [
                'page' => $page
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page, Request $request)
    {
        // $page = Page::find($id);

        if (!$page) {
            $request->session()->flash('error', __('pages.controller.update.not_found'));
            return redirect(route('admin.pages.index'));
        }

        $page->fill($request->except(['_token']));
        $page->slug = Str::slug($request->title, '-');
        if ($page->save()){
            $request->session()->flash('success', __('pages.controller.update.success'));
        }else{
            $request->session()->flash('error', __('pages.controller.update.error'));
        }

        return redirect(route('admin.pages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, Request $request)
    {
        // $page = Page::find($id);
        if($page){
            $page->delete();
            $request->session()->flash('success', __('pages.controller.delete.success'));
        }else{
            $request->session()->flash('error', __('pages.controller.delete.not_found'));
        }

        return redirect(route('admin.pages.index'));
    }

    /**
     * restore specific page
     *
     * @return void
     */
    public function restore(Request $request)
    {
        $page = Page::where('slug',$request->page);
        $page->restore();
        $request->session()->flash('success', trans_choice('pages.controller.restore.success',1));
        return redirect(route('admin.pages.index'));
    }

    /**
     * restore all page
     *
     * @return response()
     */
    public function restoreAll(Request $request)
    {
        Page::onlyTrashed()->restore();

        $request->session()->flash('success', trans_choice('pages.controller.restore.success',2));
        return redirect(route('admin.pages.index'));
    }
}

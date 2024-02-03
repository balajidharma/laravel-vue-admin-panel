<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BalajiDharma\LaravelAdminCore\Requests\StoreMenuRequest;
use BalajiDharma\LaravelAdminCore\Requests\UpdateMenuRequest;
use BalajiDharma\LaravelMenu\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:menu list', ['only' => ['index']]);
        $this->middleware('can:menu create', ['only' => ['create', 'store']]);
        $this->middleware('can:menu edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:menu delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $menus = (new Menu)->newQuery();

        if (request()->has('search')) {
            $menus->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $menus->orderBy($attribute, $sort_order);
        } else {
            $menus->latest();
        }

        $menus = $menus->paginate(config('admin.paginate.per_page'))
                    ->onEachSide(config('admin.paginate.each_side'))
                    ->appends(request()->query());

        return Inertia::render('Admin/Menu/Index', [
            'menus' => $menus,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('menu create'),
                'edit' => Auth::user()->can('menu edit'),
                'delete' => Auth::user()->can('menu delete'),
                'manage' => Auth::user()->can('menu.item index'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Menu/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMenuRequest $request)
    {
        Menu::create([
            'name' => $request->name,
            'machine_name' => $request->machine_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.menu.index')
            ->with('message', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Menu $menu)
    {
        return Inertia::render('Admin/Menu/Edit', [
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $menu->update($request->all());

        return redirect()->route('admin.menu.index')
            ->with('message', 'Menu updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menu.index')
            ->with('message', __('Menu deleted successfully'));
    }
}

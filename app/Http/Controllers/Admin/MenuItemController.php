<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BalajiDharma\LaravelAdminCore\Requests\StoreMenuItemRequest;
use BalajiDharma\LaravelAdminCore\Requests\UpdateMenuItemRequest;
use BalajiDharma\LaravelMenu\Models\Menu;
use BalajiDharma\LaravelMenu\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:menu.item list', ['only' => ['index', 'show']]);
        $this->middleware('can:menu.item create', ['only' => ['create', 'store']]);
        $this->middleware('can:menu.item edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:menu.item delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Menu $menu)
    {
        $items = (new MenuItem)->toTree($menu->id, true);

        return Inertia::render('Admin/Menu/Item/Index', [
            'menu' => $menu,
            'items' => $items,
            'can' => [
                'create' => Auth::user()->can('menu.item create'),
                'edit' => Auth::user()->can('menu.item edit'),
                'delete' => Auth::user()->can('menu.item delete'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Menu $menu)
    {
        $item_options = MenuItem::selectOptions($menu->id, null, true);

        return Inertia::render('Admin/Menu/Item/Create', [
            'menu' => $menu,
            'item_options' => $item_options,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMenuItemRequest $request, Menu $menu)
    {
        $menu->menuItems()->create($request->all());

        return redirect()->route('admin.menu.item.index', $menu->id)
            ->with('message', 'Menu created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Inertia\Response
     */
    public function edit(Menu $menu, MenuItem $item)
    {
        $item_options = MenuItem::selectOptions($menu->id, $item->parent_id ?? $item->id);

        return Inertia::render('Admin/Menu/Item/Edit', [
            'menu' => $menu,
            'item' => $item,
            'item_options' => $item_options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMenuItemRequest $request, Menu $menu, MenuItem $item)
    {
        $item->update($request->all());

        return redirect()->route('admin.menu.item.index', $menu->id)
            ->with('message', 'Menu Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BalajiDharma\LaravelMenu\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Menu $menu, MenuItem $item)
    {
        $item->delete();

        return redirect()->route('admin.menu.item.index', $menu->id)
            ->with('message', __('Menu deleted successfully'));
    }
}

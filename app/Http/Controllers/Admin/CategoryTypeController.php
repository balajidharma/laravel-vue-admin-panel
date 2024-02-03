<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BalajiDharma\LaravelAdminCore\Requests\StoreCategoryTypeRequest;
use BalajiDharma\LaravelAdminCore\Requests\UpdateCategoryTypeRequest;
use BalajiDharma\LaravelCategory\Models\CategoryType;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CategoryTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:category.type list', ['only' => ['index']]);
        $this->middleware('can:category.type create', ['only' => ['create', 'store']]);
        $this->middleware('can:category.type edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:category.type delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $categoryTypes = (new CategoryType)->newQuery();

        if (request()->has('search')) {
            $categoryTypes->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $categoryTypes->orderBy($attribute, $sort_order);
        } else {
            $categoryTypes->latest();
        }

        $categoryTypes = $categoryTypes->paginate(config('admin.paginate.per_page'))
                                ->onEachSide(config('admin.paginate.each_side'));

        return Inertia::render('Admin/Category/Type/Index', [
            'categoryTypes' => $categoryTypes,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('category.type create'),
                'edit' => Auth::user()->can('category.type edit'),
                'delete' => Auth::user()->can('category.type delete'),
                'manage' => Auth::user()->can('category index'),
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
        return Inertia::render('Admin/Category/Type/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryTypeRequest $request)
    {
        if (! $request->has('is_flat')) {
            $request['is_flat'] = false;
        }

        CategoryType::create([
            'name' => $request->name,
            'machine_name' => $request->machine_name,
            'description' => $request->description,
            'is_flat' => $request->is_flat,
        ]);

        return redirect()->route('admin.category.type.index')
            ->with('message', 'Category type created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BalajiDharma\LaravelCategory\Models\CategoryType  $categoryType
     * @return \Inertia\Response
     */
    public function edit(CategoryType $type)
    {
        return Inertia::render('Admin/Category/Type/Edit', [
            'categoryType' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \BalajiDharma\LaravelCategory\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryTypeRequest $request, CategoryType $type)
    {
        if (! $request->has('is_flat')) {
            $request['is_flat'] = false;
        }

        $type->update($request->all());

        return redirect()->route('admin.category.type.index')
            ->with('message', 'Category type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BalajiDharma\LaravelCategory\Models\CategoryType  $categoryType
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CategoryType $type)
    {
        $type->delete();

        return redirect()->route('admin.category.type.index')
            ->with('message', __('Category type deleted successfully'));
    }
}

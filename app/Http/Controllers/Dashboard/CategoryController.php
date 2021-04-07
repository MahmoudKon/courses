<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_categories'])->only(['index']);
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only(['destroy']);
    } // end of constructor

    public function index(Request $request)
    {
        $count = Category::count();
        return view('dashboard.categories.index', compact('count'));
    } // end of index page

    public function show(Request $request)
    {
        if($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = Category::when($request->search, function ($q) use ($request) {
                return $q->whereTranslationLike($request->columnName, '%' . $request->search . '%');
            })->latest()->paginate($paginate);
            return view('dashboard.categories.rows', compact('rows'));
        endif;
    } // end of show all rows by ajax

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create page

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        $request->validate($rules);

        Category::create($request->all());
        alert()->success(__('site.created_succesfuly'), __('site.good_job'));
        return redirect()->route('dashboard.categories.index');
    } // end of store the new row

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    } // end of edit page

    public function update(Request $request, Category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];

        }//end of for each
        $request->validate($rules);
        $category->update($request->all());
        alert()->success(__('site.updated_succesfuly'), __('site.good_job'));
        return redirect()->route('dashboard.categories.index');
    } // end of update the row

    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.categories.index');
    } //end of destroy the single row or multi rows

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        Category::whereIn('id', $ids)->delete();

        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.categories.index');
    } // end of destroy multi rows

} // end of controller

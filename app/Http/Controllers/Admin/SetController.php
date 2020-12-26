<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use App\Http\Requests\StoreSet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {


        $search = $request->input('search');;
        $sets = Set::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('category_id')
            ->paginate();


        return view('admin/set/index', ['sets' => $sets, 'search' => $search]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()

    {
        $companies = Company::all(['id', 'title']);
        $parentCategories = Category::whereNull('parent_id')->get();
        $nestedCategories = Category::whereNotNull('parent_id')->get();

        return view('admin/set/create', [
            'nestedCategories' => $nestedCategories,
            'parentCategories' => $parentCategories,
            'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSet $request
     * @return Response
     */
    public function store(StoreSet $request)
    {
        $set = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->code);
            $set = array_merge($set, ['slug' => $slug]);
        }
        $set = Set::create($set);
        if (!empty($request->file('image'))) {
            $set->addMediaFromRequest('image')
                ->preservingOriginal()
//            ->usingName()
                ->toMediaCollection('sets');
        }
        return redirect()->route('set.index')->with('message', 'комплект успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param Set $set
     * @return Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Set $set
     * @return Response
     */
    public function edit(Set $set)
    {
        $image = $set->getFirstMedia('sets');
        if (!empty($image)) {
            $image = $image->getUrl();
        } else {
            $image = Storage::url('0/no_photo.png');
        }


        $companies = Company::all(['id', 'title']);
        $parentCategories = Category::whereNull('parent_id')
            ->with('nestedCategories')
            ->get();
        $nestedCategories = Category::whereNotNull('parent_id')->get();

        return view('admin/set/edit', [
            'set' => $set,
            'companies' => $companies,
            'parentCategories' => $parentCategories,
            'nestedCategories' => $nestedCategories,
            'image' => $image]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSet $request
     * @param Set $set
     * @return Response
     */
    public function update(StoreSet $request, Set $set)
    {
        $data = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->code);
            $data = array_merge($data, ['slug' => $slug]);
        }

        $set->update($data);

        if (!empty($request->file('image'))) {

            if (!empty($set->getFirstMedia('sets'))) {
                $set->getFirstMedia('sets')->delete();
            }
            $set->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('sets');
        }
        return redirect()->route('set.index')->with('message', 'успешно изменено!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Set $set
     * @return Response
     * @throws Exception
     */
    public function destroy(Set $set)
    {
        $set->delete();


        return redirect()->route('set.index')->with('message', 'успешно удалено!!!');
    }
}

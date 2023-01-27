<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::paginate(3)
        ]);
    }

    public function trashedProducts(): View
    {
        $trashedProducts = Product::onlyTrashed()->orderBy('deleted_at')->paginate(3);
        return view('products.trash', [
            'products' => $trashedProducts,
        ]);
    }

    public function restore($id)
    {
        $restoreProducts = Product::withTrashed()->findOrFail($id);
        if (!empty($restoreProducts)) {
            $restoreProducts->restore();
        }
        return redirect(route('products.trash'))->with("success", "Product has been restored");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->save();
        return redirect(route('products.index'))->with("success", "Product has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();
        return redirect(route('products.index'))->with("success", "Product has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        try {
            $product->delete();
            return redirect(route('products.index'))->with("success", "Product has been deleted");

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
            ])->setStatusCode(500);
        }
    }

    public function destroyPermanently($id)
    {
        try {
            $deletePermanently = Product::withTrashed()->findOrFail($id);
            if (!empty($deletePermanently)) {
                $deletePermanently->forceDelete();
            }


        } catch (\Exception $exception) {

            return response()->json([
                'status' => 'error',
            ])->setStatusCode(500);
        }
    }
}

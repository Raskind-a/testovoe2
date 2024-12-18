<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMailNotification;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    ) {}

    public function index(): View
    {
        $products = Product::query()->get();

        return view('admin.index', [
            'products' => $products
        ]);
    }

    public function edit(Product $product): View
    {
        return view('admin.edit', [
            'product' => $product
        ]);
    }

    public function show(Product $product): View
    {
        return view('admin.show', [
            'product' => $product
        ]);
    }

    public function create(): View
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'article' => 'required|string|regex:/^[a-z]+$/i|unique:products',
            'name' => 'required|string|min:10',
            'status' => 'required|boolean',
            'attribute' => 'nullable|array'
        ]);

        $json = $this->service
            ->getJsonAttributes($request->input('attribute'));

        $request->input('status')?$status = 'available':$status = 'unavailable';

        $product = Product::query()
            ->create([
                'article' => $request->input('article'),
                'name' => $request->input('name'),
                'status' => $status,
                'data' => $json
            ]);
        $product->save();

        ProcessMailNotification::dispatch($product)->onQueue('emails');

        return view('admin.show', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'article' => 'required|string|regex:/^[a-z]+$/i',
            'name' => 'required|string|min:10',
            'status' => 'required|boolean',
            'data' => 'nullable|array'
        ]);

        $json = $this->service
            ->getJsonAttributes($request->input('data'));

        $request->input('status')?$status = 'available':$status = 'unavailable';
        $validatedData['status'] = $status;
        $validatedData['data'] = $json;

        $product->update($validatedData);

        return view('admin.show', ['product' => $product]);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ArticleRequest;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    //
    public function index()
    {
        $blogs = $this->productRepository->getAll();
        return view('welcome', compact('blogs'));
    }

    public function home()
    {
        $blogs = $this->productRepository->getAll();
        return view('public', compact('blogs'));
    }

    public function public()
    {
        $products = Product::all();
        return view('public', compact('products'));
    }

    public function store(ArticleRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string',
        //     'stock' => 'required|integer',
        // ]);

        $product = Product::create([
            'title' => $request->title,
            'content' => $request->content,
            'stock' => $request->stock,
        ]);

        // $product = Product::create([$request]);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }
}

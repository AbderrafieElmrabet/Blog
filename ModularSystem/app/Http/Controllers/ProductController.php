<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Product;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use AuthorizesRequests;
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
            'user_id' => Auth::id()
        ]);

        $product->created_at = $product->created_at->format('Y-m-d H:i:s');

        // $product = Product::create([$request]);
        $product->load('user');
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();
        return response()->json(['message' => 'Blog deleted successfully']);
    }
}

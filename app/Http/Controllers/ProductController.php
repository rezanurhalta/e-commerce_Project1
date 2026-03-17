<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class ProductController extends Controller
{
    public function index():View {
        $products=Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }
    public function create():View {
        return view('products.create');
    }
    public function store(Request $request):RedirectResponse{
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg|max:10048',
            'title'=>'required|min:5',
            'description'=>'required|min:10',
            'price'=>'required|numeric',
            'stock'=>'required|numeric',
        ]);

        $image=$request->file('image');
       $image->storeAs('products', $image->hashName());

        Product::create([
            'image'=>$image->hashName(),
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'stock'=>$request->stock,
        ]);

        return redirect()->route('products.index')
            ->with(['success', 'Product BERHASIL dibuat.']);
    }
    public function destroy($id):RedirectResponse   {
        $product=Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with(['Berhasil', 'Product BERHASIL dihapus.']);
    }
    public function show(string $id):View {
        $product=Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    public function edit(string $id):View {
        $product=Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    
   public function update(Request $request, string $id): RedirectResponse
{
    $request->validate([
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:10048',
        'title'       => 'required|min:5',
        'description' => 'required|min:10',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
    ]);

    $product = Product::findOrFail($id);

    $data = [
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'stock'       => $request->stock,
    ];

    if ($request->hasFile('image')) {
        Storage::delete('products/' . $product->image);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        $data['image'] = $image->hashName();
    }

    $product->update($data);

    return redirect()->route('products.index')
        ->with('success', 'Product BERHASIL diupdate.');
}

    
}

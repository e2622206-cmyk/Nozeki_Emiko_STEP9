<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Like;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('user_id', '!=', auth()->id());

        if ($request->product_name) {
            $query->where(
                'product_name',
                'like',
                '%' . $request->product_name . '%'
            );
        }

        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'asc')->get();

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function sellerShow($id)
{
    $product = Product::findOrFail($id);

    return view('products.seller-show', compact('product'));
}

public function edit($id)
{
    $product = Product::findOrFail($id);

    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required',
        'price' => 'required|integer|min:0',
        'description' => 'required',
        'stock' => 'required|integer|min:0',
    ]);

    $product = Product::findOrFail($id);

    $product->product_name = $request->product_name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->stock = $request->stock;

    if ($request->hasFile('image')) {
        $product->img_path = $request->file('image')
            ->store('products', 'public');
    }

    $product->save();

    return redirect('/products/' . $id . '/seller');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);

    Sale::where('product_id', $id)->delete();

    $product->delete();

    return redirect('/mypage')
        ->with('message', '商品を削除しました');
}

    public function purchaseForm($id)
    {
        $product = Product::findOrFail($id);

        return view('products.purchase', compact('product'));
    }

    public function purchase(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $product = Product::findOrFail($id);

        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            return redirect('/products/' . $id . '/purchase');
        }

        $product->stock = $product->stock - $quantity;
        $product->save();

        Sale::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect('/products/' . $id)
            ->with('message', '購入が完了しました');
    }

    public function like($id)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();
    
        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
            ]);
        }
    
        return redirect('/products/' . $id);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|integer|min:0',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
            'image' => 'required',
        ]);
    
        $imgPath = '';

        if ($request->hasFile('image')) {
            $imgPath = $request->file('image')
                ->store('products', 'public');
        }

        Product::create([
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $imgPath,
        ]);

        return redirect('/mypage');
    }

    public function mypage()
    {
        $user = auth()->user();
    
        $products = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();
    
            $sales = Sale::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    
        return view('products.mypage', compact('user', 'products', 'sales'));
    }

    public function accountEdit()
{
    $user = auth()->user();

    return view('products.account-edit', compact('user'));
}

public function accountUpdate(Request $request)

{$request->validate([
    'name' => 'required',
    'email' => 'required|email',
    'name_kanji' => 'required',
    'name_kana' => 'required',
]);
    $user = auth()->user();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->name_kanji = $request->name_kanji;
    $user->name_kana = $request->name_kana;

    $user->save();

    return redirect('/mypage');
}

public function inquiry()
{
    return view('products.inquiry');
}
public function inquirySend(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'content' => 'required',
    ]);

    return redirect('/products');
}
}
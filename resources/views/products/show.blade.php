<x-app-layout>
@if (session('message'))
    <p>{{ session('message') }}</p>
@endif

<h1>商品詳細</h1>

<p>商品名：{{ $product->product_name }}</p>

<p>説明：{{ $product->description }}</p>

<p>画像：</p>
@if ($product->img_path)
    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="300">
@endif

<p>金額：￥{{ number_format($product->price) }}</p>

<p>会社：{{ $product->company->company_name }}</p>

@if ($product->likes->where('user_id', auth()->id())->isNotEmpty())
    <form action="/products/{{ $product->id }}/like" method="POST">
        @csrf
        <button type="submit" style="border: none; background: none; padding: 0; font-size: 30px; color: red;">
            ♥
        </button>
    </form>
@else
    <form action="/products/{{ $product->id }}/like" method="POST">
        @csrf
        <button type="submit" style="border: none; background: none; padding: 0; font-size: 30px;">
            ♡
        </button>
    </form>
@endif

<form action="/products/{{ $product->id }}/purchase" method="GET">
    <button type="submit">カートに追加する</button>
</form>

<form action="/products" method="GET">
    <button type="submit">戻る</button>
</form>
</x-app-layout>
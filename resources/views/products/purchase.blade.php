<x-app-layout>
<h1>購入画面</h1>

<p>商品名：{{ $product->product_name }}</p>

<p>説明：{{ $product->description }}</p>

<p>画像：</p>
@if ($product->img_path)
    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="300">
@endif

<form action="/products/{{ $product->id }}/purchase" method="POST">
    @csrf

    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}">

    <p>金額：￥{{ number_format($product->price) }}</p>

    <p>残り：{{ $product->stock }}</p>

    <p>会社：{{ $product->company->company_name }}</p>


    @if ($product->stock > 0)
    <button type="submit">購入する</button>
@else
    <button type="button" disabled>売り切れ</button>
@endif
</form>

<form action="/products/{{ $product->id }}" method="GET">
    <button type="submit">戻る</button>
</form>
</x-app-layout>
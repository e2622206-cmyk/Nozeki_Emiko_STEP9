<x-app-layout>
<h1>出品商品詳細</h1>

<p>商品名：{{ $product->product_name }}</p>

<p>説明：{{ $product->description }}</p>

<p>画像：</p>
@if ($product->img_path)
    <img src="{{ asset('storage/' . $product->img_path) }}"
         alt="商品画像"
         width="300">
@endif

<p>金額：￥{{ number_format($product->price) }}</p>

<form action="/products/{{ $product->id }}/edit" method="GET" style="display:inline;">
    <button type="submit">編集</button>
</form>

<form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')

    <button type="submit"
            onclick="return confirm('本当に削除しますか？')">
        削除する
    </button>
</form>

<button type="button" onclick="location.href='/mypage'">
    戻る
</button>
</x-app-layout>
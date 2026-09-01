<x-app-layout>
<h1>出品商品編集</h1>

<form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="product_name">商品名</label><br>
        <input
            type="text"
            id="product_name"
            name="product_name"
            value="{{ old('product_name', $product->product_name) }}"
        >
    </div>

    <div>
        <label for="price">価格</label><br>
        <input
            type="number"
            id="price"
            name="price"
            value="{{ old('price', $product->price) }}"
        >
    </div>

    <div>
        <label for="description">商品説明</label><br>
        <textarea
            id="description"
            name="description"
            rows="5"
        >{{ old('description', $product->description) }}</textarea>
    </div>

    <div>
        <label for="stock">在庫数</label><br>
        <input
            type="number"
            id="stock"
            name="stock"
            value="{{ old('stock', $product->stock) }}"
        >
    </div>

    <div>
        <p>商品画像</p>

        @if ($product->img_path)
            <img
                src="{{ asset('storage/' . $product->img_path) }}"
                alt="商品画像"
                width="150"
            >
        @endif

        <input
            type="file"
            id="image"
            name="image"
        >
    </div>

    <br>

    <button type="button" onclick="location.href='/products/{{ $product->id }}/seller'">戻る</button>
    <button type="submit">更新</button>
</form>
</x-app-layout>
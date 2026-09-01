<x-app-layout>
<h1>商品一覧</h1>

<form action="/products" method="GET">
    <input type="text" name="product_name" placeholder="商品名を入力">

    <input type="number" name="min_price" placeholder="最低価格">

    <span>～</span>

    <input type="number" name="max_price" placeholder="最高価格">

    <button type="submit">検索</button>
</form>

<table>
    <thead>
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
            <th>画像</th>
            <th>料金(￥)</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>

                <td>
                    @if ($product->img_path)
                        <img
                            src="{{ asset('storage/' . $product->img_path) }}"
                            alt="商品画像"
                            width="80"
                        >
                    @endif
                </td>

                <td>{{ number_format($product->price) }}</td>

                <td>
                    <form action="/products/{{ $product->id }}" method="GET">
                        <button type="submit">詳細</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>
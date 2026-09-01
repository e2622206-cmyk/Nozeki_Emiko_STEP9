<x-app-layout>
<h1>マイページ</h1>

<div>
<a href="/account/edit">
    <button type="button">アカウント編集</button>
</a>
</div>

<div>
    <div>
        <p>ユーザ名：{{ $user->name }}</p>
        <p>Eメール：{{ $user->email }}</p>
    </div>

    <div>
        <p>名前：{{ $user->name_kanji }}</p>
        <p>カナ：{{ $user->name_kana }}</p>
    </div>
</div>

<h3>＜出品商品＞</h3>

<a href="/products/create">
    <button type="button">新規登録</button>
</a>

<table>
    <thead>
        <tr>
            <th>商品番号</th>
            <th>商品名</th>
            <th>商品説明</th>
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
            <td>{{ number_format($product->price) }}</td>
            <td>
    <a href="/products/{{ $product->id }}/seller">
        <button type="button">詳細</button>
    </a>
</td>
        </tr>
    @endforeach
</tbody>
</table>

<h3>＜購入した商品＞</h3>

<table>
    <thead>
        <tr>
            <th>商品名</th>
            <th>商品説明</th>
            <th>料金(￥)</th>
            <th>個数</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($sales as $sale)
        <tr>
            <td>{{ $sale->product->product_name }}</td>
            <td>{{ $sale->product->description }}</td>
            <td>{{ number_format($sale->product->price) }}</td>
            <td>{{ $sale->quantity }}</td>
        </tr>
    @endforeach
</tbody>
</table>
</x-app-layout>
<x-app-layout>
<h1>商品登録</h1>

<form action="/products" method="POST" enctype="multipart/form-data">
    @csrf

    <p>
        商品名<br>
        <input type="text" name="product_name">
    </p>

    <p>
        価格<br>
        <input type="number" name="price">
    </p>

    <p>
        商品説明<br>
        <textarea name="description"></textarea>
    </p>

    <p>
        在庫数<br>
        <input type="number" name="stock">
    </p>

    <p>
        商品画像
        <input type="file" name="image">
    </p>

    <button type="button" onclick="location.href='/mypage'">戻る</button>
    <button type="submit">登録</button>
</form>
</x-app-layout>
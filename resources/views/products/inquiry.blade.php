<x-app-layout>
<h1>お問い合わせフォーム</h1>

<form action="/inquiry" method="POST">
    @csrf
    <div>
        <label>名前</label><br>
        <input type="text" name="name">
    </div>

    <div>
        <label>メールアドレス</label><br>
        <input type="email" name="email">
    </div>

    <div>
        <label>お問い合わせ内容</label><br>
        <textarea name="content"></textarea>
    </div>

    <button type="submit">送信</button>

    <button type="button" onclick="location.href='/products'">戻る</button>
</form>
</x-app-layout>
<x-app-layout>
<h1>アカウント情報編集</h1>

<form action="/account/update" method="POST">
    @csrf

    <div>
        <label for="name">ユーザ名</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div>
        <label for="email">Eメール</label><br>
        <input type="email" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div>
        <label for="name_kanji">名前</label><br>
        <input type="text" id="name_kanji" name="name_kanji" value="{{ $user->name_kanji }}">
    </div>

    <div>
        <label for="name_kana">カナ</label><br>
        <input type="text" id="name_kana" name="name_kana" value="{{ $user->name_kana }}">
    </div>

    <br>

    <button type="button" onclick="location.href='/mypage'">戻る</button>
    <button type="submit">更新</button>
</form>
</x-app-layout>
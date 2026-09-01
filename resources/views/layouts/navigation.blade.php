

<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- サイト名 --}}
            <div class="text-xl font-semibold">
                Cytech EC
            </div>

            {{-- メニュー --}}
            <div class="flex items-center space-x-6">

                {{-- Home --}}
                <a href="/products"
                   class="text-blue-600 hover:underline">
                    Home
                </a>

                {{-- マイページ --}}
                <a href="/mypage" class="text-blue-600 hover:underline">マイページ</a>

                {{-- ログインユーザー --}}
                <span class="text-gray-700">
                    ログインユーザー：{{ Auth::user()->name }}
                </span>

                {{-- ログアウト --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
                        ログアウト
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>
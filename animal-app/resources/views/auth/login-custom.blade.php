<x-guest-layout>
    @include('auth.partials.logo', ['route' => 'home'])
    <div class="mt-4">
        <hr>
    </div>

    <div class="flex-1 flex flex-col items-center justify-center">
        <!-- タイトル -->
        <h2 class="text-xl mb-6">ログイン</h2>
        
        <!-- フォーム -->
        @include('auth.partials.login-form')

        <!-- 区切り -->
        <div class="my-6 w-96 text-center">
            <hr>
        </div>

        <!-- 新規登録 -->
        <p class="text-sm">
            <a class="hover:underline hover:text-blue-600 text-gray-900" href="{{ route('register') }}">
                初めての方はこちら
            </a>
        </p>
    </div>
</x-guest-layout>
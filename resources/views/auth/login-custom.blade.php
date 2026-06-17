<div class="flex flex-col min-h-screen">
    <div class="pt-4 mb-4">
        @include('auth.partials.logo', ['route' => 'home'])
    </div>
    <hr>
    <div class="flex-1 flex flex-col items-center justify-center"
        style="background-image:url('/images/dog-cat.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #ffffff;
    ">

        <div class="bg-white/80 backdrop-blur-md p-10 rounded-2xl shadow-2xl max-w-xl w-full">
            <div class="flex justify-center items-center">
                <img src="/images/dog-cat_icon4.png" class="w-40 h-auto" alt="dog-cat logo">
            </div>
            <!-- タイトル -->
            <h2 class="text-3xl mb-4 text-[#5293FF] text-center">ログイン</h2>
            
            <!-- フォーム -->
            @include('auth.partials.login-form')

            <!-- 区切り -->
            <div class="my-4 py-4 w-full text-center relative flex items-center justify-center">
                <hr class="border-gray-200 w-full">
                <svg class="icon icon-paw w-8 h-8 text-[#ABCBFF] absolute left-1/2 -translate-x-1/2 bg-white px-1">
                    <use href="/icons.svg#icon-paw"></use>
                </svg>
            </div>

            <!-- 新規登録 -->
            <p class="text-lg text-center">
                <a class="hover:underline hover:text-[#5293FF] text-[#F56B01]" href="{{ route('register') }}">
                    初めての方はこちら
                </a>
            </p>
        </div>
    </div>
</div>
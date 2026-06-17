<footer class="bg-[#5293FF] py-4">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-4">
            @include('auth.partials.logo', ['route' => 'home', 'colorType' => 'footer'])
        </div>
       <div class="flex justify-center space-x-24 text-2xl">
            <a href="{{ route('animals') }}"
                class="{{ request()->routeIs('animals')
                ? 'text-white underline'
                : 'text-gray-900 hover:text-white hover:underline' }}">
                TOP
            </a>
            @auth('web')
                <a href="{{ route('user.mypage') }}"
                    class="{{ request()->routeIs('user.mypage')
                    ? 'text-white underline'
                    : 'text-gray-900 hover:text-white hover:underline'}}">
                    マイページ
                </a>
            @endauth
            @auth('org')
                <a href="{{ route('org.mypage') }}"
                    class="{{ request()->routeIs('org.mypage')
                    ? 'text-white underline'
                    : 'text-gray-900 hover:text-white hover:underline'}}">
                    マイページ
                </a>
            @endauth
            @auth('web')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-white hover:underline text-gray-900">ログアウト</button>
                </form>
            @endauth
            @auth('org')
                <form method="POST" action="{{ route('org.logout') }}">
                    @csrf
                    <button class="hover:text-white hover:underline text-gray-900">ログアウト</button>
                </form>           
            @endauth 
       </div>
       <div class="flex justify-center mt-4 text-sm">
            ©Copyright 保護動物犬猫 マッチング未来のペット
       </div>
    </div>
</footer>
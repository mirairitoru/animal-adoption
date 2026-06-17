<header class="mt-4">
    <nav class="flex mt-4 max-w-7xl mx-auto">
        <div>
            @include('auth.partials.logo', ['route' => 'animals', 'colorType' => 'header'])
        </div>
        <div class="flex mt-4 ml-auto space-x-24 mr-8 font-bold text-2xl">
            <a href="{{ route('animals') }}"
                class="{{ request()->routeIs('animals')
                ? 'text-blue-600 underline'
                : 'text-gray-900 hover:text-blue-600 hover:underline' }}">
                TOP
            </a>
            @auth('web')
                <a href="{{ route('user.mypage') }}"
                    class="{{ request()->routeIs('user.mypage')
                    ? 'text-blue-600 underline'
                    : 'text-gray-900 hover:text-blue-600 hover:underline'}}">
                    マイページ
                </a>
            @endauth
            @auth('org')
                <a href="{{ route('org.mypage') }}"
                    class="{{ request()->routeIs('org.mypage')
                    ? 'text-blue-600 underline'
                    : 'text-gray-900 hover:text-blue-600 hover:underline'}}">
                    マイページ
                </a>
            @endauth
            @auth('web')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-blue-600 hover:underline text-gray-900">ログアウト</button>
                </form>
            @endauth
            @auth('org')
                <form method="POST" action="{{ route('org.logout') }}">
                    @csrf
                    <button class="hover:text-blue-600 hover:underline text-gray-900">ログアウト</button>
                </form>           
            @endauth
        </div>
    </nav>
    <hr class="mt-4">
</header>
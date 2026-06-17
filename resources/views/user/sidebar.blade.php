<div class="w-70 sticky top-4 h-fit overflow-y-auto bg-gradient-to-b from-blue-50 to-orange-100 p-4 space-y-4 rounded-xl shadow border text-center">
    <div class="text-lg font-bold text-[#5293FF]">
        【ユーザーマイページ】
    </div>
    <ul class="space-y-8 text-gray-700 font-medium">
        <li>
            <a href="{{ route('mypage.edit') }}"
                class="{{ request()->routeIs('mypage.edit')
                ? 'text-[#5293FF] underline'
                : 'text-gray-700 hover:underline hover:text-[#5293FF]' }}">
                プロフィール編集
            </a>
        </li>
        <li>
            @if(request()->routeIs('mypage.edit'))
                <a href="{{ route('user.mypage') }}" class="hover:underline hover:text-[#5293FF]">
                    興味ありリスト一覧
                </a>
            @else
                <a href="#index" class="hover:underline hover:text-[#5293FF]">
                    興味ありリスト一覧
                </a>
            @endif
        </li>
        <li>
            @if(request()->routeIs('mypage.edit'))
                <a href="{{ route('user.mypage') }}" class="hover:underline hover:text-[#5293FF]">
                    マッチした動物一覧
                </a>
            @else
                <a href="#match" class="hover:underline hover:text-[#5293FF]">
                    マッチした動物一覧
                </a>
            @endif
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-[#5293FF]">チャット一覧</a>
        </li>
    </ul>
</div>
<div class="w-40 h-fit bg-gray-200 p-4 space-y-4 font-bold text-center">
    <div>
        【ユーザーマイページ】
    </div>
    <ul class="space-y-6">
        <li>
            <a href="{{ route('mypage.edit') }}"
                class="{{ request()->routeIs('mypage.edit')
                ? 'text-blue-600 underline'
                : 'text-gray-900 hover:underline hover:text-blue-600' }}">
                プロフィール編集
            </a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-600">興味ありリスト一覧</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-600">マッチした動物一覧</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-600">チャット一覧</a>
        </li>
    </ul>
</div>
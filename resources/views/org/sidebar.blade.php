<div class="w-40 h-fit bg-gray-200 p-4 space-y-4 font-bold text-center">
    <div>
        【団体マイページ】
    </div>
    <ul class="space-y-4">
        <li>
            <a href="#" class="hover:underline hover:text-blue-600">ダッシュボード</a>
        </li>
        <li>
            <a href="{{ route('org.animals.create') }}"
                class="{{ request()->routeIs('org.animals.create')
                ? 'text-blue-600 underline'
                : 'text-gray-900 hover:underline hover:text-blue-600' }}">
                保護動物登録
            </a>
        </li>
        <li>
            <a href="{{ route('org.mypage') }}" class="hover:underline hover:text-blue-600">保護動物一覧</a>
        </li>
        <li>
            <a href="{{ route('org.match.index') }}" class="hover:underline hover:text-blue-600">マッチ管理</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-blue-600">チャット一覧</a>
        </li>
        <li>
            <a href="{{ route('org.mypage.edit') }}"
                class="{{ request()->routeIs('org.mypage.edit')
                ? 'text-blue-600 underline'
                : 'text-gray-900 hover:underline hover:text-blue-600' }}">
                団体情報編集
            </a>
        </li>
    </ul>
</div>
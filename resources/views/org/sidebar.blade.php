<div class="w-70 sticky top-4 h-fit overflow-y-auto bg-gradient-to-b from-blue-50 to-orange-100 p-4 space-y-8 rounded-xl shadow border text-center">
    <div class="text-lg font-bold text-[#5293FF]">
        【団体マイページ】
    </div>
    <ul class="space-y-8 text-gray-700 font-medium">
        <li>
            <a href="#" class="hover:underline hover:text-[#5293FF]">ダッシュボード</a>
        </li>
        <li>
            <a href="{{ route('org.animals.create') }}"
                class="{{ request()->routeIs('org.animals.create')
                ? 'text-[#5293FF] underline'
                : 'text-gray-700 hover:underline hover:text-[#5293FF]' }}">
                保護動物登録
            </a>
        </li>
        <li>
            <a href="{{ route('org.mypage') }}" class="hover:underline hover:text-[#5293FF]">保護動物一覧</a>
        </li>
        <li>
            <a href="{{ route('org.favorite.index') }}" class="hover:underline hover:text-[#5293FF]">マッチ管理</a>
        </li>
        <li>
            <a href="#" class="hover:underline hover:text-[#5293FF]">チャット一覧</a>
        </li>
        <li>
            <a href="{{ route('org.mypage.edit') }}"
                class="{{ request()->routeIs('org.mypage.edit')
                ? 'text-[#5293FF] underline'
                : 'text-gray-700 hover:underline hover:text-[#5293FF]' }}">
                団体情報編集
            </a>
        </li>
    </ul>
</div>
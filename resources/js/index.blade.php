<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10">
            <h2 class="text-center text-xl font-bold mb-6">マッチ管理</h2>
            <div class="border bg-gray-200 mt-6 p-6 max-w-2xl mx-auto">
                <div class="bg-white border border-black p-6 flex">
                    {{-- 左側タブ --}}
                    <div class="w-1/3 border-r border-black px-4">
                        <div class="flex gap-6 mb-4">
                            <button id="favorite-show" class="border bg-gray-100 hover:text-blue-500 px-2 py-1 text-sm"
                                onclick="window.location.href='{{ route('org.match.index', ['type' => 'favorite']) }}'">
                                興味あり一覧
                            </button>
                            <button id="matche-show" class="border bg-gray-100 hover:text-blue-500 px-2 py-1 text-sm"
                                onclick="window.location.href='{{ route('org.match.index', ['type' => 'matched']) }}'">
                                マッチ中一覧
                            </button>
                        </div>

                        @foreach ($animals as $animal)
                            <a href="{{ route('org.match.index', [
                                'animal_id' => $animal->id,
                                'type' => $type,
                            ]) }}"
                                class="right-7 w-48 relative border border-t mb-2 flex justify-start items-center hover:bg-gray-50 cursor-pointer">
                                <div class="flex text-sm bg-gray-200 w-12 h-12 items-center justify-center">
                                    画像
                                </div>
                                <div class="ml-2">
                                    <p class="font-bold mb-1">{{ $animal->animal_name }}</p>
                                    @if($type === 'favorite')
                                        <p class="text-xs font-bold">
                                            {{ $animal->favorites_count }}件のリクエスト
                                        </p>
                                    @elseif($type === 'matched')
                                        <p class="text-xs font-bold">
                                            {{ $animal->matches->first()?->status }}
                                        </p>
                                    @endif
                                </div>
                                <span class="bg-blue-500 text-white text-xs px-2 py-1 absolute top-0 right-0">
                                    @if($type === 'favorite')
                                        {{ $animal->favorites_count }}件
                                    @elseif($type === 'matched')
                                        {{ $animal->matches_count }}件
                                    @endif
                                </span>
                            </a>
                        @endforeach
                    </div>
                    {{-- 右側タブ 興味あり一覧 --}}
                    <div class="w-2/3 px-4">
                        @if ($type === 'favorite')
                            <h2 class="text-center font-bold mb-4">
                                {{ $selectedAnimal?->animal_name }}のリクエスト
                            </h2>

                            <div class="flex gap-2 border-t border-black">
                                <div class="w-40 h-40 bg-gray-200 flex items-center justify-center mx-4 my-4">
                                    画像
                                </div>
                                <div class="my-4 space-y-4">
                                    <p class="flex gap-2">名前:<span>{{ $selectedAnimal?->animal_name }}</span></p>
                                    <p class="flex gap-2">種類:<span>{{ $selectedAnimal?->species }}</span></p>
                                    <p class="flex items-center gap-2">
                                        <span>年齢:</span>
                                        <span class="flex flex-col leading-tight items-center">
                                            <span class="text-sm">{{ $selectedAnimal?->age_label }}</span>
                                            <span class="text-sm">{{ $selectedAnimal?->age_sub }}</span>
                                        </span>
                                    </p>
                                    <p class="flex gap-2">性別:<span>{{ $selectedAnimal?->sex }}</span></p>
                                </div>
                            </div>


                            {{-- 興味ありの申請を送ってきたユーザー --}}
                            <div class="border-t border-black">
                                <h2 class="my-2 font-bold">興味を持っているユーザー</h2>
                                @foreach ($favoritedUsers as $favorite)
                                    <div class="border p-2 mb-3 flex justify-between">
                                        <div
                                            class="w-20 min-h-20 bg-gray-200 rounded-md flex items-center justify-center text-sm">
                                            画像
                                        </div>

                                        <div class="flex flex-col ml-4 flex-1">
                                            {{-- 上段 --}}
                                            <div class="flex gap-4 text-sm justify-evenly">
                                                <p>{{ $favorite->user->nickname }}</p>
                                                <p>{{ $favorite->user->residence_area }}</p>
                                            </div>
                                            {{-- 中段 --}}
                                            <div class="mt-1">
                                                <p class="text-sm">{{ $favorite->user->self_introduction }}</p>
                                            </div>
                                            {{-- 下段 --}}
                                            <div class="mt-auto flex gap-4 justify-evenly">

                                                <button type="button"
                                                    class="open-user-modal bg-gray-200 px-3 py-1 rounded"
                                                    data-nickname="{{ $favorite->user->nickname }}"
                                                    data-residence_area="{{ $favorite->user->residence_area }}"
                                                    data-user_age="{{ $favorite->user->user_age }}"
                                                    data-animal_care_experience="{{ $favorite->user->animal_care_experience }}"
                                                    data-animal_care_details="{{ $favorite->user->animal_care_details }}"
                                                    data-self_introduction="{{ $favorite->user->self_introduction }}">
                                                    詳細情報
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('org.match.approve', $favorite->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $favorite->user_id }}">
                                                    <input type="hidden" name="animal_id"
                                                        value="{{ $favorite->animal_id }}">

                                                    <button type="submit"
                                                        class="bg-red-400 text-white px-3 py-1 rounded">
                                                        マッチ承認
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($favoritedUsers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <div class="flex justify-center">
                                        {{ $favoritedUsers->links() }}
                                    </div>
                                @endif

                                {{-- ユーザーモーダル --}}
                                <div id="oranization-modal"
                                    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                                    <div class="w-[700px]">
                                        <x-user-profile :user="null" />
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- マッチ成立画面 --}}
                        @if (session('match_success'))
                            <div id="match-modal"
                                class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                                <div class="bg-white w-[500px] p-8 relative">
                                    {{-- 閉じる --}}
                                    <button id="close-match-modal" class="absolute top-3 right-3 text-xl font-bold">
                                        x
                                    </button>
                                    <h2 class="text-2xl font-bold text-center mb-6">
                                        マッチが成立しました❤
                                    </h2>
                                    <p class="text-center mb-8 font-bold">
                                        このユーザーとチャットを開始しますか？
                                    </p>
                                    <div class="space-y-2">
                                        <a href="#" class="block w-full bg-blue-500 text-white text-center py-3">
                                            チャットを開始する
                                        </a>
                                        <button id="later-match-button" class="w-full bg-gray-200 py-3">
                                            後で対応する
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- マッチ中ユーザー一覧 --}}
                        @if ($type === 'matched')
                            <h2 class="font-bold text-center">
                                マッチ一覧
                            </h2>
                            <div class="border-t border-black my-4">
                                @foreach ($matchedUsers as $match)
                                    {{-- マッチした動物 --}}
                                    <div class="flex gap-2">
                                        <div class="w-40 h-40 bg-gray-200 flex items-center justify-center mx-4 my-4">
                                            画像
                                        </div>
                                        <div class="my-4 space-y-1 flex flex-col mx-auto">
                                            <p class="flex gap-2">
                                                名前:<span>{{ $match->animal->animal_name }}</span></p>
                                            <p class="flex gap-2">種類:<span>{{ $match->animal->species }}</span>
                                            </p>
                                            <p class="flex items-center gap-2">
                                                <span>年齢:</span>
                                                <span class="flex flex-col leading-tight items-center">
                                                    <span class="text-sm">{{ $match->animal->age_label }}</span>
                                                    <span class="text-sm">{{ $match->animal->age_sub }}</span>
                                                </span>
                                            </p>
                                            <p class="flex gap-2">性別:<span>{{ $match->animal->sex }}</span></p>
                                            @include('components.match-animal')
                                        </div>
                                    </div>
                                    {{-- マッチしたユーザー --}}
                                    <div class="border-y border-black">
                                        <div class="flex justify-around mt-4">
                                            <h2>マッチ中ユーザー情報</h2>
                                            <h2>進行管理</h2>
                                        </div>
                                        <div class="flex">
                                            <div class="w-20 h-20 bg-gray-200 flex items-center justify-center my-4">
                                                画像
                                            </div>
                                            <div class="my-4 text-sm ml-2">
                                                <p class="text-sm">ニックネーム:{{ $match->user->nickname }}</p>
                                                <p class="text-sm">居住エリア:{{ $match->user->residence_area }}</p>
                                                <p class="text-sm">年齢:{{ $match->user->user_age }}</p>
                                                @include('components.match-user')
                                            </div>
                                            <div class="ml-6 mt-3 space-y-2">
                                                <form method="POST" action="{{ route('org.match.status.update', $match->id) }}" class="space-y-1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <label class="flex items-center gap-2">
                                                        <input
                                                            type="radio"
                                                            name="status"
                                                            value="譲渡準備中"
                                                            {{ $match->status === '譲渡準備中' || !$match->status ? 'checked' : '' }}
                                                        >
                                                        <span>譲渡準備中</span>
                                                    </label>
                                                    <label class="flex items-center gap-2">
                                                        <input
                                                            type="radio"
                                                            name="status"
                                                            value="譲渡完了"
                                                            {{ $match->status === '譲渡完了' ? 'checked' : '' }}
                                                        >
                                                        <span>譲渡完了</span>
                                                    </label>
                                                    <button type="submit" class="border bg-green-700 border-green-700 text-white rounded w-full">
                                                        保存
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div id="oranization-modal"
                                    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                                    <div class="w-[700px]">
                                        <x-user-profile :user="null" />
                                    </div>
                                </div>
                            </div>
                            @include('components.modal')
                            <div>
                                <h2>進行状況</h2>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

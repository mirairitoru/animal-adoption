@if($matchedUsers)
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
        <div id="user-detail-modal"
            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="w-[700px]">
                <x-user-profile :user="null" />
            </div>
        </div>
    </div>
    @include('components.modal')
    {{-- <div>
        <h2>進行状況</h2>
    </div> --}}
@else
    <div class="flex flex-col items-center justify-center min-h-[400px] text-center text-gray-400">
        <div class="text-6xl mb-4">
            ❤
        </div>
        <h2 class="text-2xl font-bold">マッチ中の動物はいません</h2>
        <p class="mt-4 text-base leading-relaxed">
            新しいパートナー候補との<br>
            マッチを期待しましょう！
        </p>
    </div>
@endif
@if($selectedAnimal)
    <h2 class="text-center font-bold mb-4">
        {{ $selectedAnimal->animal_name }}のリクエスト
    </h2>

    <div class="flex gap-2 border-t border-black">
        <div class="w-40 h-40 bg-gray-200 flex items-center justify-center mx-4 my-4">
            画像
        </div>
        <div class="my-4 space-y-4">
            <p class="flex gap-2">名前:<span>{{ $selectedAnimal->animal_name }}</span></p>
            <p class="flex gap-2">種類:<span>{{ $selectedAnimal->species }}</span></p>
            <p class="flex items-center gap-2">
                <span>年齢:</span>
                <span class="flex flex-col leading-tight items-center">
                    <span class="text-sm">{{ $selectedAnimal->age_label }}</span>
                    <span class="text-sm">{{ $selectedAnimal->age_sub }}</span>
                </span>
            </p>
            <p class="flex gap-2">性別:<span>{{ $selectedAnimal->sex }}</span></p>
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
        <div id="user-detail-modal"
            class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
            <div class="w-[700px]">
                <x-user-profile :user="null" />
            </div>
        </div>
    </div>
@else
    <div class="flex flex-col items-center justify-center min-h-[400px] text-center text-gray-400">
        <div class="text-6xl mb-4">
            🐶or🐱
        </div>
        <h2 class="text-2xl font-bold">興味あり動物はいません</h2>
        <p class="mt-4 text-base leading-relaxed">
            新しいパートナー候補の<br>
            リアクションを待ちましょう！
        </p>
    </div>
@endif
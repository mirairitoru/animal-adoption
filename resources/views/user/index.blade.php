<div class="bg-gradient-to-r from-blue-100 to-blue-50 mt-6 p-6 rounded-lg">
    <div class="bg-white border border-black p-6 rounded-lg">
        <h2 class="mb-4">ユーザー興味ありリスト</h2>
        @if($favorites->isEmpty())
            <p class="grid min-h-[400px] items-center justify-center relative">
                <svg class="icon icon-paw w-8 h-8 text-[#5293FF] left-[calc(50%-240px)] top-1/2 -translate-y-1/2 absolute">
                    <use href="/icons.svg#icon-paw"></use>
                </svg>
                <svg class="icon icon-paw w-8 h-8 text-[#5293FF] right-[calc(50%-240px)] top-1/2 -translate-y-1/2 absolute">
                    <use href="/icons.svg#icon-paw"></use>
                </svg>
                あなたが興味ありを申請しているパートナーはいません
            </p>
        @else
            @foreach ($favorites as $favorite)
                <div class="border border-gray-300 p-4 mb-8 flex justify-between items-center">

                    {{-- 左側 --}}
                    <div class="flex">
                        <div class="w-24 h-24 bg-gray-200 flex items-center justify-center">
                            画像
                        </div>

                        <div class="ml-4">
                            <p>名前：{{ $favorite->animal->animal_name }}</p>
                            <p>種類：{{ $favorite->animal->species }}</p>
                            <p>年齢：{{ $favorite->animal->age_label }}{{ $favorite->animal->age_sub }}</p>
                            <p>性別：{{ $favorite->animal->sex }}</p>
                        </div>
                    </div>
                    {{-- 右側 --}}
                    <div class="space-y-2 text-center">

                        {{-- ステータス --}}
                        <div class="bg-blue-500 text-white px-4 py-1 w-28">
                            {{ $favorite->status === 'pending' ? '承認待ち' : '承認済み' }}
                        </div>

                        <x-favorite-button :animal="$favorite->animal" />

                        {{-- キャンセル --}}
                        <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('本当に削除しますか？')" class="bg-gray-200 px-4 py-1 w-28">
                                キャンセル
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="flex justify-center">
            {{ $favorites->links() }}
        </div>
    </div>
</div>
@include('components.modal')
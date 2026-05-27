<div class="border bg-gray-200 mt-6 p-6">
    <div class="bg-white border border-black p-6">
        <h2 class="font-bold mb-4">ユーザー興味ありリスト</h2>
        @if($favorites->isEmpty())
            <p class="grid min-h-[400px] items-center justify-center border-blue-200 bg-blue-200">
                あなたが興味ありを申請しているパートナーはいません
            </p>
        @else
            @foreach ($favorites as $favorite)
                <div class="border p-4 mb-8 flex justify-between items-center">

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
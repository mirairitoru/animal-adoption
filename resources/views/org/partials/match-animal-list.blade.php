{{-- 左側タブ --}}
<div class="w-1/3 border-r border-black px-4">
    <div class="flex gap-6 mb-4">
        <button id="favorite-show" class="border bg-gray-100 hover:text-blue-500 px-2 py-1 text-sm"
            onclick="window.location.href='{{ route('org.favorite.index') }}'">
            興味あり一覧
        </button>
        <button id="matche-show" class="border bg-gray-100 hover:text-blue-500 px-2 py-1 text-sm"
            onclick="window.location.href='{{ route('org.match.index') }}'">
            マッチ中一覧
        </button>
    </div>

    <hr class="border-black mb-4">
    
    @foreach ($animals as $animal)
        <a href="{{ route('org.match.index', [
            'animal_id' => $animal->id,
        ]) }}"
            class="right-7 w-48 relative border border-t mb-2 flex justify-start items-center hover:bg-gray-50 cursor-pointer">
            <div class="flex text-sm bg-gray-200 w-12 h-12 items-center justify-center">
                画像
            </div>
            <div class="ml-2">
                <p class="font-bold mb-1">{{ $animal->animal_name }}</p>
                <p class="text-xs font-bold">
                    {{ $animal->matche->first()?->status }}
                </p>
            </div>
            <span class="bg-blue-500 text-white text-xs px-2 py-1 absolute top-0 right-0">
                マッチ中
            </span>
        </a>
    @endforeach
</div>
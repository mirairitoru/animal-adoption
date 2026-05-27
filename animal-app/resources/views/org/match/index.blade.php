<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10 max-w-3xl mx-auto">
            <div class="border bg-gray-200 mt-6 p-6">
                <div class="bg-white border border-black p-6 flex">
                    {{-- 左側タブ --}}
                    <div class="w-1/3 border-r border-black p-4">
                        <div class="flex gap-2 mb-4">
                            <button class="border hover:text-blue-500 px-2 py-1 text-sm"><a href="#">興味あり一覧</a></button>
                            <button class="border hover:text-blue-500 px-2 py-1 text-sm"><a href="#">マッチ中一覧</a></button>
                        </div>

                        @foreach ($animals as $animal)
                            <div class="border p-2 mb-2 flex justify-between items-center hover:bg-gray-50 cursor-pointer">
                                <div>
                                    <p class="font-bold">{{ $animal->animal_name }}</p>
                                    <p class="text-xs font-bold">{{ $animal->favorites_count }}件のリクエスト</p>
                                </div>
                                <span class="bg-blue-500 text-white text-xs px-4 py-2 rounded">
                                    {{ $animal->favorites_count }}件
                                </span>
                            </div>
                        @endforeach
                    </div>
                    {{-- 右側タブ --}}
                    @if ($selectedAnimal)
                        <h2 class="text-center font-bold mb-4">
                            {{ $selectedAnimal->animal_name }}のリクエスト
                        </h2>

                        <div class="flex gap-4 mb-4">
                            <div class="w-40 h-40 bg-gray-200 flex items-center justify-center">
                                画像
                            </div>

                            <div>
                                <p>年齢:{{ $selectedAnimal->age_label }}</p>
                                <p>性別:{{ $selectedAnimal->sex }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

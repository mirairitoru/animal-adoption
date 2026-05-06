<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10 max-w-3xl mx-auto">
            <h2 class="text-center text-xl font-bold my-6">マッチ管理</h2>
            <div class="border bg-gray-200 mt-6 p-6">
                <div class="bg-white border border-black p-6 flex">
                    {{-- 左側タブ --}}
                    <div class="w-1/3 border-r border-black px-4">
                        <div class="flex gap-2 mb-4">
                            <button class="border hover:text-blue-500 px-2 py-1 text-sm"><a
                                    href="#">興味あり一覧</a></button>
                            <button class="border hover:text-blue-500 px-2 py-1 text-sm"><a
                                    href="#">マッチ中一覧</a></button>
                        </div>

                        @foreach ($animals as $animal)
                            <div
                                class="border border-t p-2 mb-2 flex justify-between items-center hover:bg-gray-50 cursor-pointer">
                                <div>
                                    <p class="font-bold">{{ $animal->animal_name }}</p>
                                    <p class="text-xs font-bold">{{ $animal->favorites_count }}件のリクエスト</p>
                                </div>
                                <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded">
                                    {{ $animal->favorites_count }}件
                                </span>
                            </div>
                        @endforeach
                    </div>
                    {{-- 右側タブ --}}
                    <div class="w-2/3 px-4">
                        @if ($selectedAnimal)
                            <h2 class="text-center font-bold mb-4">
                                {{ $selectedAnimal->animal_name }}のリクエスト
                            </h2>

                            <div class="flex gap-2 border-t border-black">
                                <div class="w-40 h-40 bg-gray-200 flex items-center justify-center mx-4 my-4">
                                    画像
                                </div>
                                <div class="my-4 space-y-4">
                                    <p>名前:{{ $selectedAnimal->animal_name }}</p>
                                    <p>種類:{{ $selectedAnimal->species }}</p>
                                    <p class="flex items-start gap-2">
                                        <span>年齢：</span>
                                        <span class="flex flex-col leading-tight">
                                            <span class="text-sm">{{ $selectedAnimal->age_label }}</span>
                                            <span class="text-sm">{{ $selectedAnimal->age_sub }}</span>
                                        </span>
                                    </p>
                                    <p>性別:{{ $selectedAnimal->sex }}</p>
                                </div>
                            </div>
                        @endif

                        {{-- 興味ありの申請を送ってきたユーザー --}}
                        <div class="border-t border-black font-bold">
                            <p class="mt-2">興味を持っているユーザー</p>
                            @foreach ($favoritedUsers as $favorite)
                                <div class="border p-2 mb-3 flex justify-between">
                                    <div class="w-20 h-20 bg-gray-300 rounded-md flex items-center justify-center text-sm text-gray-600">
                                        画像
                                    </div>
                                    <div class="flex flex-col ml-4 flex-1">
                                        <span class="text-sm">{{ $favorite->user->nickname }}</span>
                                        <span class="text-sm">{{ $favorite->user->residence_area }}</span>
                                        <span class="text-sm">{{ $favorite->user->self_introduction }}</span>
                                    </div>
                                    
                                    <form method="POST" action="{{ route('org.match.approve') }}">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $favorite->user_id }}">
                                        <input type="hidden" name="animal_id" value="{{ $favorite->animal_id }}">

                                        <button class="bg-red-400 text-white px-3 py-1 rounded">
                                            マッチ承認
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

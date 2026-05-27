<form method="POST" action="{{ $action }}">
    @csrf

    @if($method === 'PUT')
        @method('PUT')
    @endif
    {{-- 名前 --}}
    <div class="grid grid-cols-[96px_1fr] gap-y-7 items-center">
        <label for="animal_name" class="font-bold text-center pr-2">名前：</label>
        <input type="text" name="animal_name" id="animal_name" value="{{ old('animal_name', $animal->animal_name ?? '') }}" class="w-full">
        {{-- 種類 --}}
        <p class="font-bold text-center pr-2">種類：</p>
        <div class="flex flex-wrap gap-16">
            @foreach (['犬', '猫', 'その他'] as $species)
                <label>
                    <input type="radio" name="species" value="{{ $species }}" class="mr-2"
                        {{ old('species', $animal->species ?? '') === $species ? 'checked' : ''}}>
                        {{ $species }}
                </label>
            @endforeach
        </div>
        {{-- 年齢 --}}
        <p class="font-bold text-center pr-2">年齢：</p>
        <div class="grid grid-cols-4 gap-4">
            @foreach([
                ['label' => '成長', 'sub' => '(0~1歳)', 'value' => 'growth'],
                ['label' => '青年', 'sub' => '(2~5歳)', 'value' => 'youth'],
                ['label' => '中年', 'sub' => '(6~9歳)', 'value' => 'adult'],
                ['label' => 'シニア', 'sub' => '(10歳以上)', 'value' => 'senior'],
            ] as $age)
                <label class="flex items-center">
                    <input type="radio" name="age" value="{{ $age['value'] }}" 
                    {{ $animal?->age === $age['value'] ? 'checked' : ''}}
                    class="mr-3 text-center">

                    <span class="flex flex-col leading-tight">
                        <span class="text-center">{{ $age['label'] }}</span>
                        <span class="text-sm">{{ $age['sub'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>
        {{-- 性別 --}}
        <p class="font-bold text-center pr-2">性別：</p>
        <div class="flex flex-wrap gap-14">
            @foreach(['オス', 'メス', 'その他'] as $sex)
                <label>
                    <input type="radio" name="sex" value="{{ $sex }}" class="mr-2"
                    {{ old('sex', $animal->sex ?? '') === $sex ? 'checked' : ''}}>
                    {{ $sex }}
                </label>
            @endforeach
        </div>
        {{-- 性格 --}}
        <p class="font-bold text-center pr-2">性格：</p>

        @php
            $selected = old('personality', isset($animal) ? explode(',', $animal->personality) : []);
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-y-4">
            @foreach(['穏やか', '人懐っこい', 'おっとり', '好奇心旺盛', '臆病', '甘えん坊', 'マイペース', '食いしん坊'] as $p)
                <label class="cursor-pointer text-start">
                    <input type="checkbox" name="personality[]" value="{{ $p }}" class="hidden peer"
                        {{ in_array($p, $selected) ? 'checked' : ''}}>
                    <span class="py-2 px-2 rounded-xl peer-checked:bg-blue-600 peer-checked:text-white">
                        {{ $p }}
                    </span>
                </label>
            @endforeach
        </div>
        {{-- 健康状態 --}}
        <label for="health_status" class="font-bold text-center pr-2">健康状態：</label>
        <input type="text" name="health_status" id="health_status" value="{{ old('health_status', $animal->health_status ?? '') }}" class="w-full">
        {{-- コメント --}}
        <label for="comment" class="font-bold text-center pr-2">コメント：</label>
        <input type="text" name="comment" id="comment" value="{{ old('comment', $animal->comment ?? '') }}" class="w-full">
        {{-- ボタン --}}
        <div class="col-span-2 flex justify-center">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded">
                {{ $buttonText }}
            </button>
        </div>
    </div>
</form>
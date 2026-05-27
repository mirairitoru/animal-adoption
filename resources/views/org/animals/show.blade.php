@if($animals->isEmpty())
    <p class="flex flex-col items-center justify-center text-xl">
        <span class="whitespace-nowrap">
            まだ新しいパートナーが登録されていません
        </span>
        <span class="whitespace-nowrap">
            これからあなたは未来のペットと出会うきっかけの第1歩になるかもしれません
        </span>
        <span class="whitespace-nowrap">
            素敵な家族との出会いが待っているかもしれませんね❤
        </span>
    </p>
@else
    <div class="max-w-4xl grid grid-cols-3 mx-auto gap-8">
        @foreach ($animals as $animal)
            @if($animal->adoption_status === '募集中')
                <div class="border border-black p-4 text-center">
                    <div class="bg-gray-200 h-40 flex items-center justify-center">
                        画像
                    </div>

                    <div class="mt-4 text-left">
                        <p>名前:<span class="text-center">{{ $animal->animal_name }}</span></p>
                        <p>種類:{{ $animal->species }}</p>
                        <p>年齢:{{ $animal->age_label }}{{ $animal->age_sub }}</p>
                        <p>性別:{{ $animal->sex }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">性格:
                            @foreach (array_slice(explode(',' , $animal->personality), 0,2) as $p)
                                <span class="border border-black px-2">{{ $p }}</span>
                            @endforeach
                        </div>
                        <div class="text-center justify-center mt-3">
                            @include('components.modal-button')
                        </div>
                    </div>
                </div>
            @endif   
        @endforeach
    </div>
@endif

<div class="mt-6 text-center flex justify-center">
    {{ $animals->links() }}
</div>
@include('components.modal')
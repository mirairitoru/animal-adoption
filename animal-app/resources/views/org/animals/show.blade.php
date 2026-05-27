<div class="max-w-4xl grid grid-cols-3 mx-auto gap-8">
    @foreach ($animals as $animal)
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
    @endforeach
</div>

<div class="mt-6 text-center flex justify-center">
    {{ $animals->links() }}
</div>
@include('components.modal')
<div class="text-center mb-6">
    <a href="{{ route('org.animals.create') }}"
        class="bg-gray-200 px-6 py-2 font-bold hover:underline hover:text-blue-600">
        【＋新しい動物を登録】
    </a>
</div>
<div class="bg-gray-200 p-6">
    <div class="bg-white border border-black p-6">
        <table class="w-full text-center">
            <thead>
                <tr>
                    <th class="border border-black">NO</th>
                    <th class="border border-black">名前</th>
                    <th class="border border-black">種類</th>
                    <th class="border border-black">年齢</th>
                    <th class="border border-black">性別</th>
                    <th class="border border-black">ステータス</th>
                    <th class="border border-black">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($animals as $index => $animal)
                    <tr>
                        <td class="border border-black">{{ $animals->firstItem() + $index }}</td>
                        <td class="border border-black">{{ $animal->animal_name }}</td>
                        <td class="border border-black">{{ $animal->species }}</td>
                        <td class="border border-black">{{ $animal->age_label }}{{ $animal->age_sub }}</td>
                        <td class="border border-black">{{ $animal->sex }}</td>
                        <td class="border border-black">{{ $animal->adoption_status }}</td>
                        <td class="border border-black space-x-2">
                            <div class="space-x-2">
                                @include('components.modal-button')
                                <a href="{{ route('org.animals.edit', $animal->id) }}" class="hover:underline hover:text-blue-600">編集</a>
                                <form action="{{ route('org.animals.destroy', $animal->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('本当に削除しますか？')" class="hover:underline">
                                        削除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>      
                @endforeach
            </tbody>
        </table>

        <div class="flex mt-4 justify-center">
            {{ $animals->links() }}
        </div>
    </div>
</div>
@include('components.modal')
<div class="text-center mb-6">
    <a href="{{ route('org.animals.create') }}"
        class="bg-gray-200 px-6 py-2 font-bold hover:underline hover:text-[#5293FF] rounded-lg shadow-md">
        【＋新しい動物を登録】
    </a>
</div>
<div class="bg-gradient-to-r from-blue-100 to-blue-50 p-6 rounded-lg shadow-md min-h-[550px]">
    <div class="bg-white border border-black p-6 rounded-lg min-h-[500px]">
        <table class="w-full text-center">
            <thead>
                <tr>
                    <th class="border border-black h-14">NO</th>
                    <th class="border border-black h-14">名前</th>
                    <th class="border border-black h-14">種類</th>
                    <th class="border border-black h-14">年齢</th>
                    <th class="border border-black h-14">性別</th>
                    <th class="border border-black h-14">ステータス</th>
                    <th class="border border-black h-14">操作</th>
                </tr>
            </thead>
            <tbody class="min-h-[400px]">
                @if($animals->isEmpty())
                    <tr>
                        <td colspan="7" class="border border-black py-6 text-center">
                            登録している動物はいません
                        </td>
                    </tr>
                @else
                    @foreach ($animals as $index => $animal)
                        <tr>
                            <td class="border border-black h-14">{{ $animals->firstItem() + $index }}</td>
                            <td class="border border-black h-14">{{ $animal->animal_name }}</td>
                            <td class="border border-black h-14">{{ $animal->species }}</td>
                            <td class="border border-black h-14">{{ $animal->age_label }}{{ $animal->age_sub }}</td>
                            <td class="border border-black h-14">{{ $animal->sex }}</td>
                            <td class="border border-black h-14">{{ $animal->adoption_status }}</td>
                            <td class="border border-black h-14 space-x-2">
                                <div class="space-x-6">
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
                @endif
            </tbody>
        </table>

        <div class="flex mt-4 justify-center">
            {{ $animals->links() }}
        </div>
    </div>
</div>
@include('components.modal')
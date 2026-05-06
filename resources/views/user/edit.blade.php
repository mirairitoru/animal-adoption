<x-app-layout>
    <div class="flex">
        @include('user.sidebar')
        <div class="flex-1 p-10">
            <h2 class="text-xl font-bold mb-6 text-center">プロフィール編集画面</h2>
            <div class="max-w-xl mx-auto bg-gray-200 p-6 border">
                <form method="POST" action="{{ route('mypage.update') }}">
                    @csrf
                    {{-- ニックネーム --}}
                    <div class="mb-4 mt-2 flex items-center">
                        <label for="nickname" class="mr-3">ニックネーム:</label>
                        <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $user->nickname) }}" class="flex-1 border p-2">
                    </div>
                    {{-- 居住エリア --}}
                    <div class="mb-4 flex items-center">
                        <label for="residence_area" class="mr-4">居住エリア:</label>
                        <input type="text" name="residence_area" id="residence_area" value="{{ old('residence_area', $user->residence_area) }}" class="flex-1 border p-2">
                    </div>
                    {{-- 年齢 --}}
                    <div class="mb-4 flex items-center">
                        <label for="user_age" class="w-20 mr-2">年齢:</label>
                        <input type="text" name="user_age" id="user_age" value="{{ old('user_age', $user->user_age) }}" class="border p-2">
                    </div>
                    {{-- 飼育経験 --}}
                    <div class="mb-4 flex items-center">
                        <label for="animal_care_experience" class="mr-5">飼育経験:</label>
                        <select name="animal_care_experience" class="border p-2 w-fit pr-8 text-center">
                            <option value="">選択してください</option>

                            <option value="あり"{{ old('animal_care_experience', $user->animal_care_experience) === 'あり' ? 'selected' : ''}}>
                                あり
                            </option>

                            <option value="なし"{{ old('animal_care_experience', $user->animal_care_experience) === 'なし' ? 'selected' : ''}}>
                                なし
                            </option>
                        </select>
                    </div>
                    {{-- 飼育詳細 --}}
                    <div class="mb-4 flex items-center">
                        <label for="animal_care_details" class="mr-5 text-center">飼育<br>詳細情報:</label>
                        <input type="text" name="animal_care_details" id="animal_care_details" value="{{ old('animal_care_details', $user->animal_care_details) }}" class="flex-1 border p-2">
                    </div>
                    {{-- 自己紹介 --}}
                    <div class="mb-4 flex">
                        <label for="self_introduction" class="mr-5">自己紹介:</label>
                        <textarea name="self_introduction" id="self_introduction" rows="3" class="flex-1 border p-2">{{ old('self_introduction', $user->self_introduction) }}</textarea>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded">
                            更新する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
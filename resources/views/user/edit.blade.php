<x-app-layout>
    <div class="flex">
        
        {{-- サイドバー --}}
        @include('user.sidebar')

        {{-- メイン --}}
        <div class="flex-1 p-10 h-full">
            <h2 class="text-xl font-bold mb-10 text-center">プロフィール編集画面</h2>

            <div class="max-w-2xl mx-auto bg-gray-200 p-8 border rounded-lg shadow">

                <form method="POST" action="{{ route('mypage.update') }}">
                    @csrf

                    {{-- ニックネーム --}}
                    <div class="mb-6">
                        <div class="flex items-center">
                            <label for="nickname" class="w-32">ニックネーム:</label>
                            <input type="text" name="nickname" id="nickname"
                                value="{{ old('nickname', $user->nickname) }}"
                                class="flex-1 border p-2 @error('nickname') border-red-500 @enderror">
                        </div>
                        @error('nickname')
                            <p class="text-red-500 text-sm ml-32">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 居住エリア --}}
                    <div class="mb-6 flex items-center">
                        <label for="residence_area" class="w-32">居住エリア:</label>
                        <input type="text" name="residence_area" id="residence_area"
                            value="{{ old('residence_area', $user->residence_area) }}"
                            class="flex-1 border p-2">
                    </div>

                    {{-- 年齢 --}}
                    <div class="mb-6">
                        <div class="flex items-center">
                            <label for="user_age" class="w-32">年齢:</label>
                            <input type="text" name="user_age" id="user_age"
                                value="{{ old('user_age', $user->user_age) }}"
                                class="border text-center w-24 p-2 @error('user_age') border-red-500 @enderror">
                        </div>
                        @error('user_age')
                            <p class="text-red-500 text-sm ml-32">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 飼育経験 --}}
                    <div class="mb-6 flex items-center">
                        <label for="animal_care_experience" class="w-32">飼育経験:</label>
                        <select name="animal_care_experience"
                            class="border p-2 w-40 text-center">
                            <option value="">選択してください</option>
                            <option value="あり" {{ old('animal_care_experience', $user->animal_care_experience) === 'あり' ? 'selected' : '' }}>あり</option>
                            <option value="なし" {{ old('animal_care_experience', $user->animal_care_experience) === 'なし' ? 'selected' : '' }}>なし</option>
                        </select>
                    </div>

                    {{-- 飼育詳細 --}}
                    <div class="mb-6 flex items-center">
                        <label for="animal_care_details" class="w-32">飼育詳細情報:</label>
                        <input type="text" name="animal_care_details" id="animal_care_details"
                            value="{{ old('animal_care_details', $user->animal_care_details) }}"
                            class="flex-1 border p-2">
                    </div>

                    {{-- 自己紹介 --}}
                    <div class="mb-6 flex">
                        <label for="self_introduction" class="w-32">自己紹介:</label>
                        <textarea name="self_introduction" id="self_introduction" rows="4"
                            class="flex-1 border p-2">{{ old('self_introduction', $user->self_introduction) }}</textarea>
                    </div>

                    {{-- プロフィール画像 --}}
                    <div class="mb-6 flex items-start">
                        <label class="w-32 pt-2">トップ画像:</label>

                        <div class="flex flex-col gap-3 flex-1">

                            {{-- プレビュー表示 --}}
                            <img id="preview"
                                src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '' }}"
                                class="w-full max-w-xl h-40 object-cover border rounded-lg bg-white {{ $user->profile_image ? '' : 'hidden' }}">

                            {{-- アップロード枠（横長） --}}
                            <label for="profile_image"
                                class="w-full max-w-xl h-20 border-2 border-dashed border-gray-400 rounded-lg flex items-center justify-center cursor-pointer bg-white hover:bg-gray-100">
                                <span class="text-gray-500 text-sm">画像をアップロード</span>
                            </label>

                            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="hidden">
                        </div>
                    </div>

                    {{-- ボタン --}}
                    <div class="flex justify-center mt-8">
                        <button type="submit" class="bg-green-700 text-white px-8 py-2 rounded-lg shadow">
                            更新する
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>

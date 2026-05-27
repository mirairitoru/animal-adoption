<div class="bg-white w-[700px] p-6 relative">
    <div class="flex">
        <h2 class="font-bold mb-4">ユーザー基本情報</h2>
        <button id="user-close-modal" class="absolute top-4 right-4 text-xl hover:text-red-500">x</button>
    </div>
    <div class="relative border-t border-b border-black py-4">
        <div class="flex items-center">
            {{-- 画像 --}}
            <div class="w-80 h-40 bg-gray-200 flex items-center justify-center mr-6">
                画像
            </div>
            {{-- 基本情報 --}}
            <div class="ml-4 space-y-4">
                <p>ニックネーム:<span data-field="nickname"></span></p>
                <p>居住エリア:<span data-field="residence_area"></span></p>
                <p>年齢:<span data-field="user_age"></span></p>
            </div>
        </div>
        <div class="absolute top-0 bottom-0 left-[344px] border-l border-black"></div>
    </div>
    <div class="py-4 space-y-4 mb-10">
        <div class="flex mb-10">
            <p class="w-40">飼育経験:<span data-field="animal_care_experience"></span></p>
            <p class="w-full">飼育詳細情報:<span data-field="animal_care_details"></span></p>
        </div>
        <p>自己紹介:<span data-field="self_introduction"></span></p>
    </div>
</div>

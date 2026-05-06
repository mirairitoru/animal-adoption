<div class="bg-gray-200 p-6">
    <div class="bg-white border border-black p-6">
        <h2 class="font-bold mb-4">ユーザー基本情報</h2>

        <div class="relative border-t border-b border-black py-4">
            <div class="flex items-center">
                {{-- 画像 --}}
                <div class="w-80 h-40 bg-gray-200 flex items-center justify-center mr-6">
                    画像
                </div>
                {{-- 基本情報 --}}
                <div class="ml-4 space-y-4">
                    <p>ニックネーム:{{ $user->nickname }}</p>
                    <p>居住エリア:{{ $user->residence_area }}</p>
                    <p>年齢:{{ $user->user_age }}</p>
                </div>
            </div>
            <div class="absolute top-0 bottom-0 left-[335px] border-l border-black"></div>
        </div>
        <div class="py-4 space-y-4 mb-10">
            <div class="flex mb-10">
                <p class="w-40">飼育経験:{{ $user->animal_care_experience }}</p>
                <p class="w-40">飼育詳細情報:{{ $user->animal_care_details }}</p>
            </div>
            <p>自己紹介:{{ $user->self_introduction }}</p>
        </div>
    </div>
</div>
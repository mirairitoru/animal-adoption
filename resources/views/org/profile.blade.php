<div class="bg-gray-200 p-6">
    <div class="bg-white border border-black p-6">
        <h2 class="font-bold">保護団体情報</h2>

        <div class="border-t border-black my-4">
            <div class="w-full h-40 bg-gray-200 my-4 flex items-center justify-center">
                画像
            </div>
        </div>
        <div class="space-y-4">
            <div class="flex items-center">
                <span class="w-24 font-bold text-center">団体名：</span>
                <p class="flex-1 border px-3 py-1 border-black min-h-[34px]">{{ $org->org_name }}</p>
            </div>
            <div class="flex items-center">
                <span class="w-24 font-bold text-center">担当者：</span>
                <p class="flex-1 border px-3 py-1 border-black min-h-[34px]">{{ $org->contact_name }}</p>
            </div>
            <div class="flex items-center">
                <span class="w-24 font-bold text-center">所在地：</span>
                <p class="flex-1 border px-3 py-1 border-black min-h-[34px]">{{ $org->location }}</p>
            </div>
            <div class="flex items-start">
                <span class="w-24 font-bold">活動内容：</span>
                <p class="flex-1 border px-3 py-1 border-black min-h-[60px]">{{ $org->activity_description }}</p>
            </div>
            <div class="flex items-start">
                <span class="w-24 font-bold">譲渡実績：</span>
                 <p class="flex-1 border px-3 py-1 border-black min-h-[60px]">{{ $org->adoption_summary }}</p>
            </div>
        </div>
    </div>
</div>
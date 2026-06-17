<div id="modal" class="fixed inset-0 bg-black/50 hidden justify-center items-center p-8">
    <div class="bg-white p-8 w-[85vw] max-w-[900px] h-[880px] overflow-y-auto rounded-lg relative">
        <div class="flex border-b pb-3">
            <h2 class="mb-2 text-2xl font-bold">里親募集中一覧 > <span id="modal-title"></span></h2>
            <button id="close-modal" class="absolute top-6 right-10 text-2xl hover:text-red-500">X</button>
        </div>
        <div class="flex mt-6 gap-6">
            <div class="flex items-center justify-center bg-gray-200 w-[65%] h-[280px] rounded-md">
                画像
            </div>
            <div class="block ml-6 space-y-4 text-lg">
                <p>名前：<span data-field="animal_name"></span></p>
                <p>種類：<span data-field="species"></span></p>
                <p>年齢：<span data-field="age"></span></p>
                <p>性別：<span data-field="sex"></span></p>
                <p>ステータス：<span data-field="adoption_status"></span></p>
                <form id="favorite-form" method="POST">
                    @csrf
                    <button id="modal-favorite-btn" class="border text-white p-3 w-full rounded">
                        興味あり
                    </button>
                </form>
            </div>
        </div>
        <div class="mt-8 space-y-10 text-lg">
            <p class="flex items-start">
                <span class="pt-1 w-[160px] shrink-0">
                    性格：
                </span>
                <span data-field="personality" class="text-center grid grid-cols-4 gap-2"></span>
            </p>
            <p class="flex flex-wrap items-start">
                <span class="w-[160px] shrink-0">
                    健康状態：
                </span>
                <span data-field="health_status"></span>
            </p>
            <p class="flex items-start">
                <span class="w-[160px] shrink-0">
                    所属保護団体：
                </span>
                <span data-field="org_name"></span>
            </p>
            <p class="flex items-start">
                <span class="w-[160px] shrink-0">
                    コメント：
                </span>
                <span data-field="comment" class="border border-black min-h-[150px] w-full rounded p-4"></span>
            </p>
        </div>
    </div>
</div>
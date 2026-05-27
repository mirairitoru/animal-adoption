<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 w-[700px] relative">
        <div class="flex border-b">
            <h2 class="mb-2 font-bold">里親募集中一覧 > <span id="modal-title"></span></h2>
            <button id="close-modal" class="absolute top-4 right-4 text-xl hover:text-red-500">X</button>
        </div>
        <div class="flex mt-5">
            <div class="flex items-center justify-center bg-gray-200 w-[450px] h-[210px]">
                画像
            </div>
            <div class="block ml-4 space-y-2 flex-1">
                <p>名前：<span data-field="animal_name"></span></p>
                <p>種類：<span data-field="species"></span></p>
                <p>年齢：<span data-field="age"></span></p>
                <p>性別：<span data-field="sex"></span></p>
                <p>ステータス：<span data-field="adoption_status"></span></p>
                <form id="favorite-form" method="POST">
                    @csrf
                    <button id="modal-favorite-btn" class="border text-white p-2 w-full">
                        興味あり
                    </button>
                </form>
            </div>
        </div>
        <div class="mt-5 space-y-10">
            <p class="flex">性格：<span data-field="personality" class="grid grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-2 max-w-fit text-center"></span></p>
            <p>健康状態：<span data-field="health_status"></span></p>
            <p>所属保護団体：<span data-field="organization_name"></span></p>
            <p class="flex items-start">コメント：<span data-field="comment" class="border border-black min-h-20 min-w-[550px] rounded-lg inline-block ml-3 p-2 flex-1"></span></p>
        </div>
    </div>
</div>
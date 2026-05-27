<x-app-layout>
    <div class="flex">
        @include('user.sidebar')
        <div class="flex-1 p-10 max-w-3xl mx-auto">
            <h2 class="text-center text-xl font-bold my-6">プロフィール基本情報</h2>
            @include('user.profile')
            <section id="index">
                <h2 class="text-center text-xl font-bold my-6 pt-10">興味ありリスト一覧</h2>
                @include('user.index')
            </section>
            <section id="match">
                <h2 class="text-center text-xl font-bold my-6">マッチした動物一覧</h2>
                @include('user.match')
            </section>
        </div>
    </div>
</x-app-layout>
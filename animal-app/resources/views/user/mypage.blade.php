<x-app-layout>
    <div class="flex">
        @include('user.sidebar')
        <div class="flex-1 p-10 max-w-3xl mx-auto">
            <h2 class="text-center text-xl font-bold mb-6">プロフィール基本情報</h2>
            @include('user.profile')
            <h2 class="text-center text-xl font-bold my-6">興味ありリスト一覧</h2>
            @include('user.index')
        </div>
    </div>
</x-app-layout>
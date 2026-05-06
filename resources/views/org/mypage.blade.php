<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10 max-w-3xl mx-auto">
            <h2 class="text-center text-xl font-bold my-6">保護動物一覧</h2>
            @include('org.animals.index')
            <h2 class="text-center text-xl font-bold my-6">保護団体詳細情報</h2>
            @include('org.profile')
        </div>
    </div>
</x-app-layout>
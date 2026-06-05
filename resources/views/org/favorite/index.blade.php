<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10">
            <h2 class="text-center text-xl font-bold mb-6">マッチ管理</h2>
            <div class="border bg-gray-200 mt-6 p-6 max-w-2xl mx-auto">
                <div class="bg-white border border-black p-6 flex">
                    @include('org.partials.favorite-animal-list')
                    <div class="w-2/3 px-4">
                        @include('org.partials.favorite-content')
                    </div>
                    @include('org.partials.match-success-modal')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
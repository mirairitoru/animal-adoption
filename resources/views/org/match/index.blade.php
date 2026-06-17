<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10">
            <h2 class="text-center text-xl font-bold mb-6">マッチ管理</h2>
            <div class="border bg-gradient-to-r from-blue-100 to-blue-50 mt-6 p-6 max-w-3xl mx-auto">
                <div class="bg-white border border-black p-6 flex min-h-[600px]">
                    @include('org.partials.match-animal-list')
                    <div class="w-2/3 px-4">
                        @include('org.partials.match-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

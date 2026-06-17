<x-app-layout>
    <div class="flex">
        @include('org.sidebar')
        <div class="flex-1 p-10 max-w-4xl mx-auto">
            <h2 class="text-xl font-bold mb-6 text-center">保護動物登録画面</h2>
            <div class="max-w-3xl mx-auto bg-gray-200 p-6 border">
                <x-animal-form
                    :action="route('org.animals.store')"
                    method="POST"
                    buttonText="登録"
                />
            </div>
        </div>
    </div>
</x-app-layout>

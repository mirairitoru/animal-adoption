<x-app-layout>
    <div class="px-6 relative">
        <img src="/images/dog-cat_image.png" class="w-full h-auto object-cover" alt="dog-cat画像">
        <div class="absolute left-20 top-1/2 -translate-y-1/2">
            <p class="text-2xl font-bold leading-[2.8]">
                新たな出会いが見つかるきっかけ<br>
                あなたの行動した勇気が運命を変える
            </p>
        </div>
    </div>
    <h2 class="font-bold flex text-lg justify-center my-20">新しい家族、かけがえのないパートナーを見つけよう</h2>
    @include('org.animals.show') 
</x-app-layout>
@props(['route' => 'home', 'colorType' => 'header'])

<div class="relative w-[550px] h-full flex item-center">
    {{-- タイトル --}}
    <div class="ml-6">
        <h1 class="
            text-3xl
            font-bold
            tracking-wider
            leading-tight
        ">
            <a href="{{ route($route) }}">
                <span class="{{ $colorType === 'header' ? 'text-[#5293FF]' : 'text-white' }}">
                    保護動物
                </span>
                <span class="text-[#F56B01]">
                    犬猫
                </span>
                <br>
                <span class="{{ $colorType === 'header' ? 'text-[#5293FF]' : 'text-white' }}">
                    マッチング未来のペット
                </span>
            </a>
        </h1>
    </div>
</div>
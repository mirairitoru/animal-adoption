@php
    $route = $route ?? 'home';    
@endphp

<div class="border bg-black text-white p-2 w-fit rounded-md ml-4">
    <a href="{{ route($route) }}">
        <h1>LOGO</h1>
    </a>
</div>
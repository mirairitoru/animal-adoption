@php
    $route = $route ?? 'home';    
@endphp

<div class="border border-blue-400 bg-blue-400 text-white p-2 w-fit rounded-md ml-4">
    <a href="{{ route($route) }}">
        <h1>未来のペット</h1>
    </a>
</div>
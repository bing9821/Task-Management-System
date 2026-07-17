<x-layouts::app :title="__('Dashboard')">
    <h1 class="text-2xl font-semibold">
        {{ $greeting }}, {{ auth()->user()->name }}! Welcome back!
    </h1>
    
</x-layouts::app>

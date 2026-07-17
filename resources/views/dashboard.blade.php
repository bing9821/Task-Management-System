<x-layouts::app :title="__('Dashboard')">
    <h1 class="text-2xl font-semibold space-y-20">
        {{ $greeting }}, {{ auth()->user()->name }}! Welcome back!
    </h1>
    
    <div class="grid gap-4 md:grid-cols-4">
        <div class="form-card">
            <p class=text-sm text-gray-500">Total Projects</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $totalProjects }}</h2>
        </div>

        <div class="form-card">
            <p class=text-sm text-gray-500">Total Tasks</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $totalTasks}}</h2>
        </div>

        <div class="form-card">
            <p class=text-sm text-gray-500">Completed Projects</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $completedTasks }}</h2>
        </div>

        <div class="form-card">
            <p class=text-sm text-gray-500">Pending Tasks</p>
            <h2 class="mt-2 text-3xl font-semibold">{{ $pendingTasks }}</h2>
        </div>
    </div>

</x-layouts::app>

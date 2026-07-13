<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <a href="{{ route('projects.index') }}" class="rounded-md bg-black px-4 py-2 text-sm text-white">
                Go to Projects
            </a>

            <div>
                <form method="POST" action="{{ route('custom.logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md bg-red-900 px-4 py-2 text-sm text-white">
                        Logout
                    </button>
                </form>
    </div>
</x-layouts::app>

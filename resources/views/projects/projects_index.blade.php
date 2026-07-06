<x-layouts::app :title="__('Projects')">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Projects</h1>
                <p class="text-sm text-gray-500">Manage your project list.</p>
            </div>

            <a href="{{ route('projects.create') }}" class="rounded-md bg-black px-4 py-2 text-sm text-gray">
                Create Project
            </a>
        </div>

        @if(session('success'))
            <div class="rounded-md border border-green-200 bg-green-50 p-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($projects as $project)
                <div class="rounded-lg border border-gray-200 p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-medium">{{ $project->name }}</h3>

                            @if ($project->description)
                                <p class="mt-1 text-sm text-gray-600">{{ $project->description }}</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-700">View</a>
                            <a href="{{ route('projects.edit', $project) }}" class="text-sm text-blue-600">Edit</a>

                            <form method="POST" action="{{ route('projects.destroy', $project) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-sm text-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                    <p class="text-gray-500">No projects yet.</p>
                    <a href="{{ route('projects.create') }}" class="mt-3 inline-block text-sm text-blue-600">
                        Create your first project
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
<x-layouts::app :title="__('Projects')">
    <div class="page-container space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Projects</h1>
                <p class="text-sm text-gray-500">Manage your project list.</p>
            </div>

            <a href="{{ route('projects.create') }}" class="primary-button">
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
                            <a href="{{ route('projects.show', $project) }}" class="secondary-link">View</a>
                            <a href="{{ route('projects.edit', $project) }}" class="secondary-link">Edit</a>

                            <form method="POST" action="{{ route('projects.destroy', $project) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="danger-button">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                    <p class="text-gray-500">No projects yet.</p>
                    <a href="{{ route('projects.create') }}" class="primary-button">
                        Create your first project
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>
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

        <form method="GET" action="{{ route('projects.index') }}" class="form-card space-y-3">
            <div class="relative w-full">
                <flux:icon.search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-400" />
            
                <input 
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search projects..."
                    class="form-input search-input"
                >

                @if(!empty($search))
                    <a
                        href ="{{ route('projects.index', ['status' => $status ?? null]) }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"
                    >

                        <flux:icon.x-mark class="size-4" />
                    </a>
                @endif
            </div>

        <div class="flex justify-end">
            <select name="status" class="form-input max-w-xs" onchange="this.form.submit()">
            <option value="">All statuses</option>

            @foreach($statuses as $value => $label)
                <option value="{{ $value }}" @selected(($status ?? '') === $value)>
                    {{ $label }}
                </option>
            @endforeach
            </select>
        </div>
    </form>

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

                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-700">
                                {{ \App\Models\Project::STATUSES[$project->status] ?? $project->status }}
                            </span>

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
                <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center space-y-4">
                   <p class="text-gray-500">No projects yet.</p>

                    <a href="{{ route('projects.create') }}" class="primary-button ">
                        Create your first project
                    </a>
                </div>
            @endforelse

            <div>
                {{ $projects->links() }}
            </div>
    </div>
</x-layouts::app>
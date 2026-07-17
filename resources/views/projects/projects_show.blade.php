<x-layouts::app :title="$project->name">
    <div class="page-container space-y-6">
        <div>
            <a href="{{ route('projects.index') }}" class="secondary-link">Back to Projects</a>

            <div class="mt-4">
                <h1 class="text-2xl font-semibold">{{ $project->name }}</h1>

                @if ($project->description)
                    <p class="mt-2 text-gray-600">{{ $project->description }}</p>
                @endif

                <p class="mt-2 text-sm text-gray-500">
                    Created: {{ $project->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
        </div>

        <form method="GET" action="{{ route('projects.show', $project) }}" class="form-card space-y-3">
            <div class="relative w-full">
                <flux:icon.search class="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-gray-400" />

                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Search tasks..."
                    class="form-input search-input"
                >

                @if(!empty($search))
                    <a
                        href="{{ route('projects.show', $project, ['status' => $status ?? null]) }}"
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
        
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Tasks</h2>

            <a href="{{ route('projects.tasks.create', $project) }}" class="primary-button">
                Add Task
            </a>
        </div>


        <div class="space-y-3">
            @forelse ($tasks as $task)
                <div class="rounded-lg border border-gray-200 p-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-medium">{{ $task->title }}</h3>

                            @if ($task->description)
                                <p class="mt-1 text-sm text-gray-600">{{ $task->description }}</p>
                            @endif

                            <div class="mt-2 flex gap-3 text-sm text-gray-500">
                                <span>Status: {{ $task->status }}</span>
                                <span>Priority: {{ $task->priority }}</span>

                                @if ($task->due_date)
                                    <span>Due: {{ $task->due_date }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('tasks.edit', $task) }}" class="secondary-link">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf
                        @method('DELETE')

                            <button type="submit" class="danger-button">
                                Delete
                            </button>
                        </form> 
                    </div>
                </div>
            @empty
                <div class="rounded-lg border border-dashed border-gray-300 p-8 text-center">
                    <p class="text-gray-500">No tasks yet.</p>
                </div>
            @endforelse

            <div>
                {{ $tasks->links() }}
            </div>
    </div>
</x-layouts::app>

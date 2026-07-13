<x-layouts::app :title="__('Create Task')">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-600">
                Back to Project
            </a>

            <h1 class="mt-4 text-2xl font-semibold">Create Task</h1>
            <p class="text-sm text-gray-500">
                Add a task under {{ $project->name }}.
            </p>
        </div>

        <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="space-y-5 rounded-lg border border-gray-200 p-6">
            @csrf

            <div class="space-y-2">
                <label class="block text-sm font-medium">Task Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                    placeholder="e.g. Create task migration"
                >

                @error('title')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium">Description</label>
                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                    placeholder="Optional task notes"
                >{{ old('description') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium">Status</label>
                <select name="status" class="w-full rounded-md border border-gray-300 px-3 py-2">
                    <option value="todo" @selected(old('status') === 'todo')>Todo</option>
                    <option value="in_progress" @selected(old('status') === 'in_progress')>In Progress</option>
                    <option value="done" @selected(old('status') === 'done')>Done</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium">Priority</label>
                <select name="priority" class="w-full rounded-md border border-gray-300 px-3 py-2">
                    <option value="low" @selected(old('priority') === 'low')>Low</option>
                    <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                    <option value="high" @selected(old('priority') === 'high')>High</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium">Due Date</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                >
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-md bg-black px-4 py-2 text-white">
                    Save Task
                </button>

                <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
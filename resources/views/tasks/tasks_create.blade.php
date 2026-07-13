<x-layouts::app :title="__('Create Task')">
    <div class="page-container space-y-6">
        <div>
            <a href="{{ route('projects.show', $project) }}" class="secondary-link">
                Back to Project
            </a>

            <h1 class="mt-4 text-2xl font-semibold">Create Task</h1>
            <p class="text-sm text-gray-500">
                Add a task under {{ $project->name }}.
            </p>
        </div>

        <form method="POST" action="{{ route('projects.tasks.store', $project) }}" class="form-card space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="form-label">Task Title</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="form-input"
                    placeholder="e.g. Create task migration"
                >

                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    rows="4"
                    class="form-input"
                    placeholder="Optional task notes"
                >{{ old('description') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-input">
                    <option value="todo" @selected(old('status') === 'todo')>Todo</option>
                    <option value="in_progress" @selected(old('status') === 'in_progress')>In Progress</option>
                    <option value="done" @selected(old('status') === 'done')>Done</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-input">
                    <option value="low" @selected(old('priority') === 'low')>Low</option>
                    <option value="medium" @selected(old('priority', 'medium') === 'medium')>Medium</option>
                    <option value="high" @selected(old('priority') === 'high')>High</option>
                </select>
            </div>

            <div class="space-y-2">
                <label class="form-label">Due Date</label>
                <input
                    type="date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    class="form-input"
                >
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="primary-button">
                    Save Task
                </button>

                <a href="{{ route('projects.show', $project) }}" class="secondary-link">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>

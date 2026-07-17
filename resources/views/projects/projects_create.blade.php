<x-layouts::app :title="__('Create Project')">
    <div class="page-container space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Create Project</h1>
            <p class="text-sm text-gray-500">Add a new project to organize your tasks.</p>
        </div>

        <form method="POST" action="{{ route('projects.store') }}" class="form-card space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="form-label">Project Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-input"
                    placeholder="e.g. Laravel Practice"
                >

                @error('name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-input"
                    placeholder="What is this project about?"
                >{{ old('description') }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="form-label">Status</label>

            <select name="status" class="form-input">
                @foreach(\App\Models\Project::STATUSES as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', 'not_started') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            @error('status')
                <p class="form-error">{{ $message }}</p>
            @enderror
            <div class="flex items-center gap-3">
                <button type="submit" class="primary-button">
                    Save
                </button>

                <a href="{{ route('projects.index') }}" class="secondary-link">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>

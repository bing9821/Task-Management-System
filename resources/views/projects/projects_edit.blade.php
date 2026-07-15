<x-layouts::app :title="__('Edit Project')">
    <div class="page-container space-y-6">
        <div>
            <a href="{{ route('projects.show', $project) }}" class="secondary-link">
               Back to Project
            </a>

            <h1 class="mt-4 text-2xl font-semibold">Edit Project</h1>
            <p class="text-sm text-gray-500">
                Update the project name or description.
            </p>
        </div>

        <form method= "POST" action="{{ route ('projects.update', $project) }}" class="form-card space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="form-label">Project Name</label>

                <input 
                    type ="text" 
                    name ="name" 
                    value="{{ old ('name', $project-> name) }}" 
                    class="form-input"
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
                >{{old('description', $project->description) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="form-label">Status</label>

                <select name="status" class="form-input">
                    @foreach(\App\Models\Project:: STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', 'not_started') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="primary-button">
                    Save Changes
                </button>

                <a href="{{ route('projects.show', $project) }}" class="secondary-link">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>

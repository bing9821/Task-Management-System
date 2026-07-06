<x-layouts::app :title="__('Create Project')">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Create Project</h1>
            <p class="text-sm text-gray-500">Add a new project to organize your tasks.</p>
        </div>

        <form method="POST" action="{{ route('projects.store') }}" class="space-y-5 rounded-lg border border-gray-200 p-6">
            @csrf

            <div class="space-y-2">
                <label class="block text-sm font-medium">Project Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                    placeholder="e.g. Laravel Practice"
                >

                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium">Description</label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                    placeholder="What is this project about?"
                >{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-md bg-black px-4 py-2 text-gray">
                    Save
                </button>

                <a href="{{ route('projects.index') }}" class="text-sm text-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
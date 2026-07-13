<x-layouts::app :title="__('Edit Project')">
    <div class="mx-auto max-w-2xl space-y-6">
        <div>
            <a href="{{ route('projects.show', $project) }}" class="text-sm text-blue-600">
               Back to Project
            </a>

            <h1 class="mt-4 text-2xl font-semibold">Edit Project</h1>
            <p class="text-sm text-gray-500">
                Update the project name or description.
            </p>
        </div>

        <form method= "POST" action="{{ route ('projects.update', $project) }}" class="space-y-5 rounded-lg border border-gray-200 p-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Project Name</label>
                <input 
                    type ="text" 
                    name ="name" 
                    value="{{ old ('name', $project-> name) }}" 
                    class="w-full rounded-md border border-gray-300 px-3 py-2"> Project Name</label>
                    <input
                    type ="text"
                    name="name"
                    value="{{ old('name', $project->name) }}"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                    >

                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea 
                    name="description"
                    rows="4"
                    class="w-full rounded-md border border-gray-300 px-3 py-2"
                >{{old('description', $project->description) }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-md bg-black px-4 py-2 text-white">
                    Save Changes
                </button>

                <a href="{{ route('projects.show', $project) }}" class="text-sm text-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
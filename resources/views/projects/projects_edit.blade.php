<x-layouts::app :title="__('Edit Project')">
    <div>
        <h1>Edit Project</h1>

        <form method= "POST" action="{{ route ('projects.update', $project) }}">
            @csrf
            @method('PUT')

            <div>
                <label>Project Name</label>
                <input type ="text" name ="name" value="{{ old ('name', $project-> name) }}">

                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label> Description</label>
                <textarea name="description">{{old('description', $project->description) }}</textarea>
            </div>

            <button type="submit">Update</button>
        </form>
    </div>
</x-layouts::app>
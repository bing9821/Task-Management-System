<x-custom-auth-layout>
    <div class="space-y-6">
        <h1 class = "text-2xl font-semibold text-center">Register</h1>

        <form method="POST" action=" {{ route('custom.register.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class = "block text-sm font-medium text-gray-700">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{old('name') }}"
                    class="input-field"
                >
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class = "block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type = "email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="input-field"
                >
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class = "block text-sm font-medium text-gray-700">Password</label>
                <div class="password-wrapper">
                    <input 
                        id="password"
                        type="password" 
                        name="password"
                        class="input-field"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password',this)"
                        class="password-toggle"
                    >
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class = "block text-sm font-medium text-gray-700">Confirm Password</label>
                
                <div class="password-wrapper">
                    <input 
                        id="password_confirmation"
                        type = "password" 
                        name="password_confirmation"
                        class="input-field"
                    >

                    <button
                        type="button"
                        onclick = "togglePassword('password_confirmation',this)"
                        class = "password-toggle"
                    >
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>


            <button type="submit" class="auth-button">
                Register
            </button>
        </form>

   
        <a href ="{{route('custom.login')}}" class="text-sm text-blue-600">
            Already have an account? Login.
        </a>
    </div>
</x-custom-auth-layout>

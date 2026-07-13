<x-custom-auth-layout>
    <div class = "space-y-6">
        <h1 class="text-2xl font-semibold text-center">Login</h1>

        <form method = "POST" action="{{ route('custom.login.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font medium text-gray-700">Email</label>
                <input 
                    type = "email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="input-field"
                >

                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class = "block text-sm font medium text-gray-700">Password</label>
                
                <div class="relative">
                    <input 
                        id="password"
                        type = "password" 
                        name="password" 
                        class="input-field"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password', this)"
                        class="password-toggle"
                    >
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="auth-button">
                Login
            </button>
        </form>

        <p class="text-sm text-gray-600">
            Don't have an account? Create one.
            <a href =" {{ route('custom.register') }}" class="text-blue-600">
                Create an account
            </a>
        </p>
    </div>
</x-custom-auth-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')

        <link 
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        />
</head>

<body class="min-h-screen bg-gray-100">
    <main class="flex min-h-screen items-center justify-center px-4">
        <div class="auth-card">
            {{ $slot }}
        </div>
    </main>

    @fluxScripts
</body>
</html>
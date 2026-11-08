<x-MainLayout.layout title="Login — Wadud">
    <section class="mx-auto max-w-md px-6 py-16">
        <h1 class="text-2xl font-semibold tracking-tight">
            Welcome back
        </h1>

        <p class="mt-2 text-gray-600">
            Sign in to manage your notes.
        </p>

        <form
            method="POST"
            action="{{ route('login') }}"
            class="mt-8 space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
        >
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    autocomplete="current-password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input
                    type="checkbox"
                    name="remember"
                    class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
                >
                Remember me
            </label>

            <button
                type="submit"
                class="w-full cursor-pointer rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-gray-700"
            >
                Sign in
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            No account?
            <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:text-gray-600">
                Register
            </a>
        </p>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white/60 p-4 text-sm text-gray-600">
            <p class="font-medium text-gray-900">Demo accounts</p>

            <ul class="mt-2 space-y-1">
                <li>Admin: <code class="text-gray-900">admin@example.com</code> / <code class="text-gray-900">password</code></li>
                <li>User: <code class="text-gray-900">user@example.com</code> / <code class="text-gray-900">password</code></li>
            </ul>
        </div>
    </section>
</x-MainLayout.layout>

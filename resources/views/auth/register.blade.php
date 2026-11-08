<x-MainLayout.layout title="Register — Wadud">
    <section class="mx-auto max-w-md px-6 py-16">
        <h1 class="text-2xl font-semibold tracking-tight">
            Create an account
        </h1>

        <p class="mt-2 text-gray-600">
            Register to keep reading and writing notes.
        </p>

        <form
            method="POST"
            action="{{ route('register') }}"
            class="mt-8 space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
        >
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

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
                    autocomplete="new-password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    autocomplete="new-password"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
            </div>

            <button
                type="submit"
                class="w-full cursor-pointer rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-gray-700"
            >
                Create account
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500">
            Already registered?
            <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:text-gray-600">
                Sign in
            </a>
        </p>
    </section>
</x-MainLayout.layout>

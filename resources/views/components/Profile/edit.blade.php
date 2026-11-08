<x-MainLayout.layout title="Edit profile — Wadud">
    <section class="mx-auto max-w-2xl px-6 py-16">
        <a
            href="{{ route('profile.show') }}"
            class="inline-flex items-center gap-1 text-sm font-medium text-gray-500 transition-colors hover:text-gray-900"
        >
            <span aria-hidden="true">&larr;</span>
            Back to profile
        </a>

        <h1 class="mt-6 text-2xl font-semibold tracking-tight">
            Edit profile
        </h1>

        <p class="mt-2 text-gray-600">
            Update your personal details.
        </p>

        <form
            method="POST"
            action="{{ route('profile.update') }}"
            class="mt-8 space-y-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
        >
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name', $user->name) }}"
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
                    value="{{ old('email', $user->email) }}"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="+880 1XXX XXXXXX"
                        class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                    >
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input
                        type="text"
                        name="location"
                        id="location"
                        value="{{ old('location', $user->location) }}"
                        placeholder="Dhaka, Bangladesh"
                        class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                    >
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                <input
                    type="url"
                    name="website"
                    id="website"
                    value="{{ old('website', $user->website) }}"
                    placeholder="https://example.com"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >
                @error('website')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea
                    name="bio"
                    id="bio"
                    rows="4"
                    class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                >{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <a
                    href="{{ route('profile.show') }}"
                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="cursor-pointer rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700"
                >
                    Save changes
                </button>
            </div>
        </form>
    </section>
</x-MainLayout.layout>

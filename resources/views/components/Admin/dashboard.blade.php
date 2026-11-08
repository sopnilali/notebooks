<x-Admin.layout title="Admin — Wadud">
    <h1 class="text-2xl font-semibold tracking-tight">
        Dashboard
    </h1>

    <p class="mt-2 text-gray-600">
        Manage your notes from here.
    </p>

    <div class="mt-8 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <p class="text-sm font-medium text-gray-500">Total notes</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $noteCount }}</p>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <p class="text-sm font-medium text-gray-500">Quick action</p>

            <a
                href="{{ route('admin.notes.create') }}"
                class="mt-3 inline-flex items-center gap-1 text-sm font-medium text-gray-900 transition-colors hover:text-gray-600"
            >
                <span aria-hidden="true">+</span>
                Add a note
            </a>
        </div>
    </div>

    <div class="mt-4 rounded-xl border border-gray-200 bg-white p-6">
        <h2 class="text-sm font-medium text-gray-500">
            Admin user details
        </h2>

        <dl class="mt-5 grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Name</dt>
                <dd class="mt-1 text-sm font-medium text-gray-900">{{ auth()->user()->name }}</dd>
            </div>

            <div>
                <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Email</dt>
                <dd class="mt-1 text-sm font-medium text-gray-900">{{ auth()->user()->email }}</dd>
            </div>

            <div>
                <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Role</dt>
                <dd class="mt-1">
                    <span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-medium text-white">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </dd>
            </div>

            <div>
                <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Joined</dt>
                <dd class="mt-1 text-sm font-medium text-gray-900">
                    {{ auth()->user()->created_at->format('M d, Y') }}
                </dd>
            </div>
        </dl>
    </div>
</x-Admin.layout>

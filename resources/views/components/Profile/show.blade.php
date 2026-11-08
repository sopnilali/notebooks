<x-MainLayout.layout title="Profile — Wadud">
    <section class="mx-auto max-w-2xl px-6 py-16">
        @if (session('status'))
            <p class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </p>
        @endif

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-gray-900 text-xl font-semibold text-white">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h1 class="text-2xl font-semibold tracking-tight">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <a
                href="{{ route('profile.edit') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700"
            >
                Edit profile
            </a>
        </div>

        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-6">
            <dl class="grid gap-5 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Phone</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->phone ?: '—' }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Location</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->location ?: '—' }}</dd>
                </div>

                <div>
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Website</dt>
                    <dd class="mt-1 text-sm font-medium">
                        @if ($user->website)
                            <a
                                href="{{ $user->website }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-gray-900 underline underline-offset-4 hover:text-gray-600"
                            >
                                {{ $user->website }}
                            </a>
                        @else
                            <span class="text-gray-900">—</span>
                        @endif
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Role</dt>
                    <dd class="mt-1">
                        <span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-medium text-white">
                            {{ ucfirst($user->role) }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Joined</dt>
                    <dd class="mt-1 text-sm font-medium text-gray-900">{{ $user->created_at->format('M d, Y') }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs font-medium tracking-wider text-gray-400 uppercase">Bio</dt>
                    <dd class="mt-1 text-sm leading-relaxed text-gray-700">{{ $user->bio ?: '—' }}</dd>
                </div>
            </dl>
        </div>
    </section>
</x-MainLayout.layout>

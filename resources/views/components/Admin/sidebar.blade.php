<aside class="w-full shrink-0 lg:w-64">
    <div class="lg:sticky lg:top-8">
        <div class="rounded-2xl border border-gray-200/80 bg-white/80 p-4 shadow-sm backdrop-blur">
            <div class="flex items-center gap-3 px-2 py-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-900 text-sm font-semibold text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Admin panel</p>
                </div>
            </div>

            <div class="my-3 border-t border-gray-200/80"></div>

            <p class="px-3 text-[11px] font-semibold tracking-widest text-gray-400 uppercase">
                Notes
            </p>

            <ul class="mt-2 space-y-1">
                <li>
                    <a
                        href="{{ route('admin.notes.create') }}"
                        @class([
                            'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all',
                            'bg-gray-900 text-white shadow-sm' => request()->routeIs('admin.notes.create'),
                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900' => ! request()->routeIs('admin.notes.create'),
                        ])
                    >
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Add notes
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('admin.notes.index') }}"
                        @class([
                            'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all',
                            'bg-gray-900 text-white shadow-sm' => request()->routeIs('admin.notes.index') || request()->routeIs('admin.notes.show') || request()->routeIs('admin.notes.edit'),
                            'text-gray-600 hover:bg-gray-100 hover:text-gray-900' => ! (request()->routeIs('admin.notes.index') || request()->routeIs('admin.notes.show') || request()->routeIs('admin.notes.edit')),
                        ])
                    >
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        List Note
                    </a>
                </li>
            </ul>

            <div class="my-3 border-t border-gray-200/80"></div>

            <div class="space-y-1">
                <a
                    href="{{ route('profile.show') }}"
                    @class([
                        'flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium transition-colors',
                        'bg-gray-100 text-gray-900' => request()->is('profile*'),
                        'text-gray-500 hover:bg-gray-100 hover:text-gray-900' => ! request()->is('profile*'),
                    ])
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Profile
                </a>

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-900"
                >
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    View site
                </a>
            </div>
        </div>
    </div>
</aside>

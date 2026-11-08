<header {{ $attributes->merge(['class' => 'border-b border-gray-200 bg-white/80 backdrop-blur']) }}>
    <nav class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
        <a href="{{ route('home') }}" class="text-xl font-semibold tracking-tight text-gray-900">
            Wadud
        </a>

        <ul class="flex items-center gap-6 text-sm font-medium">
            <li>
                <a
                    href="{{ route('about') }}"
                    @class([
                        'transition-colors hover:text-gray-900',
                        'text-gray-900' => request()->is('about'),
                        'text-gray-500' => ! request()->is('about'),
                    ])
                >
                    About
                </a>
            </li>

            <li>
                <a
                    href="{{ route('notes.index') }}"
                    @class([
                        'transition-colors hover:text-gray-900',
                        'text-gray-900' => request()->is('notes*'),
                        'text-gray-500' => ! request()->is('notes*'),
                    ])
                >
                    Notes
                </a>
            </li>

            <li>
                <a
                    href="{{ route('contact') }}"
                    @class([
                        'transition-colors hover:text-gray-900',
                        'text-gray-900' => request()->is('contact'),
                        'text-gray-500' => ! request()->is('contact'),
                    ])
                >
                    Contact
                </a>
            </li>

            @auth
                @if (auth()->user()->isAdmin())
                    <li>
                        <a
                            href="{{ route('admin.dashboard') }}"
                            @class([
                                'transition-colors hover:text-gray-900',
                                'text-gray-900' => request()->is('admin*'),
                                'text-gray-500' => ! request()->is('admin*'),
                            ])
                        >
                            Dashboard
                        </a>
                    </li>
                @endif

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="cursor-pointer text-gray-500 transition-colors hover:text-gray-900"
                        >
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a
                        href="{{ route('login') }}"
                        class="rounded-lg bg-gray-900 px-4 py-2 text-white transition-colors hover:bg-gray-700"
                    >
                        Login
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
</header>

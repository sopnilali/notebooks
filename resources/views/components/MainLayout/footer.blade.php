<footer {{ $attributes->merge(['class' => 'border-t border-gray-200 bg-white']) }}>
    <div class="mx-auto flex max-w-5xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-gray-500 sm:flex-row">
        <p>&copy; {{ date('Y') }} Wadud. All rights reserved.</p>

        <ul class="flex items-center gap-6 font-medium">
            <li>
                <a href="{{ route('about') }}" class="transition-colors hover:text-gray-900">
                    About
                </a>
            </li>
            <li>
                <a href="{{ route('notes.index') }}" class="transition-colors hover:text-gray-900">
                    Notes
                </a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="transition-colors hover:text-gray-900">
                    Contact
                </a>
            </li>
        </ul>
    </div>
</footer>

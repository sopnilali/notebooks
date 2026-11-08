<x-MainLayout.layout title="404 — Page not found">
    <section class="mx-auto flex max-w-3xl flex-col items-center px-6 py-24 text-center">
        <p class="text-xs font-semibold tracking-[0.25em] text-gray-400 uppercase">
            Error 404
        </p>

        <p class="mt-4 bg-linear-to-br from-gray-900 to-gray-400 bg-clip-text text-7xl font-bold tracking-tight text-transparent sm:text-9xl">
            404
        </p>

        <h1 class="mt-4 text-2xl font-semibold tracking-tight text-gray-900">
            Page not found
        </h1>

        <p class="mt-3 max-w-md text-gray-600">
            The page you are looking for doesn&rsquo;t exist or has been moved. Check the URL, or head back to a page that does.
        </p>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-medium text-white transition-colors hover:bg-gray-700"
            >
                Back to home
            </a>

            <a
                href="{{ route('notes.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
            >
                Browse notes
            </a>
        </div>
    </section>
</x-MainLayout.layout>

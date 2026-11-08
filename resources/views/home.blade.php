<x-MainLayout.layout title="Wadud — Web Developer">
    <section class="mx-auto max-w-5xl px-6 py-16">
        <h1 class="text-center text-3xl font-semibold tracking-tight">
            Hello I am Wadud, I am a web developer
        </h1>
    </section>

    <section class="mx-auto max-w-5xl px-6 pb-16">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold tracking-tight">Latest notes</h2>
                <p class="mt-1 text-gray-600">Things I learn while building for the web.</p>
            </div>

            <a
                href="{{ route('notes.index') }}"
                class="inline-flex items-center gap-1 text-sm font-medium text-gray-900 transition-colors hover:text-gray-600"
            >
                View all notes
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="mt-8">
            @if ($notes->isEmpty())
                <p class="rounded-xl border border-gray-200 bg-white px-6 py-10 text-center text-gray-500">
                    No notes yet. Check back soon.
                </p>
            @else
                <x-Notes.notelist :notes="$notes" />
            @endif
        </div>
    </section>
</x-MainLayout.layout>

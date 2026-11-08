<x-MainLayout.layout title="Notes — Wadud">
    <section class="mx-auto max-w-5xl px-6 py-16">
        <h1 class="text-2xl font-semibold tracking-tight">
            Notes
        </h1>

        <p class="mt-2 text-gray-600">
            Things I learn while building for the web.
        </p>

        <div class="mt-10">
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

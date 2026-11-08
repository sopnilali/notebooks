<x-MainLayout.layout :title="$note->title.' — Wadud'">
    <article class="mx-auto max-w-3xl px-6 py-16">
        <a
            href="{{ route('notes.index') }}"
            class="inline-flex items-center gap-1 text-sm font-medium text-gray-500 transition-colors hover:text-gray-900"
        >
            <span aria-hidden="true">&larr;</span>
            All notes
        </a>

        <div class="mt-6 flex flex-wrap items-center gap-3">
            <x-Notes.tags :tags="$note->tags ?? []" />

            <time class="text-xs text-gray-400">{{ $note->created_at->format('M Y') }}</time>
        </div>

        <h1 class="mt-4 text-3xl font-semibold tracking-tight text-gray-900">
            {{ $note->title }}
        </h1>

        <div class="mt-6 space-y-4 leading-relaxed text-gray-600">
            @foreach (preg_split('/\n+/', trim($note->body)) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </article>
</x-MainLayout.layout>

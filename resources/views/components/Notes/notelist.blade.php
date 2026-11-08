@props([
    'notes' => config('notes'),
])

<div {{ $attributes->merge(['id' => 'note-list', 'class' => 'grid gap-6 sm:grid-cols-2 lg:grid-cols-3']) }}>
    @foreach ($notes as $note)
        <article
            id="note-{{ $note->id }}"
            class="group flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md"
        >
            <div class="flex flex-wrap items-start justify-between gap-3">
                <x-Notes.tags :tags="$note->tags ?? []" />

                <time class="text-xs text-gray-400">{{ $note->created_at->format('M Y') }}</time>
            </div>

            <h3 class="mt-4 text-lg font-semibold tracking-tight text-gray-900">
                <a href="{{ route('notes.show', $note) }}" class="transition-colors hover:text-gray-600">
                    {{ $note->title }}
                </a>
            </h3>

            <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-gray-600">
                {{ \Illuminate\Support\Str::limit($note->body, 140) }}
            </p>

            <a
                href="{{ route('notes.show', $note) }}"
                class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-gray-900 transition-colors hover:text-gray-600"
            >
                Read more
                <span aria-hidden="true">&rarr;</span>
            </a>
        </article>
    @endforeach
</div>

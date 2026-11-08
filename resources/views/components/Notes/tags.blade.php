@props([
    'tags' => [],
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-center gap-2']) }}>
    @forelse ($tags as $tag)
        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            {{ $tag }}
        </span>
    @empty
        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
            General
        </span>
    @endforelse
</div>

<x-Admin.layout title="List Note — Admin">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">
                List Note
            </h1>

            <p class="mt-2 text-gray-600">
                All notes in one place.
            </p>
        </div>

        <a
            href="{{ route('admin.notes.create') }}"
            class="inline-flex items-center justify-center gap-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700"
        >
            <span aria-hidden="true">+</span>
            Add note
        </a>
    </div>

    @if (session('status'))
        <p class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('status') }}
        </p>
    @endif

    <div class="mt-8 overflow-hidden rounded-xl border border-gray-200 bg-white">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            #
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            Tag
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            Date
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-semibold tracking-wider text-gray-500 uppercase">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($notes as $note)
                        <tr class="transition-colors hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-400">
                                {{ $note->id }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $note->title }}
                            </td>
                            <td class="px-6 py-4">
                                <x-Notes.tags :tags="$note->tags ?? []" />
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $note->created_at->format('M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-1">
                                    <button
                                        type="button"
                                        title="View"
                                        aria-label="View note"
                                        onclick="document.getElementById('note-modal-{{ $note->id }}').showModal()"
                                        class="cursor-pointer rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>

                                    <a
                                        href="{{ route('admin.notes.edit', $note) }}"
                                        title="Edit"
                                        aria-label="Edit note"
                                        class="rounded-lg p-2 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-900"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <button
                                        type="button"
                                        title="Delete"
                                        aria-label="Delete note"
                                        onclick="document.getElementById('delete-modal-{{ $note->id }}').showModal()"
                                        class="cursor-pointer rounded-lg p-2 text-gray-400 transition-colors hover:bg-red-50 hover:text-red-600"
                                    >
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                No notes yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($notes as $note)
        <dialog
            id="note-modal-{{ $note->id }}"
            class="m-auto w-[calc(100%-2rem)] max-w-xl rounded-xl border border-gray-200 bg-white p-0 text-gray-900 backdrop:bg-gray-900/50"
        >
            <div class="p-6">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                            {{ $note->tag ?? 'General' }}
                        </span>

                        <time class="text-xs text-gray-400">{{ $note->created_at->format('M Y') }}</time>
                    </div>

                    <form method="dialog">
                        <button
                            type="submit"
                            aria-label="Close"
                            class="cursor-pointer rounded-lg px-2 py-1 text-gray-400 transition-colors hover:bg-gray-100 hover:text-gray-900"
                        >
                            &times;
                        </button>
                    </form>
                </div>

                <h2 class="mt-4 text-xl font-semibold tracking-tight">
                    {{ $note->title }}
                </h2>

                <div class="mt-4 space-y-3 text-sm leading-relaxed text-gray-600">
                    @foreach (preg_split('/\n+/', trim($note->body)) as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>

                <div class="mt-6 flex justify-end">
                    <form method="dialog">
                        <button
                            type="submit"
                            class="cursor-pointer rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700"
                        >
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </dialog>

        <dialog
            id="delete-modal-{{ $note->id }}"
            class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-xl border border-gray-200 bg-white p-0 text-gray-900 backdrop:bg-gray-900/50"
        >
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold tracking-tight">
                            Delete note?
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Are you sure you want to delete &ldquo;{{ $note->title }}&rdquo;? This action cannot be undone.
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <form method="dialog">
                        <button
                            type="submit"
                            class="cursor-pointer rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
                        >
                            Cancel
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.notes.destroy', $note) }}">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="cursor-pointer rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-red-500"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </dialog>
    @endforeach
</x-Admin.layout>

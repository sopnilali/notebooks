<x-Admin.layout title="Edit note — Admin">
    <div class="max-w-2xl">
        <a
            href="{{ route('admin.notes.index') }}"
            class="inline-flex items-center gap-1 text-sm font-medium text-gray-500 transition-colors hover:text-gray-900"
        >
            <span aria-hidden="true">&larr;</span>
            Back to notes
        </a>

        <h1 class="mt-6 text-2xl font-semibold tracking-tight">
            Edit note
        </h1>

        <x-Notes.form
            :note="$note"
            :action="route('admin.notes.update', $note)"
            method="PUT"
        />
    </div>
</x-Admin.layout>

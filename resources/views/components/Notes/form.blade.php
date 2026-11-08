@props([
    'note' => null,
    'action' => null,
    'method' => 'POST',
])

<form method="POST" action="{{ $action ?? route('admin.notes.store') }}" class="mt-8 space-y-6">
    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $note?->title) }}"
            class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
        >
        @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="block text-sm font-medium text-gray-700">Note</label>
        <textarea
            name="body"
            id="body"
            rows="10"
            class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
        >{{ old('body', $note?->body) }}</textarea>
        <p class="mt-2 text-xs text-gray-500">Separate paragraphs with a blank line.</p>
        @error('body')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div data-tag-field>
        <label for="tag-input" class="block text-sm font-medium text-gray-700">Tags</label>

        <div class="mt-2 rounded-lg border border-gray-300 bg-white p-2 shadow-sm focus-within:border-gray-900 focus-within:ring-1 focus-within:ring-gray-900">
            <div data-tag-chips class="mb-2 flex flex-wrap gap-2 empty:mb-0"></div>

            <div class="flex items-center gap-2">
                <input
                    type="text"
                    id="tag-input"
                    data-tag-input
                    placeholder="Type a tag and press Enter"
                    class="min-w-0 flex-1 border-0 bg-transparent px-1 py-1 text-sm focus:ring-0 focus:outline-none"
                >

                <button
                    type="button"
                    data-tag-add
                    class="cursor-pointer rounded-md bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-700 transition-colors hover:bg-gray-200"
                >
                    Add
                </button>
            </div>
        </div>

        <div data-tag-hidden class="hidden">
            @foreach (old('tags', $note?->tags ?? []) as $tag)
                <input type="hidden" name="tags[]" value="{{ $tag }}">
            @endforeach
        </div>

        <p class="mt-2 text-xs text-gray-500">Add as many tags as you need — press Enter or click Add.</p>

        @error('tags')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
        @error('tags.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end gap-3">
        <a
            href="{{ route('admin.notes.index') }}"
            class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="cursor-pointer rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-gray-700"
        >
            {{ $note ? 'Update note' : 'Save note' }}
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-tag-field]').forEach(function (root) {
            const form = root.closest('form');
            const input = root.querySelector('[data-tag-input]');
            const chips = root.querySelector('[data-tag-chips]');
            const hidden = root.querySelector('[data-tag-hidden]');
            const tags = Array.from(hidden.querySelectorAll('input')).map(function (field) {
                return field.value;
            });

            function render() {
                chips.innerHTML = '';
                hidden.innerHTML = '';

                tags.forEach(function (tag, index) {
                    const chip = document.createElement('span');
                    chip.className = 'inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700';

                    const label = document.createElement('span');
                    label.textContent = tag;
                    chip.appendChild(label);

                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'cursor-pointer text-gray-400 transition-colors hover:text-gray-900';
                    remove.setAttribute('aria-label', 'Remove ' + tag);
                    remove.textContent = '\u00d7';
                    remove.addEventListener('click', function () {
                        tags.splice(index, 1);
                        render();
                    });
                    chip.appendChild(remove);

                    chips.appendChild(chip);

                    const field = document.createElement('input');
                    field.type = 'hidden';
                    field.name = 'tags[]';
                    field.value = tag;
                    hidden.appendChild(field);
                });
            }

            function add() {
                const value = input.value.trim();

                if (value !== '' && !tags.includes(value)) {
                    tags.push(value);
                }

                input.value = '';
                render();
            }

            input.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ',') {
                    event.preventDefault();
                    add();
                }
            });

            root.querySelector('[data-tag-add]').addEventListener('click', add);

            form.addEventListener('submit', add);

            render();
        });
    });
</script>

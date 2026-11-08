<x-MainLayout.layout :title="$title ?? 'Admin — Wadud'">
    <div class="mx-auto flex max-w-5xl flex-col gap-8 px-6 py-10 lg:flex-row">
        <x-Admin.sidebar />

        <section class="flex-1">
            {{ $slot }}
        </section>
    </div>
</x-MainLayout.layout>

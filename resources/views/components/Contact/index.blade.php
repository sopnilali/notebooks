<x-MainLayout.layout title="Contact — Wadud">
    <section class="mx-auto max-w-5xl px-6 py-16">
        <div class="grid gap-10 lg:grid-cols-[1fr_1.2fr]">
            <div>
                <p class="text-xs font-semibold tracking-[0.2em] text-gray-400 uppercase">
                    Contact
                </p>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-gray-900">
                    Let&rsquo;s work together
                </h1>

                <p class="mt-4 max-w-md text-gray-600">
                    Have a project in mind, or just want to say hi? Leave a message and I&rsquo;ll get back to you as soon as I can.
                </p>

                <dl class="mt-8 space-y-4 text-sm">
                    <div>
                        <dt class="text-gray-400">Email</dt>
                        <dd class="mt-1 font-medium text-gray-900">hello@wadud.dev</dd>
                    </div>

                    <div>
                        <dt class="text-gray-400">Location</dt>
                        <dd class="mt-1 font-medium text-gray-900">Dhaka, Bangladesh</dd>
                    </div>
                </dl>
            </div>

            <div>
                @if (session('status'))
                    <p class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                        {{ session('status') }}
                    </p>
                @endif

                <form
                    method="POST"
                    action="{{ route('contact.store') }}"
                    class="space-y-5 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"
                >
                    @csrf

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input
                            type="text"
                            name="subject"
                            id="subject"
                            value="{{ old('subject') }}"
                            placeholder="Project enquiry"
                            class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                        >
                        @error('subject')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea
                            name="message"
                            id="message"
                            rows="6"
                            class="mt-2 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 focus:outline-none"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full cursor-pointer rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-gray-700"
                    >
                        Send message
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-MainLayout.layout>

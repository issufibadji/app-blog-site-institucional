<x-blog-layout title="{{ $page->name }}">
    <article class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
        <h1 class="text-4xl font-bold text-gray-900 text-center">{{ $page->name }}</h1>
        <div class="prose max-w-none prose-blue mx-auto">
            {!! $page->content !!}
        </div>
    </article>
</x-blog-layout>

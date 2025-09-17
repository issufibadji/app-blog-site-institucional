<x-blog-layout :with-sidebar="true" title="{{ $category_name }}">
    <div class="space-y-10">
        <div class="space-y-3">
            <h1 class="text-4xl font-bold text-gray-900">{{ $category_name }}</h1>
            <p class="text-gray-600">Artigos associados a esta categoria.</p>
        </div>

        <div class="space-y-8">
            @forelse ($posts as $post)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <a href="{{ route('post.show', $post->slug) }}" class="block">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-56 object-cover">
                    </a>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-3 text-xs uppercase tracking-wider text-blue-600 font-semibold">
                            <span>{{ $category_name }}</span>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-500">{{ $post->created_at }}</span>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900">
                            <a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-700">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600">{!! \Illuminate\Support\Str::limit(strip_tags($post->content), 180) !!}</p>
                        <a href="{{ route('post.show', $post->slug) }}" class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900">Ler artigo <i class="fas fa-arrow-right ml-2"></i></a>
                    </div>
                </article>
            @empty
                <p class="text-gray-600">Ainda não existem artigos nesta categoria.</p>
            @endforelse
        </div>

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-blog-layout>

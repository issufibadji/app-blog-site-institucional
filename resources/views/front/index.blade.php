<x-blog-layout :with-sidebar="true" title="Blog">
    <div class="space-y-10">
        <div class="space-y-4">
            <h1 class="text-4xl font-bold text-gray-900">Blog</h1>
            <p class="text-gray-600">Exploramos tendências de engenharia, histórias de projetos e bastidores da Generaldo Torres.</p>
        </div>

        <div class="space-y-8">
            @forelse ($posts as $post)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    <a href="{{ route('post.show', $post->slug) }}" class="block">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
                    </a>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center gap-3 text-xs uppercase tracking-wider text-blue-600 font-semibold">
                            <a href="{{ route('category.show', $post->category->slug) }}" class="hover:text-blue-800">{{ $post->category->name }}</a>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-500">{{ $post->created_at }}</span>
                        </div>
                        <h2 class="text-2xl font-semibold text-gray-900">
                            <a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-700">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600">{!! \Illuminate\Support\Str::limit(strip_tags($post->content), 200) !!}</p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 text-sm text-gray-500">
                            <span>Por {{ $post->user->name }}</span>
                            <a href="{{ route('post.show', $post->slug) }}" class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900">Ler artigo completo <i class="fas fa-arrow-right ml-2"></i></a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-gray-600">Ainda não existem artigos publicados.</p>
            @endforelse
        </div>

        <div>
            {{ $posts->links() }}
        </div>
    </div>
</x-blog-layout>

<x-blog-layout :with-sidebar="true" title="{{ $post_title }}">
    <article class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100">
        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
        <div class="p-8 space-y-6">
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                <a href="{{ route('category.show', $post->category->slug) }}" class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-semibold uppercase tracking-wider">{{ $post->category->name }}</a>
                <span>{{ $post->created_at }}</span>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">{{ $post->title }}</h1>
            <div class="prose max-w-none prose-blue">
                {!! $post->content !!}
            </div>
        </div>
    </article>

    <section class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row gap-6">
        <div class="md:w-32 md:flex-shrink-0">
            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-24 h-24 md:w-32 md:h-32 rounded-full object-cover">
        </div>
        <div class="flex-1 space-y-3">
            <h2 class="text-2xl font-semibold text-gray-900">{{ $post->user->name }}</h2>
            <p class="text-gray-600">{{ $post->user->bio }}</p>
            <div class="flex items-center gap-4 text-xl text-blue-700">
                <a href="{{ $post->user->url_fb }}" class="hover:text-blue-900"><i class="fab fa-facebook"></i></a>
                <a href="{{ $post->user->url_insta }}" class="hover:text-blue-900"><i class="fab fa-instagram"></i></a>
                <a href="{{ $post->user->url_twitter }}" class="hover:text-blue-900"><i class="fab fa-twitter"></i></a>
                <a href="{{ $post->user->url_linkedin }}" class="hover:text-blue-900"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </section>

    <section class="space-y-8">
        @auth
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-4">Deixe o seu comentário</h2>
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 text-red-700 p-4">
                        <p class="font-semibold">Ocorreram alguns erros:</p>
                        <ul class="list-disc list-inside text-sm mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('post.comment', $post) }}" class="space-y-4">
                    @csrf
                    <textarea name="body" rows="5" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Escreva a sua mensagem"></textarea>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-700 text-white font-semibold rounded-full hover:bg-blue-800">Publicar comentário</button>
                </form>
            </div>
        @else
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8 text-center">
                <h2 class="text-2xl font-semibold text-blue-900">Quer participar na conversa?</h2>
                <p class="mt-3 text-blue-800">Faça login para partilhar a sua opinião sobre este conteúdo.</p>
                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-700 text-white font-semibold rounded-full hover:bg-blue-800">Iniciar sessão</a>
                    <a href="{{ route('register') }}" class="px-6 py-3 border border-blue-700 text-blue-700 font-semibold rounded-full hover:bg-blue-700 hover:text-white">Criar conta</a>
                </div>
            </div>
        @endauth

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-900">Comentários</h2>
            @forelse ($comments as $comment)
                <div class="border-t border-gray-100 pt-6">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                        @can('delete', $comment)
                            <form method="POST" action="{{ route('comment.destroy', $comment->id) }}" onsubmit="return confirm('Tem a certeza que pretende eliminar este comentário?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-sm text-red-600 hover:text-red-800">Remover</button>
                            </form>
                        @endcan
                    </div>
                    <p class="mt-2 text-gray-600">{{ $comment->body }}</p>
                </div>
            @empty
                <p class="text-gray-600">Ainda não existem comentários. Seja o primeiro a partilhar a sua opinião.</p>
            @endforelse
        </div>
    </section>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            @if (isset($post->previous))
                <span class="text-xs uppercase tracking-wider text-gray-500">Artigo anterior</span>
                <a href="{{ route('post.show', $post->previous->slug) }}" class="mt-2 block text-lg font-semibold text-blue-700 hover:text-blue-900">{{ $post->previous->title }}</a>
            @else
                <p class="text-gray-500">Este é o primeiro artigo da categoria.</p>
            @endif
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-right">
            @if (isset($post->next))
                <span class="text-xs uppercase tracking-wider text-gray-500">Próximo artigo</span>
                <a href="{{ route('post.show', $post->next->slug) }}" class="mt-2 block text-lg font-semibold text-blue-700 hover:text-blue-900">{{ $post->next->title }}</a>
            @else
                <p class="text-gray-500">Este é o último artigo publicado.</p>
            @endif
        </div>
    </div>
</x-blog-layout>

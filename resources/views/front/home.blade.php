<x-blog-layout>
    @push('hero')
        <section class="bg-blue-900 text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24 flex flex-col lg:flex-row items-start gap-12">
                <div class="lg:w-1/2 space-y-6">
                    <p class="uppercase tracking-widest text-sm text-blue-200">Generaldo Torres</p>
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight">{{ $hero['title'] }}</h1>
                    <p class="text-lg text-blue-100">{{ $hero['subtitle'] }}</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route($hero['cta']['primary']['route']) }}" class="px-6 py-3 bg-white text-blue-900 font-semibold rounded shadow hover:bg-blue-100 transition">{{ $hero['cta']['primary']['label'] }}</a>
                        <a href="{{ route($hero['cta']['secondary']['route']) }}" class="px-6 py-3 border border-white text-white font-semibold rounded hover:bg-white hover:text-blue-900 transition">{{ $hero['cta']['secondary']['label'] }}</a>
                    </div>
                </div>
                <div class="lg:w-1/2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach ($hero['stats'] as $stat)
                        <div class="bg-blue-800/60 backdrop-blur rounded-lg p-6 shadow-lg">
                            <p class="text-3xl font-bold">{{ $stat['value'] }}</p>
                            <p class="text-sm uppercase tracking-wide text-blue-200">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endpush

    <section class="py-16">
        <div class="container mx-auto px-6 grid gap-12 lg:grid-cols-2 lg:items-center">
            <div class="space-y-6">
                <span class="text-blue-700 font-semibold uppercase tracking-wider">Sobre nós</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900">Construímos confiança em cada projeto</h2>
                <p class="text-lg text-gray-600">{{ $about['mission'] }}</p>
                <p class="text-gray-600">{{ $about['history'] }}</p>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($about['values'] as $value)
                        <div class="bg-white shadow rounded-lg p-6 border-t-4 border-blue-700">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $value['title'] }}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{ $value['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="grid gap-6">
                @foreach ($projects as $project)
                    <article class="bg-white shadow-lg rounded-2xl overflow-hidden">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="h-48 w-full object-cover">
                        <div class="p-6 space-y-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $project['title'] }}</h3>
                            <p class="text-gray-600">{{ $project['description'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-10">
                <div>
                    <span class="text-blue-700 font-semibold uppercase tracking-wider">Competências</span>
                    <h2 class="text-3xl font-bold text-gray-900">Serviços estratégicos para cada desafio</h2>
                </div>
                <a href="{{ route('services') }}" class="text-blue-700 font-semibold hover:text-blue-900">Ver todos os serviços →</a>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <div class="bg-white rounded-xl shadow-sm p-8 border border-gray-100">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mb-6">
                            <i class="fas fa-{{ $service['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $service['title'] }}</h3>
                        <p class="text-gray-600 mt-3">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
                <div>
                    <span class="text-blue-700 font-semibold uppercase tracking-wider">Atualidade</span>
                    <h2 class="text-3xl font-bold text-gray-900">Destaques do nosso blog</h2>
                </div>
                <a href="{{ route('blog.index') }}" class="text-blue-700 font-semibold hover:text-blue-900">Aceder ao blog →</a>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($featuredPosts as $post)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col">
                        <a href="{{ route('post.show', $post->slug) }}" class="block">
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="h-48 w-full object-cover">
                        </a>
                        <div class="p-6 flex-1 flex flex-col">
                            <a href="{{ route('category.show', $post->category->slug) }}" class="text-xs uppercase tracking-widest text-blue-600 font-semibold">{{ $post->category->name }}</a>
                            <h3 class="mt-3 text-xl font-semibold text-gray-900">
                                <a href="{{ route('post.show', $post->slug) }}" class="hover:text-blue-700">{{ $post->title }}</a>
                            </h3>
                            <p class="mt-4 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                            <div class="mt-6 text-sm text-gray-500">Por {{ $post->user->name }}</div>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-600">Ainda não existem publicações ativas.</p>
                @endforelse
            </div>
        </div>
    </section>
</x-blog-layout>

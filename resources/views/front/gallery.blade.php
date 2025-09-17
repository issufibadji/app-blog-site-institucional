<x-blog-layout>
    @push('hero')
        <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24">
                <p class="uppercase tracking-widest text-sm text-blue-200">Galeria</p>
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight max-w-3xl">Projetos em destaque que contam a nossa história</h1>
                <p class="mt-6 text-lg text-blue-100 max-w-3xl">Conheça algumas das obras que consolidam a Generaldo Torres como referência em engenharia e construção.</p>
            </div>
        </section>
    @endpush

    <section class="py-16">
        <div class="container mx-auto px-6">
            @if ($galleries->isEmpty())
                <p class="text-center text-gray-500 text-lg">Ainda não existem imagens na galeria. Volte em breve para conhecer os nossos projetos.</p>
            @else
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($galleries as $gallery)
                        @php
                            $subtitle = $gallery->description ?: optional($gallery->service)->title;
                        @endphp
                        <figure class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title ?? 'Imagem da galeria' }}" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">
                            <figcaption class="p-6 text-gray-700 text-center">
                                <span class="block font-semibold text-gray-900">{{ $gallery->title }}</span>
                                @if ($subtitle)
                                    <span class="mt-2 block text-sm text-gray-600">{{ $subtitle }}</span>
                                @endif
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if ($highlights->isNotEmpty())
        <section class="py-16 bg-blue-50">
            <div class="container mx-auto px-6 grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-gray-900">Rigor em todas as fases</h2>
                    <p class="text-gray-600">As nossas equipas acompanham a execução no terreno com metodologias ágeis e ferramentas digitais que garantem o cumprimento de prazos e padrões de qualidade.</p>
                    <a href="{{ route('services') }}" class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900">Conhecer serviços →</a>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    @foreach ($highlights as $highlight)
                        @php
                            $subtitle = $highlight->description ?: optional($highlight->service)->title;
                        @endphp
                        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                            <img src="{{ $highlight->image_url }}" alt="{{ $highlight->title ?? 'Imagem da galeria' }}" class="h-32 w-full object-cover rounded-lg">
                            <p class="mt-3 text-sm text-gray-700 font-medium">{{ $highlight->title }}</p>
                            @if ($subtitle)
                                <p class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($subtitle, 80) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-blog-layout>

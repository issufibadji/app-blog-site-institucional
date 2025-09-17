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
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($images as $item)
                    <figure class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                        <img src="{{ $item['image'] }}" alt="{{ $item['caption'] }}" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105">
                        <figcaption class="p-6 text-gray-700 text-center font-medium">{{ $item['caption'] }}</figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-6 grid gap-10 lg:grid-cols-2 lg:items-center">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">Rigor em todas as fases</h2>
                <p class="text-gray-600">As nossas equipas acompanham a execução no terreno com metodologias ágeis e ferramentas digitais que garantem o cumprimento de prazos e padrões de qualidade.</p>
                <a href="{{ route('services') }}" class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900">Conhecer serviços →</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                @foreach (array_slice($images, 0, 4) as $item)
                    <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                        <img src="{{ $item['image'] }}" alt="{{ $item['caption'] }}" class="h-32 w-full object-cover rounded-lg">
                        <p class="mt-3 text-sm text-gray-600">{{ $item['caption'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-blog-layout>

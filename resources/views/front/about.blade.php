<x-blog-layout>
    @push('hero')
        <section class="bg-gray-900 text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24">
                <p class="uppercase tracking-widest text-sm text-gray-400">Quem somos</p>
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight max-w-3xl">Compromisso com a excelência em construção e engenharia</h1>
                <p class="mt-6 text-lg text-gray-200 max-w-3xl">{{ $about['vision'] }}</p>
            </div>
        </section>
    @endpush

    <section class="py-16">
        <div class="container mx-auto px-6 grid gap-12 lg:grid-cols-2 lg:items-start">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">A nossa missão</h2>
                <p class="text-lg text-gray-600">{{ $about['mission'] }}</p>
                <p class="text-gray-600">{{ $about['history'] }}</p>
            </div>
            <div class="space-y-6">
                <h3 class="text-2xl font-semibold text-gray-900">Valores que guiam cada projeto</h3>
                <div class="grid gap-6">
                    @foreach ($about['values'] as $value)
                        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                            <h4 class="text-xl font-semibold text-blue-800">{{ $value['title'] }}</h4>
                            <p class="text-gray-600 mt-2">{{ $value['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-10">
                <div>
                    <span class="text-blue-700 font-semibold uppercase tracking-wider">Portefólio</span>
                    <h2 class="text-3xl font-bold text-gray-900">Projetos que geram impacto positivo</h2>
                </div>
                <a href="{{ route('gallery') }}" class="text-blue-700 font-semibold hover:text-blue-900">Explorar galeria →</a>
            </div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                    <article class="bg-white rounded-2xl overflow-hidden shadow border border-blue-100">
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

    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">Especialização multidisciplinar</h2>
                <p class="text-gray-600">Reunimos equipas altamente qualificadas que asseguram todas as fases de um projeto — do planeamento estratégico à execução e acompanhamento pós-obra.</p>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $service)
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                            <i class="fas fa-{{ $service['icon'] }} text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $service['title'] }}</h3>
                        <p class="text-sm text-gray-600 mt-2">{{ $service['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-blog-layout>

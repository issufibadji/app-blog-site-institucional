<x-blog-layout>
    @push('hero')
        <section class="bg-blue-900 text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24">
                <p class="uppercase tracking-widest text-sm text-blue-200">O que fazemos</p>
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight max-w-3xl">Serviços integrados para construir o futuro com qualidade</h1>
                <p class="mt-6 text-lg text-blue-100 max-w-3xl">Da consultoria estratégica à execução em obra, entregamos soluções completas adaptadas a cada desafio.</p>
            </div>
        </section>
    @endpush

    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid gap-10 md:grid-cols-2">
                @foreach ($services as $service)
                    <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center">
                                <i class="fas fa-{{ $service['icon'] }} text-2xl"></i>
                            </div>
                            <h2 class="text-2xl font-semibold text-gray-900">{{ $service['title'] }}</h2>
                        </div>
                        <p class="text-gray-600">{{ $service['description'] }}</p>
                        <div class="mt-6 pt-6 border-t border-gray-100 text-sm text-gray-500">
                            <p>Planeamento detalhado, cronogramas transparentes e equipas multidisciplinares garantem que cada serviço responda às expectativas dos nossos clientes.</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 grid gap-10 lg:grid-cols-2 lg:items-center">
            <div class="space-y-6">
                <span class="text-blue-700 font-semibold uppercase tracking-wider">Metodologia</span>
                <h2 class="text-3xl font-bold text-gray-900">Processos orientados a resultados</h2>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex gap-3"><span class="text-blue-700 font-semibold">1.</span>Diagnóstico técnico e definição de objetivos.</li>
                    <li class="flex gap-3"><span class="text-blue-700 font-semibold">2.</span>Planeamento colaborativo com equipas e stakeholders.</li>
                    <li class="flex gap-3"><span class="text-blue-700 font-semibold">3.</span>Execução com monitorização contínua de qualidade e segurança.</li>
                    <li class="flex gap-3"><span class="text-blue-700 font-semibold">4.</span>Entrega assistida e planos de manutenção.</li>
                </ul>
            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-4">
                <h3 class="text-2xl font-semibold text-gray-900">Porque escolher a Generaldo Torres?</h3>
                <p class="text-gray-600">Integramos equipas especializadas, tecnologia e uma rede sólida de parceiros que garante execução eficiente e cumprimento rigoroso de prazos.</p>
                <a href="{{ route('contacts') }}" class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900">Solicitar uma proposta →</a>
            </div>
        </div>
    </section>
</x-blog-layout>

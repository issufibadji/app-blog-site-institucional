<x-blog-layout>
    @push('hero')
        <section class="bg-gray-900 text-white">
            <div class="container mx-auto px-6 py-16 lg:py-24">
                <p class="uppercase tracking-widest text-sm text-gray-400">Contactos</p>
                <h1 class="text-4xl lg:text-5xl font-bold leading-tight max-w-3xl">Estamos prontos para construir o seu próximo projeto</h1>
                <p class="mt-6 text-lg text-gray-200 max-w-3xl">Fale com a nossa equipa comercial e descubra como podemos apoiar os seus objetivos.</p>
            </div>
        </section>
    @endpush

    <section class="py-16">
        <div class="container mx-auto px-6 grid gap-12 lg:grid-cols-2">
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-900">Informações de contacto</h2>
                <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-6">
                    <div>
                        <p class="text-sm uppercase tracking-wider text-blue-700 font-semibold">Morada</p>
                        <p class="text-lg text-gray-700">{{ $contact['address'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-wider text-blue-700 font-semibold">Telefone</p>
                        <a href="tel:{{ preg_replace('/\s+/', '', $contact['phone']) }}" class="text-lg text-gray-700 hover:text-blue-700">{{ $contact['phone'] }}</a>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-wider text-blue-700 font-semibold">Email</p>
                        <a href="mailto:{{ $contact['email'] }}" class="text-lg text-gray-700 hover:text-blue-700">{{ $contact['email'] }}</a>
                    </div>
                    <div>
                        <p class="text-sm uppercase tracking-wider text-blue-700 font-semibold">Horário</p>
                        <p class="text-lg text-gray-700">{{ $contact['schedule'] }}</p>
                    </div>
                </div>
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Precisa de uma proposta?</h3>
                    <p class="text-gray-600">Indique-nos o tipo de serviço pretendido e o prazo desejado. A nossa equipa responde em até 24 horas úteis.</p>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        @foreach ($services as $service)
                            <li class="flex items-start gap-2"><span class="text-blue-700 mt-1"><i class="fas fa-check-circle"></i></span>{{ $service['title'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="space-y-6">
                <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Envie-nos uma mensagem</h2>
                    <form class="grid gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" class="mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="O seu nome">
                        </div>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" class="mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="nome@empresa.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Telefone</label>
                                <input type="text" class="mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="(+351) 999 999 999">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mensagem</label>
                            <textarea class="mt-1 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" rows="5" placeholder="Conte-nos sobre o seu projeto"></textarea>
                        </div>
                        <button type="button" class="mt-2 inline-flex justify-center px-6 py-3 bg-blue-700 text-white font-semibold rounded-lg hover:bg-blue-800 transition">Enviar mensagem</button>
                    </form>
                </div>
                <div class="overflow-hidden rounded-2xl shadow-lg border border-gray-200">
                    <iframe src="{{ $contact['map'] }}" width="100%" height="320" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</x-blog-layout>

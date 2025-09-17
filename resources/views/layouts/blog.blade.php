<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @isset($title)
            {{ ucfirst($title) }} -
        @endisset{{ config('app.name') }}
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
    @if (Session::has('message') || Session::has('error'))
        <div class="container mx-auto px-6 mt-4">
            <div class="rounded-xl px-6 py-4 shadow-md {{ Session::has('message') ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200' }}">
                {{ Session::get('message') ?? Session::get('error') }}
            </div>
        </div>
    @endif

    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm border-b border-gray-100" x-data="{ open: false }">
            <div class="container mx-auto px-6 py-5 flex items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <a href="{{ route('webhome') }}" class="text-2xl font-semibold text-blue-900">{{ $setting->site_name }}</a>
                    <p class="hidden md:block text-sm text-gray-500 max-w-md">{{ $setting->description }}</p>
                </div>
                <button class="md:hidden text-blue-900" @click="open = !open">
                    <i :class="open ? 'fas fa-times' : 'fas fa-bars'"></i>
                </button>
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-700">
                    <a href="{{ route('webhome') }}" class="hover:text-blue-700">Início</a>
                    <a href="{{ route('about') }}" class="hover:text-blue-700">Sobre nós</a>
                    <a href="{{ route('services') }}" class="hover:text-blue-700">Serviços</a>
                    <a href="{{ route('gallery') }}" class="hover:text-blue-700">Galeria</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-blue-700">Blog</a>
                    <a href="{{ route('contacts') }}" class="hover:text-blue-700">Contactos</a>
                    @foreach ($pages_nav as $page)
                        <a href="{{ route('page.show', $page->slug) }}" class="hover:text-blue-700">{{ $page->name }}</a>
                    @endforeach
                </nav>
                <div class="hidden md:flex items-center gap-4 text-blue-900 text-xl">
                    <a href="{{ $setting->url_fb }}" aria-label="Facebook" class="hover:text-blue-700"><i class="fab fa-facebook"></i></a>
                    <a href="{{ $setting->url_insta }}" aria-label="Instagram" class="hover:text-blue-700"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $setting->url_twitter }}" aria-label="Twitter" class="hover:text-blue-700"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $setting->url_linkedin }}" aria-label="LinkedIn" class="hover:text-blue-700"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="md:hidden" x-show="open" x-transition>
                <nav class="bg-white border-t border-gray-100 shadow-inner">
                    <div class="px-6 py-4 space-y-3 text-sm font-medium text-gray-700">
                        <a href="{{ route('webhome') }}" class="block">Início</a>
                        <a href="{{ route('about') }}" class="block">Sobre nós</a>
                        <a href="{{ route('services') }}" class="block">Serviços</a>
                        <a href="{{ route('gallery') }}" class="block">Galeria</a>
                        <a href="{{ route('blog.index') }}" class="block">Blog</a>
                        <a href="{{ route('contacts') }}" class="block">Contactos</a>
                        @foreach ($pages_nav as $page)
                            <a href="{{ route('page.show', $page->slug) }}" class="block">{{ $page->name }}</a>
                        @endforeach
                        <div class="flex flex-wrap gap-4 pt-4 text-lg text-blue-900">
                            <a href="{{ $setting->url_fb }}" aria-label="Facebook" class="hover:text-blue-700"><i class="fab fa-facebook"></i></a>
                            <a href="{{ $setting->url_insta }}" aria-label="Instagram" class="hover:text-blue-700"><i class="fab fa-instagram"></i></a>
                            <a href="{{ $setting->url_twitter }}" aria-label="Twitter" class="hover:text-blue-700"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $setting->url_linkedin }}" aria-label="LinkedIn" class="hover:text-blue-700"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        @auth
            <div class="bg-blue-900 text-white">
                <div class="container mx-auto px-6 py-2 flex items-center justify-end gap-3 text-sm">
                    <span>Bem-vindo, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="px-3 py-1 bg-white text-blue-900 font-semibold rounded-full hover:bg-blue-100">Terminar sessão</button>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-blue-900 text-white">
                <div class="container mx-auto px-6 py-2 flex items-center justify-end gap-3 text-sm">
                    <a href="{{ route('login') }}" class="px-3 py-1 bg-white text-blue-900 font-semibold rounded-full hover:bg-blue-100">Área reservada</a>
                    <a href="{{ route('register') }}" class="px-3 py-1 border border-white rounded-full hover:bg-white hover:text-blue-900">Criar conta</a>
                </div>
            </div>
        @endauth

        @stack('hero')

        <main class="flex-1">
            @if ($withSidebar)
                <div class="container mx-auto px-6 py-16">
                    <div class="grid gap-12 lg:grid-cols-[2fr,1fr]">
                        <div class="space-y-10">
                            {{ $slot }}
                        </div>
                        <aside class="space-y-8">
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Sobre a Generaldo Torres</h2>
                                <p class="text-gray-600">{{ $setting->about }}</p>
                            </div>
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Categorias</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($categories as $category)
                                        <a href="{{ route('category.show', $category->slug) }}" class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-medium hover:bg-blue-100">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Etiquetas</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($tags as $tag)
                                        <a href="{{ route('tag.show', $tag->name) }}" class="px-3 py-1 rounded-full border border-blue-200 text-blue-700 text-sm hover:bg-blue-50">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Top autores</h2>
                                <ul class="space-y-4">
                                    @forelse ($top_users as $top)
                                        <li class="flex items-center gap-4">
                                            <img src="{{ $top->avatar }}" alt="{{ $top->name }}" class="w-12 h-12 rounded-full object-cover">
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $top->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $top->posts_count }} artigos publicados</p>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="text-gray-500">Ainda não existem autores destacados.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            @else
                <div class="container mx-auto px-6 py-16">
                    {{ $slot }}
                </div>
            @endif
        </main>

        <footer class="bg-gray-900 text-gray-300">
            <div class="container mx-auto px-6 py-12 grid gap-10 md:grid-cols-3">
                <div>
                    <h3 class="text-white text-lg font-semibold">{{ $setting->site_name }}</h3>
                    <p class="mt-3 text-sm text-gray-400">{{ $setting->description }}</p>
                    <div class="flex items-center gap-4 mt-6 text-xl">
                        <a href="{{ $setting->url_fb }}" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="{{ $setting->url_insta }}" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $setting->url_twitter }}" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $setting->url_linkedin }}" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold">Mapa do site</h4>
                    <ul class="mt-4 space-y-2 text-sm">
                        <li><a href="{{ route('webhome') }}" class="hover:text-white">Início</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-white">Sobre nós</a></li>
                        <li><a href="{{ route('services') }}" class="hover:text-white">Serviços</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-white">Galeria</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a></li>
                        <li><a href="{{ route('contacts') }}" class="hover:text-white">Contactos</a></li>
                        @foreach ($pages_footer as $page)
                            <li><a href="{{ route('page.show', $page->slug) }}" class="hover:text-white">{{ $page->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-semibold">Notícias em destaque</h4>
                    <p class="mt-4 text-sm text-gray-400">Acompanhe as novidades da Generaldo Torres e receba conteúdos sobre construção e engenharia.</p>
                    <a href="{{ route('blog.index') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-700 text-white text-sm font-semibold rounded-full hover:bg-blue-600">Visitar o blog</a>
                </div>
            </div>
            <div class="border-t border-gray-800">
                <div class="container mx-auto px-6 py-4 text-center text-xs text-gray-500">&copy; {{ $setting->copy_rights }}</div>
            </div>
        </footer>
    </div>
</body>

</html>

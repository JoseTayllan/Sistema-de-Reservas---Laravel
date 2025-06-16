{{-- resources/views/components/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed md:relative z-40 w-64 bg-gray-800 text-white transform md:translate-x-0 transition-transform duration-200 ease-in-out min-h-screen">
        <div class="p-4 text-xl font-bold border-b border-gray-700">
            Painel Admin
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.reservas.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('admin.reservas.*') ? 'bg-gray-700' : '' }}">
                📅 Gerenciar Reservas
            </a>
            <a href="{{ route('espacos.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('espacos.*') ? 'bg-gray-700' : '' }}">
                🏢 Espaços
            </a>
            <a href="{{ route('admin.export.pdf') }}" class="block py-2 px-3 rounded hover:bg-gray-700">
                🧾 Exportar PDF
            </a>
            <a href="{{ route('admin.export.excel') }}" class="block py-2 px-3 rounded hover:bg-gray-700">
                📥 Exportar Excel
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-red-600 bg-red-500">
                    🚪 Sair
                </button>
            </form>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <div class="flex-1 flex flex-col w-full">

        <!-- Mobile header -->
        <header class="bg-white p-4 flex items-center justify-between md:hidden border-b shadow">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': sidebarOpen, 'inline-flex': !sidebarOpen }" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{ 'hidden': !sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <span class="font-semibold text-lg">Painel Admin</span>
        </header>

        <!-- Conteúdo -->
        <main class="flex-1 p-4 md:p-6">
            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>

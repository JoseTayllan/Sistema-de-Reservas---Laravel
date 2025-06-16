<!-- resources/views/welcome.blade.php -->
<x-guest-layout>
    <div class="relative bg-cover bg-center min-h-screen" style="background-image: url('/images/bg-reservas.jpg')">
        <div class="bg-black bg-opacity-60 absolute inset-0"></div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center text-white p-8 space-y-6">
            <h1 class="text-4xl md:text-5xl font-bold">Bem-vindo ao Sistema de Reservas</h1>
            <p class="text-lg md:text-xl">Gerencie seus espaços com facilidade e agilidade</p>

            @guest
                <div class="flex gap-4 mt-4">
                    <a href="{{ route('login') }}" class="bg-white text-gray-800 px-6 py-2 rounded hover:bg-gray-100">Entrar</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Cadastrar</a>
                </div>
            @endguest
        </div>
    </div>
</x-guest-layout>

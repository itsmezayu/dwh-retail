<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWH Retail</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal overflow-hidden flex h-screen">

    <!-- Sidebar -->
    <div class="bg-gray-800 shadow-xl h-screen w-64 text-white p-5 flex flex-col">
        <h1 class="text-2xl font-bold mb-8">DWH Retail</h1>
        <ul class="flex flex-col space-y-4">
            <li>
                <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 rounded font-semibold hover:bg-gray-700">📊 Dashboard</a>
            </li>
            <li>
                <span class="block px-4 py-2 font-semibold text-gray-400">📦 Dimensi</span>
                <ul class="ml-4 mt-2 space-y-2">
                    <li><a href="{{ route('produk.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Produk</a></li>
                    <li><a href="{{ route('pelanggan.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Pelanggan</a></li>
                    <li><a href="{{ route('waktu.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">Waktu</a></li>
                </ul>
            </li>
            <li class="mt-4">
                <a href="{{ route('penjualan.index') }}" class="block px-4 py-2 rounded font-semibold hover:bg-gray-700">🧾 Fakta Penjualan</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <!-- Top Navbar -->
        <header class="bg-white shadow p-4">
            <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
        </header>

        <!-- Flash Messages -->
        <div class="p-6 pb-0">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Content Body -->
        <main class="p-6 flex-1">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>

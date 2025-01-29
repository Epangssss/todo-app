<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-md">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <svg class="h-10 w-auto text-red-500" viewBox="0 0 62 65" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M61.8548 14.6253..." fill="currentColor" />
                    </svg>
                    <h1 class="text-lg font-bold">Dashboard Epang Todo_list</h1>
                </div>
                @if (Route::has('login'))
                    <nav class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-red-500 border border-red-500 rounded-md hover:bg-red-500 hover:text-white">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-6 py-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <!-- Section 1 -->
                <div class="flex items-center justify-center h-full">
                    <!-- Gambar dan teks dengan animasi -->
                    <div class="flex items-center">
                        <!-- Gambar epang.png, animasi muncul dari bawah -->
                        <img src="{{ asset('images/epang.png') }}" alt="Epang Image 1"
                            class="w-2/3 h-auto animate__animated animate__fadeInUp">

                        <!-- Teks yang lebih besar, muncul dari bawah -->
                        <div class="ml-8 animate__animated animate__fadeInUp animate__delay-1s">
                            <h2 class="text-6xl font-bold mb-4 text-gray-800" style="white-space: nowrap;">To-Do-List
                            </h2>
                            <p class="text-lg text-gray-600" style="white-space: nowrap;">
                                Tugas Epang To-Do-List Beta Yang Mana menampilkan data Autentikasi Admin (Login/Logout),
                                <span style="display:block;">CRUD To-Do List, Dashboard Admin:,</span>
                                <span style="display:block;">Validasi Input, Filter dan Pencarian Tugas,</span>
                                <span style="display:block;">Notifikasi Deadline, .</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Importing animate.css library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (Epang{2025_Mabok❤️})
        </footer>
    </div>
</body>

</html>

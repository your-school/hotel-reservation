<!-- resources/views/user/top.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Custmer | Hotel Reservation')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<body class="font-sans bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">Custmer - Hotel Reservation</h1>
            <nav>
                <ul class="flex space-x-4">
                    @if (Route::has('user.login'))
                    @auth('users')
                    <li><a href="{{ url('/') }}" class="hover:text-gray-300">ホーム</a></li>

                        <li><a href="{{ route('user.contact') }}" class="hover:text-gray-300">お問い合わせ</a></li>
                    @else
                        <li><a href="{{ route('user.login') }}" class="hover:text-gray-300">ログイン</a></li>
                        @if (Route::has('user.register'))
                        <li><a href="{{ route('user.register') }}" class="hover:text-gray-300">新規登録</a></li>
                        @endif
                    @endauth
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <div class="container mx-auto mt-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; 2023 Hotel Reservation
        </div>
    </footer>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

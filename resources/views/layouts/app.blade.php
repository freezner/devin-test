<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '북마크 서비스') }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">
                <i class="fas fa-bookmark mr-2"></i>북마크 서비스
            </a>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-700">{{ Auth::user()->name }} 님</span>
                    <a href="{{ route('bookmarks.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        북마크 등록
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">로그아웃</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">로그인</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">회원가입</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white shadow-inner py-6 mt-8">
        <div class="container mx-auto px-4 text-center text-gray-600">
            &copy; {{ date('Y') }} 북마크 서비스. All rights reserved.
        </div>
    </footer>
</body>
</html>

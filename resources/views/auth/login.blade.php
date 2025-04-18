@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center">로그인</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">이메일</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-700 font-medium mb-2">비밀번호</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6 flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember" class="text-gray-700">로그인 상태 유지</label>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                로그인
            </button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <p class="text-gray-600">계정이 없으신가요? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">회원가입</a></p>
    </div>
</div>
@endsection

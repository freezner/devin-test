@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">북마크 목록</h1>
</div>

@if($bookmarks->isEmpty())
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <p class="text-gray-600">등록된 북마크가 없습니다.</p>
        @auth
            <a href="{{ route('bookmarks.create') }}" class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                북마크 등록하기
            </a>
        @else
            <p class="mt-4 text-gray-600">북마크를 등록하려면 <a href="{{ route('login') }}" class="text-blue-600 hover:underline">로그인</a>하세요.</p>
        @endauth
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($bookmarks as $bookmark)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <a href="{{ route('bookmarks.show', $bookmark) }}" class="block">
                <div class="h-40 bg-gray-200 overflow-hidden">
                    @if($bookmark->thumbnail)
                        <img src="{{ $bookmark->thumbnail }}" alt="{{ $bookmark->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <i class="fas fa-link text-4xl text-gray-500"></i>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $bookmark->title }}</h3>
                    <div class="flex items-center text-sm text-gray-600 mb-2">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $bookmark->category }}</span>
                        @if($bookmark->tags)
                            <span class="ml-2 text-gray-500">{{ $bookmark->tags }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div class="flex items-center">
                            <span>{{ $bookmark->user->name }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $bookmark->created_at->format('Y-m-d') }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3"><i class="far fa-eye mr-1"></i>{{ $bookmark->views }}</span>
                            <span><i class="far fa-heart mr-1"></i>{{ $bookmark->likes }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $bookmarks->links() }}
    </div>
@endif
@endsection

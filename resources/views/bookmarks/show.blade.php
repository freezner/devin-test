@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6">
        <div class="flex justify-between items-start mb-4">
            <h1 class="text-2xl font-bold text-gray-800">{{ $bookmark->title }}</h1>
            <div class="flex items-center">
                @if(Auth::id() === $bookmark->user_id)
                    <form action="{{ route('bookmarks.destroy', $bookmark) }}" method="POST" class="inline" onsubmit="return confirm('정말로 이 북마크를 삭제하시겠습니까?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i> 삭제
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="flex items-center text-sm text-gray-600 mb-4">
            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $bookmark->category }}</span>
            @if($bookmark->tags)
                <span class="ml-2 text-gray-500">{{ $bookmark->tags }}</span>
            @endif
        </div>

        <div class="mb-6">
            <a href="{{ $bookmark->url }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                <i class="fas fa-external-link-alt mr-2"></i>{{ $bookmark->url }}
            </a>
        </div>

        @if($bookmark->thumbnail)
            <div class="mb-6">
                <img src="{{ $bookmark->thumbnail }}" alt="{{ $bookmark->title }}" class="w-full max-h-96 object-contain rounded">
            </div>
        @endif

        @if($bookmark->description)
            <div class="mb-6 text-gray-700">
                <h3 class="text-lg font-semibold mb-2">설명</h3>
                <p class="whitespace-pre-line">{{ $bookmark->description }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between text-sm text-gray-600 border-t pt-4">
            <div class="flex items-center">
                <span class="font-medium">등록자:</span>
                <span class="ml-2">{{ $bookmark->user->name }}</span>
                <span class="mx-2">•</span>
                <span>{{ $bookmark->created_at->format('Y-m-d H:i') }}</span>
            </div>
            <div class="flex items-center">
                <span class="mr-4"><i class="far fa-eye mr-1"></i>{{ $bookmark->views }}</span>
                <form action="{{ route('bookmarks.like', $bookmark) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-600">
                        <i class="far fa-heart mr-1"></i>{{ $bookmark->likes }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('bookmarks.index') }}" class="text-blue-600 hover:underline">
        <i class="fas fa-arrow-left mr-2"></i>북마크 목록으로 돌아가기
    </a>
</div>
@endsection

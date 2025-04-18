@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">북마크 등록</h2>

    <form action="{{ route('bookmarks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="url" class="block text-gray-700 font-medium mb-2">URL</label>
            <input type="url" name="url" id="url" value="{{ old('url') }}" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('url') border-red-500 @enderror"
                placeholder="https://example.com">
            @error('url')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">제목</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-medium mb-2">카테고리</label>
            <select name="category" id="category" required
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                <option value="">카테고리 선택</option>
                <option value="개발" {{ old('category') == '개발' ? 'selected' : '' }}>개발</option>
                <option value="디자인" {{ old('category') == '디자인' ? 'selected' : '' }}>디자인</option>
                <option value="마케팅" {{ old('category') == '마케팅' ? 'selected' : '' }}>마케팅</option>
                <option value="비즈니스" {{ old('category') == '비즈니스' ? 'selected' : '' }}>비즈니스</option>
                <option value="생산성" {{ old('category') == '생산성' ? 'selected' : '' }}>생산성</option>
                <option value="교육" {{ old('category') == '교육' ? 'selected' : '' }}>교육</option>
                <option value="엔터테인먼트" {{ old('category') == '엔터테인먼트' ? 'selected' : '' }}>엔터테인먼트</option>
                <option value="기타" {{ old('category') == '기타' ? 'selected' : '' }}>기타</option>
            </select>
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tags" class="block text-gray-700 font-medium mb-2">태그 (쉼표로 구분)</label>
            <input type="text" name="tags" id="tags" value="{{ old('tags') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tags') border-red-500 @enderror"
                placeholder="태그1, 태그2, 태그3">
            @error('tags')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium mb-2">설명</label>
            <textarea name="description" id="description" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                placeholder="북마크에 대한 설명을 입력하세요">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('bookmarks.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg mr-2">
                취소
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                등록하기
            </button>
        </div>
    </form>
</div>
@endsection

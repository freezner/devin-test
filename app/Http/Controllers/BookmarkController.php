<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use DOMDocument;

class BookmarkController extends Controller
{
    /**
     * Display a listing of bookmarks.
     */
    public function index()
    {
        $bookmarks = Bookmark::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('bookmarks.index', compact('bookmarks'));
    }

    /**
     * Show the form for creating a new bookmark.
     */
    public function create()
    {
        return view('bookmarks.create');
    }

    /**
     * Store a newly created bookmark in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'tags' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $bookmarkData = $request->all();
        $bookmarkData['user_id'] = Auth::id();
        
        try {
            $response = Http::get($request->url);
            if ($response->successful()) {
                $html = $response->body();
                
                $thumbnail = $this->extractMetaImage($html);
                if ($thumbnail) {
                    $bookmarkData['thumbnail'] = $thumbnail;
                }
            }
        } catch (\Exception $e) {
        }

        Bookmark::create($bookmarkData);

        return redirect()->route('bookmarks.index')
            ->with('success', '북마크가 성공적으로 등록되었습니다.');
    }

    /**
     * Display the specified bookmark.
     */
    public function show(Bookmark $bookmark)
    {
        $bookmark->increment('views');
        
        return view('bookmarks.show', compact('bookmark'));
    }

    /**
     * Remove the specified bookmark from storage.
     */
    public function destroy(Bookmark $bookmark)
    {
        if (Auth::id() !== $bookmark->user_id) {
            return redirect()->route('bookmarks.show', $bookmark)
                ->with('error', '자신이 등록한 북마크만 삭제할 수 있습니다.');
        }

        $bookmark->delete();

        return redirect()->route('bookmarks.index')
            ->with('success', '북마크가 삭제되었습니다.');
    }
    
    /**
     * Like a bookmark
     */
    public function like(Bookmark $bookmark)
    {
        $bookmark->increment('likes');
        
        return redirect()->back();
    }
    
    /**
     * Extract meta image from HTML
     */
    private function extractMetaImage($html)
    {
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        
        $tags = $doc->getElementsByTagName('meta');
        
        foreach ($tags as $tag) {
            $property = $tag->getAttribute('property');
            $name = $tag->getAttribute('name');
            
            if ($property == 'og:image' || $name == 'twitter:image') {
                return $tag->getAttribute('content');
            }
        }
        
        return null;
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;

class InstitutionalController extends Controller
{
    /**
     * @var array<string, mixed>
     */
    protected array $content;

    public function __construct()
    {
        $this->content = config('institutional');
    }

    public function home()
    {
        $featuredPosts = Post::published()
            ->with(['category', 'user'])
            ->latest('created_at')
            ->take(3)
            ->get();

        return view('front.home', [
            'hero' => $this->content['hero'],
            'about' => $this->content['about'],
            'services' => array_slice($this->content['services'], 0, 3),
            'projects' => $this->content['projects'],
            'featuredPosts' => $featuredPosts,
        ]);
    }

    public function about()
    {
        return view('front.about', [
            'about' => $this->content['about'],
            'projects' => $this->content['projects'],
            'services' => $this->content['services'],
        ]);
    }
}

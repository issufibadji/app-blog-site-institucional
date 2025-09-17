<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\View\Component;

class BlogLayout extends Component
{
    public $title;
    public bool $withSidebar;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, bool $withSidebar = false)
    {
        $this->title = $title;
        $this->withSidebar = $withSidebar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = Category::select('id', 'name', 'slug')->get();
        $top_users = User::withCount('posts')->orderByDesc('posts_count')->take(5)->get();
        $setting = Setting::first();
        $pages_nav = Page::select('id', 'name', 'slug')->whereNavbar(true)->orderByDesc('id')->get();
        $pages_footer = Page::select('id', 'name', 'slug')->whereFooter(true)->orderByDesc('id')->get();
        $tags = Tag::whereHas('posts', function ($q) {
            $q->where('status', true);
        })->get();

        return view('layouts.blog', [
            'categories' => $categories,
            'top_users' => $top_users,
            'setting' => $setting,
            'pages_nav' => $pages_nav,
            'pages_footer' => $pages_footer,
            'tags' => $tags,
            'withSidebar' => $this->withSidebar,
            'title' => $this->title,
        ]);
    }
}

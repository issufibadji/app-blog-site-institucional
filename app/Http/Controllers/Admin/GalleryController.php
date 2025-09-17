<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Gallery::class, 'gallery');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $galleries = Gallery::withService()->latest()->paginate(15);

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $services = Service::ordered()->pluck('title', 'id');

        return view('admin.gallery.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images/galleries');
        }

        unset($data['image']);

        Gallery::create($data);

        return to_route('admin.gallery.index')->with('message', trans('admin.gallery_created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): View
    {
        $services = Service::ordered()->pluck('title', 'id');

        return view('admin.gallery.edit', compact('gallery', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('images/galleries');
        }

        unset($data['image']);

        $gallery->update($data);

        return to_route('admin.gallery.index')->with('message', trans('admin.gallery_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return to_route('admin.gallery.index')->with('message', trans('admin.gallery_deleted'));
    }
}

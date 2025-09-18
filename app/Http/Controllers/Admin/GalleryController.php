<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
            $filename = uniqid() . '.' . $request->file('image')->extension();
            // Grava em storage/app/public/galleries
            $request->file('image')->storeAs('galleries', $filename, 'public');
            // Banco recebe APENAS "galleries/arquivo.jpg"
            $data['image_path'] = 'galleries/' . $filename;
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
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $filename = uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('galleries', $filename, 'public');
            $data['image_path'] = 'galleries/' . $filename;
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
        if ($gallery->image_path && Storage::disk('public')->exists('galleries/' . $gallery->image_path)) {
            Storage::disk('public')->delete('galleries/' . $gallery->image_path);
        }

        $gallery->delete();

        return to_route('admin.gallery.index')->with('message', trans('admin.gallery_deleted'));
    }
}

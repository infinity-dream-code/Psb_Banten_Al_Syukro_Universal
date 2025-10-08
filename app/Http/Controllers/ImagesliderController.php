<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImageSlider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImagesliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = ImageSlider::with('user')->orderByDesc('tanggal_upload')->get();
        return view('dashboard.settings.image-slide.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.image-slide.create');
    }

    public function store(Request $request)
{
    if (ImageSlider::count() > 5) {
        return redirect()->route('setting-slider.index')->with('error', 'Maksimal hanya 5 image slider yang bisa diupload.');
    }

    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    $path = $request->file('image')->store('image-slider', 'public');

    ImageSlider::create([
        'id_user' => Auth::id(),
        'image' => $path,
        'tanggal_upload' => now()
    ]);

    return redirect()->route('setting-slider.index')->with('success', 'Image slider berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   public function edit(ImageSlider $setting_slider)
    {
        return view('dashboard.settings.image-slide.edit', compact('setting_slider'));
    }

    public function update(Request $request, ImageSlider $setting_slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($setting_slider->image && Storage::disk('public')->exists($setting_slider->image)) {
                Storage::disk('public')->delete($setting_slider->image);
            }

            $path = $request->file('image')->store('image-slider', 'public');
            $setting_slider->image = $path;
            $setting_slider->tanggal_upload = now();
        }

        $setting_slider->id_user = Auth::id();
        $setting_slider->save();

        return redirect()->route('setting-slider.index')->with('success', 'Image slider berhasil diperbarui!');
    }

    public function destroy(ImageSlider $setting_slider)
    {
        if ($setting_slider->image && Storage::disk('public')->exists($setting_slider->image)) {
            Storage::disk('public')->delete($setting_slider->image);
        }

        $setting_slider->delete();
        return redirect()->route('setting-slider.index')->with('success', 'Image slider berhasil dihapus!');
    }
}

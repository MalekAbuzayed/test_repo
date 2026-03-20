<?php

namespace App\Http\Controllers\User;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $aboutSliders = Slider::query()
            ->where('status', 1)
            ->latest()
            ->get()
            ->filter(function (Slider $slider) {
                $imagePath = trim((string) $slider->getRawOriginal('image'));

                if ($imagePath === '') {
                    return false;
                }

                $publicImagePath = public_path(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $imagePath));

                if (! is_file($publicImagePath)) {
                    return false;
                }

                $extension = strtolower(pathinfo($publicImagePath, PATHINFO_EXTENSION));

                return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp', 'avif'], true);
            })
            ->values();

        return view('user.index', compact('aboutSliders'));
    }
}

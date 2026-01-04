@php
    $url = null;
    if (! empty($path)) {
        try {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $url = \Illuminate\Support\Facades\Storage::url($path);
            } elseif (file_exists(public_path($path))) {
                $url = asset($path);
            } elseif (file_exists(public_path('storage/'.$path))) {
                $url = asset('storage/'.$path);
            }
        } catch (\Throwable $e) {
            // ignore and leave $url null
        }
    }
@endphp
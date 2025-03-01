<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileDownload extends Component
{
    public function export(string $path , string $newName)
    {
        return response()->download(storage_path($path),$newName);
    }

    public function show(string $path)
    {
        return response()->file(storage_path($path));
    }

    public function render()
    {
        return view('livewire.file-download');
    }
}

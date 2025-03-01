<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUpload extends Component
{
    use WithFileUploads;
 
    public $title;
    public $file_name;
 
    public function submit()
    {
        $data = $this->validate([
            'title' => 'required',
            'file_name' => 'required',
        ]);
        $filename = $this->file_name->store('documents','public');
 
        $fileData['url'] = $filename;
        $fileData['name'] = $data['title'];
 
        File::create($fileData);
 
        session()->flash('message', 'File has been successfully Uploaded.');
 
        return redirect()->to('/livewire-file-upload');
    }
 
    public function render()
    {
        return view('livewire.file-upload');
    }
}

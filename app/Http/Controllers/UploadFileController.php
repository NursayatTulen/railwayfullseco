<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function index()
    {
        $files = Storage::disk('public')->files('uploads');
        
        return view('upload', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            
            $path = $file->storeAs('uploads', $fileName, 'public');

            return back()->with('success', __('File uploaded successfully: :name', ['name' => $fileName]));
        }

        return back()->with('error', __('Failed to upload file.'));
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('image') ?? ($request->hasFile('images') ? $request->images[0] : null);

        if ($file) {
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('images/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return $folder;
        }

        return '';
    }

    public function destroy(Request $request)
    {
        $imageFolder = $request->getContent();
        $directoryPath = storage_path('app/public/images/tmp/' . $imageFolder);
        if (is_dir($directoryPath)) {
            foreach (glob($directoryPath . '/*') as $file) {
                if (is_file($file)) {
                    unlink($file); // Delete the file
                }
            }
            rmdir($directoryPath);
        }

        $temporaryFile = TemporaryFile::where('folder', $imageFolder)->first();
        if ($temporaryFile) {
            $temporaryFile->delete();
        }

        return response()->json(['success' => true, 'message' => 'Folder and associated record deleted successfully.']);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Validator;

use App\Listing;
use App\Comite;
use App\Folder;
use Image;

class FolderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function create(Request $request) {
        error_log('Creation nv folder');
    
        // Validation ici si nécessaire
    
        $folder = new Folder;
    
        // Assigner le nom du dossier de la requête à la variable $folderName
        $folderName = $request->name;
    
        // Chemin du dossier où vous souhaitez créer le sous-dossier
        $documentPath = public_path('/documents/');
    
        // Créer le sous-dossier
        File::makeDirectory($documentPath . $folderName, 0777, true, true);
    
        $folder->name = $folderName;
        $folder->description = $request->description;
        $folder->save();
    
         return response()->json(['id' => $folder->id, 'name' => $folder->name]);

    }
    
    
}
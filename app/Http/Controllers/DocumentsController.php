<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;


use Illuminate\Http\Request;
use App\Commande;
use App\Fut;
use App\Folder;
use App\FutCommande;
use App\Materiel;
use App\User;
use App\MaterielCommande;
use App\Comite;
use App\Event;
use Validator, Input, Redirect;
use Mail, Auth;
use Carbon\Carbon;
use App\Document;
use Illuminate\Support\Facades\File;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure you have an 'admin' middleware or change this accordingly
    }

    public function index()
    {   $folders = Folder::orderBy('name', 'asc')->get();

        error_log('--------------------------------------Je passe dans doc contro');
        if(Auth::user()->droit == 1 ){
            $documents = Document::where('droit_access', "1" )->orderBy('id')->get();}
        if(Auth::user()->droit == 2 ){
            $documents = Document::where('droit_access', $acces)->orderBy('id')->get();
            }
            
            $documents = Document::orderBy('id')->get();

            error_log($documents);
        return view('documents.index', compact('documents','folders'));
    }

    public function add()
    {
        $folders = Folder::orderBy('id')->get();
        return view('documents.create', compact('folders'));
    }

    public function upload(Request $request)
    {
        $rules = [
            'title' => 'required',
            'file' => 'required|file', // Assuming you are uploading a file
            'droit_acces' => 'required',
            'folder_id' => 'required',
        ];

        $messages = [
            'title' => 'The :attribute field is required.',
            'file' => 'The :attribute must be a valid document file.',
            'droit_acces' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Store the document (you will need logic for storing the uploaded file if applicable)
        $document = new Document;
        //$document->title = $request->title;
        $document->title = $request ->title;
        //$full_path = "coucou.pdf";
        $uploadedFile = request()->file('file');

       /* $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $uploadedFile->getClientOriginalExtension();

        $filePath = $originalFilename . '.' . $fileExtension;*/
        // 1. Recherchez le dossier en utilisant l'ID de la requête.
        $folder = Folder::find($request->folder_id);

        if (!$folder) {
            return redirect()->back()->with('error', 'Dossier non trouvé.');
        }

        // 2. Utilisez le nom de ce dossier pour définir le chemin du sous-dossier.
        $folderName = $folder->name; // Supposons que la colonne "name" dans la table "Folder" stocke le nom du dossier
        $subDirectoryPath = public_path('/documents/' . $folderName . '/');

        // Vérifiez si le sous-dossier existe. Si non, créez-le.
        if (!File::exists($subDirectoryPath)) {
            File::makeDirectory($subDirectoryPath, 0777, true, true);
        }

        // 3. Déplacez le fichier vers ce sous-dossier.
        $filePath = $request->title . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($subDirectoryPath, $filePath);

        $document->file_path = '/documents/' . $folderName . '/' . $filePath;
        $document->droit_access = $request->droit_acces;
        $document->folder = $request->folder_id;

        // Sauvegardez l'objet document comme vous le faites normalement.
        $document->save();


        return redirect('/documents/index')->with('status', 'Document saved successfully!');
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.preview', compact('document'));
    }
    

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        error_log('Arrivée dans upd');
    
        $document = Document::findOrFail($id);
    
        $rules = [
            'title' => 'required',  // Use 'title' instead of 'name'
            'file' => 'file',       // Use 'file' which is the input name for uploading files
            'droit_access' => 'required|in:1,2',
        ];
    
        $messages = [
            'title.required' => 'The title field is required.',
            'file.file' => 'The file must be a valid document file.',
            'droit_access.required' => 'Access rights are required.',
            'droit_access.in' => 'Invalid access rights value.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $document->title = $request->title;
    
        // If a new file is uploaded, process it and save the new file path
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            if (File::exists($document->file_path)) {
                File::delete($document->file_path);
            }
            $uploadedFile = request()->file('file');
             $filePath= $request ->title . '.' . $uploadedFile->getClientOriginalExtension();
             $documentPath = public_path('/documents/');
             $uploadedFile->move($documentPath, $filePath);
             $document->file_path = '/documents/' . $filePath;
        }
    
        $document->droit_access = $request->droit_access;
        $document->save();
    
        return redirect('/documents/index')->with('status', 'Document updated successfully!');
    }
    

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $document->delete();
        return redirect('/documents/index')->with('status', 'Document deleted successfully!');
    }




    public function download($id)
    {
        // Fetch the document from the database based on the provided ID
        $document = Document::find($id);

        // If the document doesn't exist, return an error
        if (!$document) {
            return redirect()->back()->with('error', 'Document not found!');
        }

        $path =public_path($document->file_path);  // Assuming the file_path column stores the full path to the file

        // Log the path for debugging
        error_log('File Path: ' . $path);

        // Check if file exists
        /*if (!File::exists($path)) {
            dd("Il n'y a pas de document"); 
        }*/
        $file = File::get($path);
        $type = File::mimeType($path);

        // Assuming you want to use the title of the document as the filename
        $filename = $document->title . '.' . pathinfo($path, PATHINFO_EXTENSION); // extract the file extension from the path

        return response($file, 200)
            ->header('Content-Type', $type)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}

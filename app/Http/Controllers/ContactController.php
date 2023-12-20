<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collaborator;
use App\Http\Requests\CollaborateRequest;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Collaborator $collaborator)
    {
        return view('collaborator.index');
    }

    public function indexServerSide(Collaborator $collaborator)
    {
        $data = Collaborator::get()->toArray();
        return DataTables::of($data)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('collaborator.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollaborateRequest $request)
    {
        $contacto = new Collaborator;
        $contacto->name = $request->input('name');
        $contacto->last_name = $request->input('last_name');
        $contacto->email = $request->input('email');
        $contacto->phone = $request->input('phone');
        $contacto->birthday = $request->input('birthday');
        

        if ($request->hasFile('imagen')) {
            $contacto->fill(['image' => $this->uploadFiles($request->file('imagen'), 'foto' . '1', 'foto')])->save();
        }

        $contacto->save();


        return redirect()->route('contacto.index')->with( 'success' , 'El contacto fue creado.' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collaborator $contacto)
    {
  
        $data = $contacto;
         return view('collaborator/show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaborator $contacto)
    {
 
        $data = $contacto;
        return view('collaborator.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CollaborateRequest $request,Collaborator $contacto)
    {

        $contacto->name = $request->input('name');
        $contacto->last_name = $request->input('last_name');
        $contacto->email = $request->input('email');
        $contacto->phone = $request->input('phone');
        $contacto->birthday = $request->input('birthday');

        if ($request->hasFile('imagen')) {
            $contacto->fill(['image' => $this->uploadFiles($request->file('imagen'), 'foto' . '1', 'foto')])->save();
        }

        $contacto->save();

        return redirect()->route('contacto.index')->with( 'success' , 'El contacto fue actualizado.' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborator $contacto)
    {
        $contacto->delete();

        return redirect()->route('contacto.index')->with( 'success' , 'El contacto fue eliminado.' );
    }

    function uploadFiles($files, $identificador, $subdirectorio = '') {
        if ( ! $files) {
            return null;
        }
        if ( ! is_array($files)) {
            $files = [$files];
        }
    
        $files_array = [];
        $i = 0;
        foreach ($files as $foto) {
            $extension = $foto->getClientOriginalExtension();
            $documentoName = \Illuminate\Support\Str::slug($identificador) . '-' . ++$i . '-' . time() . '.' . $extension;
            $foto->move(base_path() . '/public/storage/' . $subdirectorio, $documentoName);
            array_push($files_array, $documentoName);
    
        }
    
        return implode(',', $files_array);
    }


 
}

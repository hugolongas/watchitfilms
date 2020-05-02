<?php

namespace App\Http\Controllers;

use App\Miembro;
use App\Cargo;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class MiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = Miembro::all();
            return Datatables::of($data)
            ->addColumn('edit', function ($row) {
                $url = route('admin.miembros.edit', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                return $btn;
            })
            ->addColumn('cargos', function ($row) {
                $cargos = $row->cargos()->get();
                $cargosList = "";
                $i =0;
                $len = count($cargos);
                foreach($cargos as $c)
                {
                    if($i == $len-1){
                        $cargosList.=$c->cargo;
                    }
                    else{
                        $cargosList.=$c->cargo.',';
                    }
                    $i++;
                }
                return $cargosList;
            })
            ->rawColumns(['edit','cargos'])->make(true);
        }
       return view('admin.miembros.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        return view('admin.miembros.create')->with('cargos',$cargos);
    }

    public function store(Request $request)
    {
        $v = $request->validate([
            'nombre' =>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
		]);      
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $file = $request->file('avatar');
        $cargos = $request->input('cargo');
        $linkedIn = $request->input('linkedin');
        if($email==null){
            $email = "";
        } 
        if($telefono==null){
            $telefono = "";
        }  
        
        if($linkedIn==null){
            $linkedIn = "";
        }     

        if ($file != null) {
            $avatar = "";
            $filePath = "";
            $miembro = new Miembro;
            $miembro->nombre = $nombre;
            $miembro->email = $email;
            $miembro->telefono = $telefono;
            $miembro->avatar = "";
            $miembro->linkedin = $linkedIn;
            $miembro->save();
            foreach($cargos as $c)
            {
                $miembro->cargos()->attach($c);
            }

            $clienteID = $miembro->id;
            $path = 'avatar/';
            $avatar = $clienteID."_".$file->getClientOriginalName();
            $filePath = $path . $avatar;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $miembro->avatar = $avatar;
            $miembro->save();
            return redirect()->route('admin.miembros.index')->with('success','Miembro Creado Correctamente');
        }		
    }

    public function edit($id)
    {
        $miembro = Miembro::findOrFail($id);
        $cargos = Cargo::all();
        return view("admin.miembros.edit")->with('miembro', $miembro)->with('cargos',$cargos);
    }

    public function update(Request $request)
    {
        $v = $request->validate([
            'nombre' =>'required',
            'email'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
		]);
        $id = $request->id;        
        $nombre = $request->input('nombre');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $linkedIn = $request->input('linkedin');        
        $cargos = $request->input('cargo');
        $file = $request->file('avatar');
        $oldThumbnail = $request->input('old_thumbnail');
        
        if($email==null){
            $email = "";
        } 
        if($telefono==null){
            $telefono = "";
        }
        if($linkedIn==null){
            $linkedIn = "";
        }
         
        $miembro = Miembro::findOrFail($id);
        $miembro->cargos()->detach();
        if ($file != null) {
            $avatar = "";
            $filePath = "";
            $path = 'avatar/';
            $avatar = $id."_".$file->getClientOriginalName();
            $filePath = $path . $avatar;

            $deletePath = $path.$oldThumbnail;
            Storage::disk('public')->delete($deletePath);
            Storage::disk('public')->put($filePath, file_get_contents($file));                       
            
            $miembro->nombre = $nombre;
            $miembro->email = $email;
            $miembro->telefono = $telefono;
            $miembro->avatar = $avatar;
            $miembro->linkedin = $linkedIn;
            $miembro->save();
        } else {            
            $miembro->nombre = $nombre;
            $miembro->email = $email;
            $miembro->telefono = $telefono;
            $miembro->linkedin = $linkedIn;
            $miembro->save();
        }       
        if($cargos!=null){
            foreach($cargos as $c)
            {
                $miembro->cargos()->attach($c);
            }
        }
        return redirect()->route('admin.miembros.index')->with('success','Miembro actualizado correctamente');
    }

    public function delete($id)
    {
        $m = Miembro::findOrFail($id);
        $path = 'avatar/';
        $thumbnail = $m->avatar;
        $filePath = $path . $thumbnail;
        
        Storage::disk('public')->delete($filePath);        
        $m->cargos()->detach();
        $m->delete();
        
    }
}

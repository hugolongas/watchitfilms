<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
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
            $data = Cliente::all();
            return Datatables::of($data)
            ->addColumn('edit', function ($row) {
                $url = route('admin.clientes.edit', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                return $btn;
            })->rawColumns(['edit'])->make(true);
        }
       return view('admin.clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = $request->validate([
            'nombre_empresa' =>'required',
            'url'=>'required',
            'logo'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
		]);
        $nombre_empresa = $request->input('nombre_empresa');
        $url = $request->input('url');
        $file = $request->file('logo');

        $thumbnail = "";
        $filePath = "";

        if ($file != null) {
            $cliente = new Cliente;
            $cliente->nombre_empresa = $nombre_empresa;
            $cliente->url = $url;
            $cliente->logo = "";
            $cliente->save();

            $clienteID = $cliente->id;
            $path = 'clientes/';
            $thumbnail = $clienteID."_".$file->getClientOriginalName();
            $filePath = $path . $thumbnail;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $cliente->logo = $thumbnail;
            $cliente->save();
            return redirect()->route('admin.clientes.index')->with('success','Cliente Creado Correctamente');
        }		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view("admin.clientes.edit")->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $v = $request->validate([
            'nombre_empresa' =>'required',
            'url'=>'required',
            'logo'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
		]);
        $id = $request->id;        
        $nombre_empresa = $request->input('nombre_empresa');
        $url = $request->input('url');
        $file = $request->file('logo');
        $oldThumbnail = $request->input('old_thumbnail');

        $thumbnail = "";
        $filePath = "";

        if ($file != null) {
            $thumbnail = "";
            $filePath = "";
            $path = 'clientes/';
            $thumbnail = $id."_".$file->getClientOriginalName();
            $filePath = $path . $file->getClientOriginalName();

            $deletePath = $path.$oldThumbnail;
            Storage::disk('public')->delete($deletePath);
            Storage::disk('public')->put($filePath, file_get_contents($file));            
            
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre_empresa = $nombre_empresa;
            $cliente->url = $url;
            $cliente->logo = $thumbnail;
            $cliente->save();
        } else {
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre_empresa = $nombre_empresa;
            $cliente->url = $url;
            $cliente->save();
        }
        return redirect()->route('admin.clientes.index')->with('success','Cliente actualizado correctamente');
    }

    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $path = 'clientes/';
        $thumbnail = $cliente->logo;
        $filePath = $path . $thumbnail;
        
        Storage::disk('public')->delete($filePath);        
        $cliente->delete();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}

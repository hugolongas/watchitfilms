<?php

namespace App\Http\Controllers;

use App\Cargo;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Notification;

class CargoController extends Controller
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
            $data = Cargo::all();
            return Datatables::of($data)
            ->addColumn('edit', function ($row) {
                $url = route('admin.cargos.edit', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                return $btn;
            })->rawColumns(['edit'])->make(true);
        }
       return view('admin.cargos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cargos.create');
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
			'cargo' =>'required',
		]);
		$c = $request->input('cargo');

		$cargo = new Cargo;
		$cargo->cargo = $c;
		$cargo->save();
		return redirect()->route('admin.cargos.index')->with('success','Cargo Creada Correctamente');	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cargo  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        return view("admin.cargos.edit")->with('cargo', $cargo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cargo  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $Cargo)
    {
        $v = $request->validate([
			'cargo' =>'required',
		]);
		$c = $request->input('cargo');
        $id = $request->id;        
        $cargo = Cargo::findOrFail($id);
		$cargo->cargo = $c;
		$cargo->save();
		return redirect()->route('admin.cargos.index')->with('success','Cargo actualizada correctamente');	
    }

    public function delete($id)
    {
        $cargo = Cargo::findOrFail($id);     
        $cargo->delete();        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}

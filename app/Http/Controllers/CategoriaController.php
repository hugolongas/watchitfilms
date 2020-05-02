<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Notification;

class CategoriaController extends Controller
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
            $data = Categoria::all();
            return Datatables::of($data)
            ->addColumn('edit', function ($row) {
                $url = route('admin.categories.edit', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                return $btn;
            })->rawColumns(['edit'])->make(true);
        }
       return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
			'categoria' =>'required',
		]);
		$c = $request->input('categoria');

		$categoria = new Categoria;
        $categoria->categoria = $c;
        $categoria->name = $this->sanitizer($c);
		$categoria->save();
		return redirect()->route('admin.categories.index')->with('success','Categoria Creada Correctamente');	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view("admin.categories.edit")->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $v = $request->validate([
			'categoria' =>'required',
		]);
		$c = $request->input('categoria');
        $id = $request->id;        
        $categoria = Categoria::findOrFail($id);
        $categoria->categoria = $c;
        $categoria->name = $this->sanitizer($c);
		$categoria->save();
		return redirect()->route('admin.categories.index')->with('success','Categoria actualizada correctamente');	
    }

    public function delete($id)
    {
        $categoria = Categoria::findOrFail($id);     
        $categoria->delete();        
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

    public static function sanitizer($url){
        $url = strtolower($url);
        //Reemplazamos caracteres especiales latinos
        $find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç','ñ');
        $repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c','n');
        $url = str_replace($find, $repl, $url);
        //Añadimos los guiones
        $find = array(' ', '&', '\r\n', '\n','+');
        $url = str_replace($find, '-', $url);
        //Eliminamos y Reemplazamos los demas caracteres especiales
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<{^>*>/');
        $repl = array('', '-', '');
        $url = preg_replace($find, $repl, $url);
        return $url;
       }
}

<?php

namespace App\Http\Controllers;

use App\Adjunto;
use App\Article;
use Illuminate\Http\Request;

class AdjuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adjunto  $adjunto
     * @return \Illuminate\Http\Response
     */
    public function show(Adjunto $adjunto)
    {
        //
    }

    public function edit($id)
    {
        $articulo = Article::find($id);
        $adjuntos = $articulo->adjuntos()->orderBy('position')->get();
        return view('admin.articles.adjuntos.edit')->with('id',$id)->with('adjuntos',$adjuntos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adjunto  $adjunto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $articleId = $request->get('id');
        $adjuntos = $request->get('adjuntos');
        $articulo = Article::find($articleId);
        $adjuntosArticle = $articulo->adjuntos;
        foreach($adjuntos as $adjunto)
        {
            $id = $adjunto["id"];
            $medio_id = $adjunto["medio_id"];
            $url = $adjunto["url"];
            $description = $adjunto["description"];
            if($description==null)
            $description = "";
            $pos = $adjunto["position"];
            $extension = $adjunto["extension"];
            if($id==0)
            {
                $adj = new Adjunto();
                $adj->Id = $id;
                $adj->medio_id = $medio_id;
                $adj->url = $url;
                $adj->description = $description;
                $adj->position = $pos;
                $adj->extension = $extension;
                $adj->save();
                $articulo->adjuntos()->attach($adj);
            }
            else
            {
                $adj = Adjunto::find($id);     
                $adj->description = $description;           
                $adj->position = $pos;
                $adj->save();
               
                $filtered = $adjuntosArticle->filter(function ($value, $key) use($id){
                    return $value['id']!=$id;
                });
                $adjuntosArticle = $filtered;
            }
        }
        foreach($adjuntosArticle as $adjArt)
        {
            $articulo->adjuntos()->detach($adjArt);
        }
        return "true";
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $adjuntoId = $request->userId;
        $articulo = Article::findOrFail($id);
        $articulo->adjuntos()->detach($adjuntoId);
    }

}

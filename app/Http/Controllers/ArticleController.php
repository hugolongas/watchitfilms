<?php

namespace App\Http\Controllers;

use App\Article;
use App\Categoria;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::orderBy('updated_at','desc')->get();

            return Datatables::of($data)
                ->addColumn('edit', function ($row) {
                    $url = route('admin.article.edit', ['id' => $row->id]);
                    $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                    return $btn;
                })->addColumn('adj', function ($row) {
                    $url = route('admin.adjuntos.edit', ['id' => $row->id]);
                    $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Añadir Adjuntos</a>';
                    return $btn;
                })->addColumn('view', function ($row) {
                    $url = route('admin.article.show', ['id' => $row->id]);
                    $btn = '<a href="' . $url . '" class="view btn btn-primary btn.sm">Ver</a>';
                    return $btn;
                })->addColumn('categoria', function ($row) {
                    $cat = Categoria::findOrFail($row->categoria_id);                    
                    return $cat->categoria;
                })->addColumn('slug', function ($row) {
                    $slug = $row->slug();
                    return $slug;
                })->rawColumns(['view', 'edit', 'categoria', 'adj','slug'])->make(true);
        }
        return view('admin.articles.index');
    }    

    public function AdminShow($id)
    {
        $article = Article::findOrFail($id);
        return view("admin.articles.show")->with("article", $article);
    }

    public function Create()
    {
        $categorias = Categoria::all();
        return view("admin.articles.create")->with("categorias", $categorias);
    }
    
    public function Store(Request $request)
    {
        $v = $request->validate([
            'titulo' => 'required',
            'input_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');
        $cliente = $request->input('cliente');

        $categoria_id = $request->input('categoria');
        $direccion = $request->input('direccion');
        $produccion = $request->input('produccion');
        $post_produccion = $request->input('post_produccion');
        $fotografo = $request->input('fotografo');

        $file = $request->file('input_img');
        $thumbnail = "";
        $filePath = "";
        if ($descripcion == null)
            $descripcion = "";

        if ($direccion == null)
            $direccion = "";

        if ($produccion == null)
            $produccion = "";

        if ($post_produccion == null)
            $post_produccion = "";

        if ($fotografo == null)
            $fotografo = "";

        if ($file != null) {
            $a = new Article;
            $a->titulo = $titulo;
            $a->descripcion = $descripcion;
            $a->cliente = $cliente;
            $a->thumbnail = "";
            $a->categoria_id = $categoria_id;
            $a->direccion = $direccion;
            $a->produccion = $produccion;
            $a->post_produccion = $post_produccion;
            $a->fotografo = $fotografo;
            $a->activo = false;
            $a->save();

            $articleID = $a->id;
            $path = 'articles/';
            $thumbnail = $articleID . '_'.$file->getClientOriginalName();
            $filePath = $path . $thumbnail;
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $a->thumbnail = $thumbnail;
            $a->save();

            if ($request->has('crear_continuar')) {
                return redirect()->route('admin.adjuntos.edit', $articleID);
            } else {
                return redirect()->route('admin.article.index');
            }
        } else { }
    }
    
    public function Edit($id)
    {
        $categorias = Categoria::all();
        $articulo = Article::findOrFail($id);
        return view("admin.articles.edit")->with('article', $articulo)->with("categorias", $categorias);
    }

    public function Update(Request $request)
    {
        $v = $request->validate([
            'titulo' => 'required',
            'input_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $id = $request->id;
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');
        $cliente = $request->input('cliente');
        $oldThumbnail = $request->input('old_thumbnail');
        $categoria_id = $request->input('categoria');
        $direccion = $request->input('direccion');
        $produccion = $request->input('produccion');
        $post_produccion = $request->input('post_produccion');
        $fotografo = $request->input('fotografo');

        $file = $request->file('input_img');
        if ($descripcion == null)
            $descripcion = "";

        if ($direccion == null)
            $direccion = "";

        if ($produccion == null)
            $produccion = "";

        if ($post_produccion == null)
            $post_produccion = "";

        if ($fotografo == null)
            $fotografo = "";

        if ($file != null) {
            $thumbnail = "";
            $filePath = "";
            $path = 'articles/';
            $thumbnail = $id . '_' . $file->getClientOriginalName();
            $filePath = $path . $thumbnail;
            $deletePath = $path . $oldThumbnail;
            Storage::disk('public')->delete($deletePath);
            Storage::disk('public')->put($filePath, file_get_contents($file));
        } else {
            $thumbnail = $oldThumbnail;
        }

        $a = Article::findOrFail($id);
        $a->titulo = $titulo;
        $a->descripcion = $descripcion;
        $a->cliente = $cliente;
        $a->thumbnail = $thumbnail;
        $a->categoria_id = $categoria_id;
        $a->direccion = $direccion;
        $a->produccion = $produccion;
        $a->post_produccion = $post_produccion;
        $a->fotografo = $fotografo;
        $a->save();

        if ($request->has('actualizar_continuar')) {
            return redirect()->route('admin.adjuntos.edit', $id);
        } else {
            return redirect()->route('admin.article.index');
        }
    }

    public function Delete($id)
    {
        $article = Article::findOrFail($id);        
        $article->adjuntos()->detach();
        $article->delete();
        $path = 'articles/';
        $thumbnail = $article->thumbnail;
        $filePath = $path . $thumbnail;
        Storage::disk('public')->delete($filePath);
    }

    public function Activate($id)
    {
        $article = Article::findOrFail($id);
        $activo = $article->activo;
        $titulo = $article->titulo;
        $cliente = $article->cliente;
        $url = $this->_seoUrl($cliente . "-" . $titulo . "-" . $id);
        $article->url = $url;
        if ($activo == 0)
            $article->activo = 1;
        else
            $article->activo = 0;
        $article->save();
        return $article->activo;
    }

    public function Reorder()
    {
        $articles = Article::orderBy('position', 'asc')->where('activo', true)->get();
        return view("admin.articles.reorder")->with("articulos", $articles);
    }
    
    public function SaveReorder(Request $request)
    {
        try{
            $articles = $request->get('articles');
            foreach($articles as $article)
            {
                $id = $article["id"];
                $pos = $article["position"];            
                $a = Article::find($id); 
                $a->position = $pos;
                $a->save();
            }
            return "true";
        }
        catch(Exception $e){
            return "false";
        }
    }
    /*End Admin Functions*/

    
    /*Web Functions*/
    public function Show($category, $slug)
    {
        $article = Article::firstOrFail()->where('url', $slug)->get();
        if ($article->count() > 0)
            return view("article")->with("article", $article[0]);
        else
            return response()->view('errors.404', [], 404);
    }
    
    public function CategoryArticles($category)
    {
        $cat = Categoria::firstOrFail()->where('name', $category)->get();
        if ($cat->count() > 0) {
            $articles = Article::all()->where('categoria_id', $cat[0]->id);
            return view("category")->with("categoria", $cat[0])->with("articles", $articles);
        } else
            return response()->view('errors.404', [], 404);
    }
    /*End Web Functions*/


    /*Private Functions*/
    private function _seoUrl($string)
    {
        //Lower case everything
        $finalString = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $finalString = preg_replace("/[^a-z0-9_\s-]/", "", $finalString);
        //Clean up multiple dashes or whitespaces
        $finalString = preg_replace("/[\s-]+/", " ", $finalString);
        //Convert whitespaces and underscore to dash
        $finalString = preg_replace("/[\s_]/", "-", $finalString);
        return $finalString;
    }
    /*End Private Functions*/
}

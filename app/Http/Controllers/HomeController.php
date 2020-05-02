<?php

namespace App\Http\Controllers;
use App\Article;
use App\Categoria;
use App\Cliente;
use App\Miembro;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function Index()
    {
        $articles = Article::orderBy('position', 'asc')->where('activo', true)->get();
        $categorias = Categoria::all();
        $clientes = Cliente::all();        
        $dir = 'general/portada/';
        $files = app('App\Http\Controllers\MedioController')->GetFilesFromStorage($dir);
        $file = $files[array_rand($files,1)];
        return view('index')->with('articles',$articles)
        ->with('categorias',$categorias)->with('clientes',$clientes)->with('file',$file);
    }
    public function IndexAdmin()
    {
        $dir = 'general/portada/';
        $files = app('App\Http\Controllers\MedioController')->GetFilesFromStorage($dir);
        
        return view('admin.index')->with('files',$files);
    }

    public function Weare()
    {
        $miembros = Miembro::all();
        return view('weare')->with('miembros',$miembros);
    }

    public function Contact()
    {
        return view('contact');
    }

    public function PoliticaPrivacidad(){
        return view('politicaPrivacidad');
    }
    public function PoliticaCookie(){
        return view('politicaCookies');
    }
    
    public function SendContact(Request $request)
    {
        $name = $request->input('name');
        $enterprise = $request->input('enterprise');
        $email = $request->input('email');
        $message = $request->input('message');
        Mail::to('info@watchitfilms.es')->send(new Contact($name,$enterprise,$email,$message));
    }

    public function LoadModal($id)
    {
        
        $article = Article::find($id);
        if($article!=null)
        {
            $num = $article->adjuntos()->count();
            $view = null;
            if($num>1)
            {
                $view = \View::make('modals.gallery')->with('article',$article);                
            }
            else
            {
                $view = \View::make('modals.single')->with('article',$article);
            }
            if($view!=null)
            return $view->render();
        }
        return "";

    }
}

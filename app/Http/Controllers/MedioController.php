<?php

namespace App\Http\Controllers;

use App\Medio;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Storage;
use Validator;

class MedioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Medio::all();

            return Datatables::of($data)->addColumn('edit', function ($row) {
                $url = route('admin.article.edit', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="edit btn btn-primary btn.sm">Editar</a>';
                return $btn;
            })->addColumn('view', function ($row) {
                $url = route('admin.article.show', ['id' => $row->id]);
                $btn = '<a href="' . $url . '" class="view btn btn-primary btn.sm">Ver</a>';
                return $btn;
            })->addColumn('categoria', function ($row) {
                $cat = Categoria::findOrFail($row->categoria_id);
                return $cat->categoria;
            })
                ->rawColumns(['view', 'edit', 'categoria'])->make(true);
        }
        return view('admin.articles.index');
    }

    public function getData()
    {
        $medios = Medio::all();
        return Datatables::of($medios)->make(true);
    }

    public function UploadImage(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required',
            'select_file.*' => '|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validation->passes()) {
            $path = '/medios/';
            $pathThumb = '/medios/thumb/';
            $medios = collect();
            if ($request->hasfile('select_file')) {
                foreach ($request->file('select_file') as $image) {
                    $extension = $image->getClientOriginalExtension();                    
                    $imgName = Str::random(8) . date('Ymdhm');
                    $image_name = $imgName . '.'.$extension;
                    $filePath = $path . $image_name;                    
                    Storage::disk('public')->put($filePath,file_get_contents($image));
                    //Thumbnail
                    $img = Image::make($image)
                    ->resize(400, null, function ($constraint) { $constraint->aspectRatio(); } )
                    ->encode($extension,80);
                    $thumbPath = $pathThumb.$image_name;                    
                    Storage::disk('public')->put($thumbPath,$img);
                    
                    $medio = new Medio();
                    $medio->url = $image_name;
                    $medio->extension = $extension;
                    $medio->save();
                    $medios->push($medio);
                }
                return response()->json($medios);
            }
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function UploadVideo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'video_url' => 'required'
        ]);
        if ($validation->passes()) {
            $videoUrl = $request->input('video_url');            
            if(strpos($videoUrl,'youtube'))
            {
                $url =  $this->get_youtube_video_ID($videoUrl);
                $extension = 'ytb';
            }
                $medio = new Medio();
                $medio->url = $url;
                $medio->extension = $extension;
                $medio->save();
                return response()->json($medio);            
            
        } else {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    public function UploadHomeGif(Request $request)
    {
        $path = '/general/portada/';
        if ($request->hasfile('gif_file')) {
            $image = $request->file('gif_file');
            $extension = $image->getClientOriginalExtension();                    
            $imgName = Str::random(8) . date('Ymdhm');
            $image_name = $imgName . '.'.$extension;
            $filePath = $path . $image_name;                    
            Storage::disk('public')->put($filePath,file_get_contents($image));                
            return response()->json('true');
        }
    }

    public function GetFilesFromStorage($path)
    {
       return Storage::disk('public')->files($path);
    }

    private function get_youtube_video_ID($youtube_video_url) {
        $pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
        $pattern .= '(?:www\.)?';         #  Optional www subdomain.
        $pattern .= '(?:';                #  Group host alternatives:
        $pattern .=   'youtu\.be/';       #    Either youtu.be,
        $pattern .=   '|youtube\.com';    #    or youtube.com
        $pattern .=   '(?:';              #    Group path alternatives:
        $pattern .=     '/embed/';        #      Either /embed/,
        $pattern .=     '|/v/';           #      or /v/,
        $pattern .=     '|/watch\?v=';    #      or /watch?v=,    
        $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
        $pattern .=   ')';                #    End path alternatives.
        $pattern .= ')';                  #  End host alternatives.
        $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
        $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
        preg_match($pattern, $youtube_video_url, $matches);
        return (isset($matches[1])) ? $matches[1] : false;
      }
}

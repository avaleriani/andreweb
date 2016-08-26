<?php
namespace App\Http\Controllers;

//todo:: convertir este archivo para que reciba 1 imagen, la suba y haga todas las conversiones necesarias y las ubique en las carpetas correspondiente. la imagen solo va a tener un nombre, orden y el path a la original.
// luego para levantarla dependiendo de la resolucion cambio la carpeta de donde la levanta. Todas con el mismo nombre. borrar la tabla imagen y pasar todo a proyecto imagen, no hay necesidad de una tabla intermedia
// entonces este archivo sube ya ordenada y va a haber una funcion que sea actualiar el orden y cuando se mueva se va a triggerear esa.

use App\Models\Project;
use App\Models\ProjectImage;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;

class ProjectsImagesController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);
        return view('pages.projectsImages.index', [
            "project" => $project,
        ]);
    }

    public function create($id)
    {
        $project = Project::find($id);
        return view('pages.projectsImages.create', [
            "project" => $project,
        ]);
    }


    public function edit($id)
    {
        $project = Project::find($id);
        return view('pages.projects.edit', [
            'project' => $project,
        ]);
    }

    public function subirImagen()
    {
        $photo = Input::all();
        $response = $this->upload($photo);
        return $response;

    }

    public function borrarImagen()
    {

        $filename = Input::get('id');

        if (!$filename) {
            return 0;
        }

        $response = $this->delete($filename);

        return $response;
    }

    private function upload($form_data)
    {

        $validator = Validator::make($form_data, [
            'file|image|mimes:jpeg,jpg,png,gif|max:20000|dimensions:width=1600,height=1000'
        ]);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => "Error, imagen incorrecta, pruebe haciendola mas pequeña y que sea de un formato valido.",
                'code' => 400
            ], 400);

        }

        $photo = $form_data['file'];
        $projectId = $form_data['project_id'];
        $order = "";

        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename($filename, $extension);

        $uploadSuccess = $this->original($photo, $allowed_filename);

        $generateAllSizes = $this->generateAllSizes($photo, $allowed_filename, $extension);

        if (!$uploadSuccess || $generateAllSizes) {

            return Response::json([
                'error' => true,
                'message' => 'El servidor dio un error al subir la imagen',
                'code' => 500
            ], 500);

        }
        //ver bien como subir las imagenes y ordenarlas.

        $sessionImage = new ProjectImage();
        $sessionImage->name = $filename;
        $sessionImage->project_id = $projectId;
        $sessionImage->filename = $allowed_filename;
        $sessionImage->extension = $extension;
        $sessionImage->original_path = $uploadSuccess->basePath();
        $sessionImage->group = 'first';
        $sessionImage->order = $order;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);

    }

    public function generateAllSizes($photo, $allowed_filename, $extension)
    {
        try {
            $this->thumbnail($photo, $allowed_filename, $extension);
        } catch (Exception $e) {
            return false;
        }


    }

    public function createUniqueFilename($filename, $extension)
    {
        $full_size_dir = env('ORIGINAL_PATH');
        $full_image_path = $full_size_dir . $filename . '.' . $extension;

        if (File::exists($full_image_path)) {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken . '.' . $extension;
        }

        return $filename . '.' . $extension;
    }

    /**
     * Optimize Original Image
     * @param $photo
     * @param $filename
     * @return \Intervention\Image\Image
     */
    public function original($photo, $filename)
    {
        $path = public_path(env('ORIGINAL_PATH') . $filename);
        $manager = new ImageManager();
        $image = $manager->make($photo)->save($path);

        return $image;
    }

    /**
     * Create Thumbnail From Original
     * @param $photo
     * @param $filename
     * @return \Intervention\Image\Image
     */
    public function thumbnail($photo, $filename, $extension)
    {
        $path = public_path(env('THUMBNAIL_PATH') . $filename);
        $manager = new ImageManager();
        $image = $manager->make($photo)->resize(50, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path);

        return $image;
    }

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete($originalFilename)
    {

        $full_size_dir = Config::get('images.full_size');
        $icon_size_dir = Config::get('images.icon_size');

        $sessionImage = Image::where('original_name', 'like', $originalFilename)->first();


        if (empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code' => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->filename;
        $full_path2 = $icon_size_dir . $sessionImage->filename;

        if (File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if (File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if (!empty($sessionImage)) {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code' => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Genre;

class MovieController extends Controller
{

    public function show($id)
    {
        $movie = Movie::find($id);
        return $movie;
    }

    public function list()
    {
        //agrego el metodo with cuando quiero cargar una relacion
        // (un metodo que sea relacion en el modelo)
    	$movies = Movie::with('genre')->paginate(10);
    	return view('movies.lists', [ 'list' => $movies ] );

    }

    public function create()
    {
    	$genres = Genre::all();
    	return view('movies.add', [ 'genres' => $genres ] );
    }


    public function getById($id)
    {

    	$genres = Genre::all();
        $movie = Movie::find($id);

        return view('movies.item', [ 'movie' => $movie, 'genres' => $genres]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255|unique:movies_db.movies',
            'rating' => 'numeric|between:1,10',
            'release_date' => 'required',
            'awards' => 'numeric|min:0',
            'genre_id' => 'required|not_in:0'
        ], [
            'title.required' => 'El título es requerido',
            'title.unique'   => 'Este titulo ya existe.',
            'rating.numeric' => 'El rating debe ser un número',
            'release_date.required' => 'Debe seleccionar la fecha de lanzamiento',
            'awards.numeric' => 'El rating debe ser un número',
            'genre_id.required' => 'Seleccione el Género',
        ]);

        $params = [
            'title'        => $request->input('title'),
            'rating'       => $request->input('rating'),
            'release_date' => $request->input('release_date'),
            'awards'       => $request->input('awards'),
            'genre_id'     => $request->input('genre_id'),
        ];

        if($request->file('poster')){
            $file = $request->file('poster');
            $path = $file->store('posters', 'public');
            $params['poster'] = $path;
        }

        $movie = Movie::create($params);

        return redirect()
          ->route('movies.edit', ['id' => $movie->id ]);
    }


    public function update(Request $request, $id)
    {

        $movie = Movie::find($id);
        $this->validate($request, [
            'title' => 'required|max:255|unique:movies_db.movies,title,'.$movie->id,
            'rating' => 'numeric|between:1,10',
            'release_date' => 'required',
            'awards' => 'numeric|min:0',
            'genre_id' => 'required|not_in:0'
        ], [
            'title.required' => 'El título es requerido',
            'title.unique'   => 'Este titulo ya existe.',
            'rating.numeric' => 'El rating debe ser un número',
            'release_date.required' => 'Debe seleccionar la fecha de lanzamiento',
            'awards.numeric' => 'El rating debe ser un número',
            'genre_id.required' => 'Seleccione el Género',
        ]);

        $movie->title = $request->input('title');
        $movie->rating = $request->input('rating');
        $movie->release_date = $request->input('release_date');
        $movie->awards = $request->input('awards');
        $movie->genre_id = $request->input('genre_id');

        if($request->file('poster')){
            $file = $request->file('poster');
            $path = $file->store('posters', 'public');
            $movie->poster = $path;
        }
        $movie->save();

        return redirect()
          ->route('movies.edit', ['id' => $movie->id ]);
    }







    public function storeApi(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:movies|max:255',
            'rating' => 'numeric|between:1,10',
            'release_date' => 'required',
            'awards' => 'numeric|min:0',
            'genre_id' => 'required|not_in:0'
        ], [
            'title.required' => 'El título es requerido',
            'title.unique'   => 'Este titulo ya existe.',
            'rating.numeric' => 'El rating debe ser un número',
            'release_date.required' => 'Debe seleccionar la fecha de lanzamiento',
            'awards.numeric' => 'El rating debe ser un número',
            'genre_id.required' => 'Seleccione el Género',
        ]);

        $params = [
            'title'        => $request->input('title'),
            'rating'       => $request->input('rating'),
            'release_date' => $request->input('release_date'),
            'awards'       => $request->input('awards'),
            'genre_id'     => $request->input('genre_id'),
            'poster'       => $request->input('poster'),
        ];

        $movie = Movie::create($params);
        //because is a json respond by $movie or reponse(content, 201)
        return response([
            'movie_url' => "dir".$movie->id
        ], 201);
    }
}

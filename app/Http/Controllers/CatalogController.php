<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Movie;
use App\Rating;
use Notification;

class CatalogController extends Controller {

	public function getIndex() {
		$movies = Movie::all(); // got this from database model
		return view('catalog.index')->with('movies', $movies); 
    }
	
	public function getShow($id) {
		$movie = Movie::findOrFail($id);
		$rating = Rating::where('movie_id', $id)->get();
		return view('catalog.show')->with('movie', $movie)->with('ratings', $rating);
		
	}

	public function getCreate() {
        return view('catalog.create');
    }
	
	public function getEdit($id) {
		$movie = Movie::findOrFail($id);
		return view('catalog.edit')->with('movie', $movie);
	}

	public function postCreate(Request $request) {

		$movie = new Movie;
		$movie -> title = $request->input('title');
		$movie -> year = $request->input('year');
		$movie -> director = $request->input('director');
		$movie -> poster = $request->input('poster');
		$movie -> synopsis = $request->input('synopsis');
		$movie->save();

		Notification::success('Nueva pelicula insertada correctamente.');
		return redirect('/catalog');

	}

	public function putEdit(Request $request, $id) {

		$movie = Movie::findOrFail($id);
		$movie -> title = $request->input('title');
		$movie -> year = $request->input('year');
		$movie -> director = $request->input('director');
		$movie -> poster = $request->input('poster');
		$movie -> synopsis = $request->input('synopsis');
		$movie->save();
		Notification::success('Nuevos cambios guardados.');
		return redirect('/catalog/show/' . $id);
		
	}

	public function putRent($id) {
		
		$movie = Movie::findOrFail($id);
		$movie -> rented = ('0');
		$movie->save();
		Notification::info('La pelicula ha sido alquilada.');
		return redirect('/catalog/show/' . $id);
	
	}
	
	public function putReturn($id) {
		$movie = Movie::findOrFail($id);
		$movie -> rented = ('1');
		$movie->save();
	
		Notification::info('La pelicula ha sido devuelta.');
		return redirect('/catalog/show/' . $id);

	}

	public function putVote($id, $rate) {
		
		$movie = Movie::findOrFail($id);
		$rating = Rating::where('movie_id', $id)->get();

		$rating = new Rating;
		$rating -> movie_id = $id;
		$rating -> user_id = auth()->user()->id;
		$rating -> rating = $request->input('rate');
		$rating->save();

		Notification::info('Has puntuado esta pelicula.');
		return redirect('/catalog/show/' . $id);
	}
	
	public function putRevote($id) {
		$movie = Movie::findOrFail($id);
		$rating = Rating::where('movie_id', $id)->get();
		$movie -> rented = ('1');
		$movie->save();
	
		Notification::info('La pelicula ha sido devuelta.');
		return redirect('/catalog/show/' . $id);

	}
	
	public function deleteMovie($id) {
		$movie = Movie::findOrFail($id);
		$movie->delete();

		Notification::warning('La pelicula ha sido eliminada.');
		return redirect('/catalog');
	}
	
	
	
}

//GET leer datos de la base de datos
//POST insertar informacion nueva en la base de datos
//PUT  actualizar informacion nueva que ya hay
//DELETE eliminar informacion de la base de datos



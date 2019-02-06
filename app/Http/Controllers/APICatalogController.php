<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Movie;

class APICatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            Movie::all()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            Movie::findOrFail($id)
        );
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
        $movie = new Movie;
		$movie -> title = $request->input('title');
		$movie -> year = $request->input('year');
		$movie -> director = $request->input('director');
		$movie -> poster = $request->input('poster');
		$movie -> synopsis = $request->input('synopsis');
        $movie->save();
        
        return response()->json( ['error' => false,'msg' => 'La nueva película se ha añadido a la biblioteca' ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
		$movie -> title = $request->input('title');
		$movie -> year = $request->input('year');
		$movie -> director = $request->input('director');
		$movie -> poster = $request->input('poster');
		$movie -> synopsis = $request->input('synopsis');
        $movie->save();
        
        return response()->json( ['error' => false,'msg' => 'La película se modificado' ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return response()->json( ['error' => false,'msg' => 'Película eliminada de la biblioteca' ] );
    }

        /**
     * Put to a "rented" state an a specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putRent($id)
    {
        $m = Movie::findOrFail($id);
        $m -> rented = ('0');
        $m -> save();
        return response()->json( ['error' => false,'msg' => 'La película se ha marcado como alquilada' ] );
    }

    /**
     * Put to a "returned" state an a specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putReturn($id)
    {
        $movie = Movie::findOrFail($id);
		$movie -> rented = ('1');
        $movie->save();
        return response()->json( ['error' => false,'msg' => 'La película se ha marcado como devuelta' ] );
    }
}

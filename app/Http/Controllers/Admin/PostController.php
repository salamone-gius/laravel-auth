<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// importo la classe helper (prima dei modelli) che ha molti metodi per le stringhe che possono tornare utili, tipo per la generazione dello slug (store())
use Illuminate\Support\Str;

// importo il model di riferimento
use App\Post;


class PostController extends Controller
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
        // restituisce la view
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // prendo i dati dalla request
        $data = $request->all();

        // istanzio il nuovo post
        $newPost = new Post();

        // lo fillo attraverso il mass assignment che avrò già abilitato nel model Post
        $newPost->fill($data);

        // non avendolo previsto nel form, ma dovendolo avere come dato in tabella, devo generare qui uno slug univoco partendo dal title (ce lo genera laravel da una stringa)
        $slug = Str::of($newPost->title)->slug('-');

        // assegno lo slug appena creato dal title al campo slug del newPost
        $newPost->slug = $slug;

        // devo settare la checkbox in modo che restituisca un valore booleano (di default la checkbox restituisce "on" se è checkata e lo devo trasformare in "true")
        // il metodo isset() restituisce true o false. In questo caso "se esiste" restituisce true, altrimenti false
        $newPost->published = isset($data['published']);

        // salvo i dati a db
        $newPost->save();

        // reindirizzo alla rotta che mi restituisce la view del post appena creato 
        return redirect()->route('admin.posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

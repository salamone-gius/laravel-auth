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
        // passo tutti i post alla variabile $posts
        $posts = Post::all();

        //restituisce la view con la lettura di tutti i post
        return view('admin.posts.index', compact('posts'));
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
        // valido i dati che arrivano dal form del create
        $request->validate([
            // passo al metodo validate() un array associativo in cui la chiave sarà il dato che devo controllare e come valore le caratteristiche che quel dato deve avere per poter "passare" la validazione (vedi doc: validation)
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:65535',
            'published' => 'sometimes|accepted',
        ]);

        // prendo i dati dalla request
        $data = $request->all();

        // istanzio il nuovo post
        $newPost = new Post();

        // lo fillo attraverso il mass assignment che avrò già abilitato nel model Post
        $newPost->fill($data);

        // lo slug sarà il risultato del metodo getSlug() dove gli passo il title
        $newPost->slug = $this->getSlug($newPost->title);

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

    // passo il model e il singolo $post come argomento del metodo show (dependancy injection)
    public function show(Post $post)
    {
        //restituisco la view 
        return view('admin.posts.show', compact('post'));
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

    // creo un metodo privato (passandogli $title) che mi restituisce lo slug visto che la stessa logica la utilizzerò nell'update
    private function getSlug($title) {

        // non avendolo previsto nel form, ma dovendolo avere come dato in tabella, devo generare qui uno slug univoco partendo dal title (ce lo genera laravel da una stringa)
        $slug = Str::of($title)->slug('-');

        // imposto un contatore per il controllo sullo slug
        $count = 1;

        // controllo sull'unicità dello slug 
        // FINTANTO CHE all'interno della tabella posts(Post::) trovi (first()) uno slug ('slug') uguale a questa stringa ($slug)...
        while (Post::where('slug', $slug)->first()) {
            // ...assegno a $slug il valore di $slug concatenato (. "{}") ad un trattino ed un numero ($count)...
            $slug = Str::of($title)->slug('-') . "-{$count}";
            // ...incremento $count di 1.
            $count++;
        }

        // restituisco lo slug
        return $slug;

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Projeto;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetoRequest;
use Ramsey\Uuid\Uuid;
use App\Models\Categoria;
use Inertia\Inertia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ProjetoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjetoRequest $request)
    {
        $dados = $request->validated();
        $dados['categorias'] = json_encode($dados['categorias']);
        $user = auth()->user()->id;
        $uuid = Uuid::uuid4();

        
        $projeto = Projeto::create(
            [
                'nome_projeto' => $dados['nome_projeto'],
                'descricao' => $dados['descricao'],
                'data_inicio' => $dados['data_inicio'],
                'data_fim' => $dados['data_fim'],
                'edital' => $dados['edital'],
                'categorias' => $dados['categorias'],
                'user_id' => $user,
                'uuid' => $uuid,
            ]
        );
        $arquivo = $request->file('edital');
        $nomeArquivo = $projeto->nome_projeto ."--".auth()->user()->name. '.' . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path('edital/'.$user."/".$uuid."/"), $nomeArquivo);
        //$arquivo->storeAs('public/edital/'.$user."/".$uuid, $nomeArquivo);

        $request->session()->flash('message', 'Projeto cadastrado com sucesso!');
        return to_route('dashboard');
    }

    public function searchBySlug(Request $request)
    {
        $slug = $request->slug;
        $projetos = Projeto::where('categorias', 'like', '%'.$slug.'%')->get();

        //Json decode
        foreach ($projetos as $projeto) {
            $projeto->categorias = json_decode($projeto->categorias);
            //$projeto->user_id = $projeto->user->id;
            $projeto->professor = $projeto->user->name;
            $projeto->contato = $projeto->user->email;
        }

        //Pegar todos as categorias do projeto
        $categorias = [];
        foreach ($projetos as $projeto) {
            foreach ($projeto->categorias as $categoria) {
                $categorias[] = $categoria;
            }
        }

        // Pegar a cor de todas as categorias
        $cores = [];
        foreach ($categorias as $categoria) {
            $cores[] = Categoria::where('slug', $categoria)->first()->cor;
        }

        // Vincular a cor com a categoria
        $categoriasCores = [];
        foreach ($categorias as $key => $categoria) {
            $categoriasCores[$categoria] = $cores[$key];
        }

        

        $busca = [
            'projetos' => $projetos,
            'catcores' => $categoriasCores,
        ];
        return Inertia::render('Filtragem', compact('busca'));
    }

    public function showById(Request $request)
    {
        $projeto = Projeto::findOrFail($request->id);
        //dd($projeto);
        $projeto->categorias = json_decode($projeto->categorias);
        $projeto->professor = $projeto->user->name;
        $projeto->contato = $projeto->user->email;

        //Pegar todos as categorias do projeto
        $categorias = [];
        
            foreach ($projeto->categorias as $categoria) {
                $categorias[] = $categoria;
            }
        

        // Pegar a cor de todas as categorias
        $cores = [];
        foreach ($categorias as $categoria) {
            $cores[] = Categoria::where('slug', $categoria)->first()->cor;
        }

        // Vincular a cor com a categoria
        $categoriasCores = [];
        foreach ($categorias as $key => $categoria) {
            $categoriasCores[$categoria] = $cores[$key];
        }

        $busca = [
            'projetos' => $projeto,
            'catcores' => $categoriasCores,
        ];

        return Inertia::render('Filtragem', compact('busca'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $projeto = $request->busca;

        $user = User::where('name', 'like', '%'.$projeto.'%')->first();
        $projetos = User::find($user->id)->projetos()->orderBy('nome_projeto')->get();

        //Json decode
        foreach ($projetos as $projeto) {
            $projeto->categorias = json_decode($projeto->categorias);
            $projeto->professor = $projeto->user->name;
            $projeto->contato = $projeto->user->email;
        }

        $projeto->professor = $projeto->user->name;
        $projeto->contato = $projeto->user->email;

        //Pegar todos as categorias do projeto
        $categorias = [];
        foreach ($projetos as $projeto) {
            foreach ($projeto->categorias as $categoria) {
                $categorias[] = $categoria;
            }
        }

        // Pegar a cor de todas as categorias
        $cores = [];
        foreach ($categorias as $categoria) {
            $cores[] = Categoria::where('slug', $categoria)->first()->cor;
        }

        // Vincular a cor com a categoria
        $categoriasCores = [];
        foreach ($categorias as $key => $categoria) {
            $categoriasCores[$categoria] = $cores[$key];
        }

        $busca = [
            'projetos' => $projetos,
            'catcores' => $categoriasCores,
        ];
        // Pegar a cor de todas as categorias

        return Inertia::render('Filtragem', compact('busca'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projeto $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Day $day)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $day)
    {
        //
    }
}

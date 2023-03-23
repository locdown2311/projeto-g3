<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        // Criar as categorias : Calculo, Geometria Analitica, Algebra Linear, Programação e Química
        $categorias = [
            'Calculo',
            'Geometria Analitica',
            'Proativo',
            'Comunicador',
            'Química',
        ];

        Categoria::create(
            [
                'nome' => $categorias[0],
                'slug' => 'calc',
                'cor' => 'bg-red-600'
            ]
        );
        Categoria::create(
            [
                'nome' => $categorias[1],
                'slug' => 'geo',
                'cor' => 'bg-blue-600'
            ]
        );
        Categoria::create(
            [
                'nome' => $categorias[2],
                'slug' => 'proati',
                'cor' => 'bg-indigo-800'
            ]
        );
        Categoria::create(
            [
                'nome' => $categorias[3],
                'slug' => 'comu',
                'cor' => 'bg-pink-600'
            ]
        );
    }
}

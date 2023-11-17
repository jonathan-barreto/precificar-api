<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $nomePersonalizado = uniqid() . '.jpg';
            $caminho = $image->storeAs('images/', $nomePersonalizado);

            return 'Upload do arquivo concluído com sucesso!';
        }

        return 'Nenhum arquivo enviado.';
    }
}

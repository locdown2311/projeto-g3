<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ArquivoController extends Controller
{
    public function downloadArquivos(Request $request) {
        $caminhoPasta = public_path('edital/'.$request->id."/".$request->slug);
        $arquivos = File::files($caminhoPasta);

        if (count($arquivos) > 0) {
            $zip = new ZipArchive();
            $zipNome = 'arquivos.zip';

            if ($zip->open($zipNome, ZipArchive::CREATE) === true) {
                foreach ($arquivos as $arquivo) {
                    $nomeArquivo = basename($arquivo);
                    $zip->addFile($arquivo, $nomeArquivo);
                }

                $zip->close();

                return response()->download($zipNome)->deleteFileAfterSend(true);
            } else {
                abort(500, 'Não foi possível criar o arquivo zip.');
            }
        } else {
            abort(404, 'Não há arquivos para baixar.');
        }
    }
}

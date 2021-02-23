<?php

namespace App\Http\Controllers;

use App\Artigos;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

class BuscaVeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('busca');
    }

    public function capturar(Request $request)
    {
        $data = $request->only(['nome_veiculo']);


        $client = new Client();

        $res = $client->request('GET', "https://www.questmultimarcas.com.br/estoque?termo={$data['nome_veiculo']}");

        $html = $res->getBody()->getContents();

        $patternLink = '/<a href="(https:\/\/www.questmultimarcas.com.br\/carros\/[a-z]+\/[\w\-]+\/[0-9]+\/[0-9]+)">/';
        $patternNomeVeiculo = '/<a href="https:\/\/www.questmultimarcas.com.br\/carros\/[a-z]+\/[\w\-]+\/[0-9]+\/[0-9]+">([a-z A-Z 0-9 .]+)/';
        $patternAno = '/<a href="https:\/\/www.questmultimarcas.com.br\/carros\/[a-z]+\/[\w\-]+\/([0-9]+)\/[0-9]+">[a-z A-Z 0-9 .]+/';
        $patternCombustivel = '/Combustível:\s<\/span>(\n|\r)\s+<span class="card-list__info">((\n|\r)\s+)([a-z A-Z 0-9]+)/';
        $patternCambio = '/Câmbio:\s<\/span>(\n|\r)\s+<span class="card-list__info">((\n|\r)\s+)([a-z A-Z 0-9 á Á]+)/';
        $patternPortas = '/Portas:\s<\/span>(\n|\r)\s+<span class="card-list__info">((\n|\r)\s+)([a-z A-Z 0-9 á Á]+)/';
        $patternQuilometragem = '/Quilometragem:\s<\/span>(\n|\r)\s+<span class="card-list__info">((\n|\r)\s+)([a-z A-Z 0-9 á Á.]+)/';
        $patternCor = '/Cor:\s<\/span>(\n|\r)\s+<span class="card-list__info">((\n|\r)\s+)([a-z A-Z 0-9 á Á.]+)/';

        preg_match_all($patternLink, $html, $matchLinks);
        preg_match_all($patternNomeVeiculo, $html, $matchNomeVeiculos);
        preg_match_all($patternAno, $html, $matchAno);
        preg_match_all($patternCombustivel, $html, $matchCombustivel);
        preg_match_all($patternCambio, $html, $matchCambio);
        preg_match_all($patternPortas, $html, $matchPortas);
        preg_match_all($patternQuilometragem, $html, $matchQuilometragem);
        preg_match_all($patternCor, $html, $matchCor);

        $count = count($matchNomeVeiculos[1]);

        for($i=0; $i<$count; $i++){

            $artigo = new Artigos;
            $artigo->id_usuario = auth()->user()->getAuthIdentifier();
            $artigo->nome_veiculo = $matchNomeVeiculos[1][$i];
            $artigo->link = $matchLinks[1][$i];
            $artigo->ano = $matchAno[1][$i];
            $artigo->combustivel = $matchCombustivel[4][$i];
            $artigo->portas = $matchCambio[4][$i];
            $artigo->quilometragem = $matchPortas[4][$i];
            $artigo->cambio = $matchQuilometragem[4][$i];
            $artigo->cor = $matchCor[4][$i];

            $artigo->save();

        }

//        print_r(array_unique($matchLinks[1]));
//        echo "<br><br><br><br><br>";
//        print_r(count($matchNomeVeiculos[1]));
//        echo "<br><br><br><br><br>";
//        print_r($matchAno[1]);
//        echo "<br><br><br><br><br>";
//        print_r($matchCombustivel[4]);
//        echo "<br><br><br><br><br>";
//        print_r($matchCambio[4]);
//        echo "<br><br><br><br><br>";
//        print_r($matchPortas[4]);
//        echo "<br><br><br><br><br>";
//        print_r($matchQuilometragem[4]);
//        echo "<br><br><br><br><br>";
//        print_r($matchCor[4]);
//        echo "<br><br><br><br><br>";

        return redirect("/home");
    }

    public function destroy($id)
    {
        $artigo = Artigos::find($id);
        $artigo->delete();

        return redirect("/home");
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Empresa;
use App\Participante;
use App\Credenciamento;
use Auth;
use DB;

class CredenciamentoController extends Controller {

    public function index($id) {
        $evento = Evento::find($id);

        $btVolta = DB::table('empresas')->select('id')->where('id', $evento->empresa_id)->value('id');
        $empresaRazaoSoc = DB::table('empresas')->select('razao_soc')->where('id', $evento->empresa_id)->value('razao_soc');

        $empresa = new Empresa();
        $empresa->id = $evento->empresa_id;

        $participantes = Participante::all()->where('evento_id', $evento->id);
        //dd($participantes);

        $credenciados = Credenciamento::all()
                ->where('empresa_id', $evento->empresa_id)
                ->where('evento_id', $evento->id)
                ->where('presente', '1')
                ->sortByDesc('id');

        $credenciados->empresa_id = $evento->empresa_id;

        return view('credenciamentos.index', compact('evento', 'credenciados', 'participantes', 'btVolta', 'empresaRazaoSoc'));
    }

    public function storeCredenciamento(Request $request, $id) {

        // só vai fazer se foi chamado por post, por questão de segurança é bom botar essa verificação
        $evento = Evento::find($id); // traz o id do evento
        
        
        if ($request->isMethod('post')) {
            $credenciamento = new Credenciamento(); // cria um objeto credenciamento

            $credenciamento->evento_id = $id;
            $credenciamento->evento = $evento->descricao;
            $credenciamento->empresa = $evento->emp_responsavel;
            $credenciamento->empresa_id = $evento->empresa_id;
            $credenciamento->user_id = Auth::user()->id; // recupera o id do Usuario logado
            $credenciamento->digital = $request->digital;
            $credenciamento->funcionario_id = $request->funcionario_id;
            $credenciamento->nome = $request->nome;
            $credenciamento->cpf = $request->cpf;
            $credenciamento->foto = $request->foto;
            $credenciamento->presente = $request->presente;

            if ($request->presente == '1') {
                // aqui eu só monto o que eu quero que ele retorne para mim.
                if ($credenciamento->save()) {
                    $return['success'] = true;
                    return redirect()->back(); // pega a url para saber qual página deve retornar
                    //$return['mensage'] = 'Cadastrado com sucesso';
                    
                } else {
                    $return['success'] = false;
                    return redirect()->back();
                    //$return['mensage'] = 'Não foi possível cadastrar no banco';
                }
            } else {
                $return['success'] = false;
                //return redirect()->back();
                //['mensage'] = 'Método incorreto';
            }
        }
        
        return redirect()->back();
    }
}

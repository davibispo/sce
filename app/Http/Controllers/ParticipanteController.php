<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Funcionario;
use App\Participante;
use App\Empresa;
use App\Uf;
use App\Cidade;
use DB;
use Auth;

class ParticipanteController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        
    }
    
    public function teste() {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function createParticipante($id) {
        $evento = Evento::find($id);
        $ufs = Uf::all();
        $cidades = Cidade::all();
        //$eventos = Evento::all();

        return view('participantes.participantes-create', compact('evento', 'ufs', 'cidades'));
    }

    public function storeParticipanteIndividual(Request $request, Empresa $empresa, Funcionario $funcionario, $id) {
        //dd($request);
        $evento = Evento::find($id);
        $empresa->id = $evento->empresa_id;
        $empresaRazaoSoc = DB::table('empresas')->select('razao_soc')->where('id', $evento->empresa_id)->value('razao_soc');
        //dd($empresaRazaoSoc);
        $this->validate($request, [
            'nome' => 'required|string|min:3|max:80',
            'endereco' => 'required|string|max:200',
            'endereco_num' => 'required|string|max:5',
            'bairro' => 'required|string|max:80',
            'uf' => 'required',
            'cidade' => 'required',
            'telefone' => 'required|string|max:16',
            'sexo' => 'required',
            'dt_nasc' => 'required',
            'cpf' => 'required|string|max:11',
            'digital' => 'required',
        ]);

        $funcionario->nome = $request->nome;
        $funcionario->endereco = $request->endereco;
        $funcionario->endereco_num = $request->endereco_num;
        $funcionario->bairro = $request->bairro;
        $funcionario->uf = $request->uf;
        $funcionario->cidade = $request->cidade;
        $funcionario->telefone = $request->telefone;
        $funcionario->email = $request->email;
        $funcionario->sexo = $request->sexo;
        $funcionario->dt_nasc = date('m-d-Y', strtotime($request->dt_nasc));
        $funcionario->cpf = $request->cpf;
        $funcionario->pis = $request->pis;
        $funcionario->rg = $request->rg;
        $funcionario->foto = $request->foto;
        $funcionario->digital = $request->digital;
        $funcionario->empresa = $empresaRazaoSoc;
        $funcionario->dt_admis = date('m-d-Y', strtotime($request->dt_admis));
        $funcionario->cargo = $request->cargo;
        $funcionario->salario = $request->salario;
        $funcionario->empresa_id = $empresa->id;
        $funcionario->user_id = Auth::user()->id;

        $funcionario->save();

        DB::table('participantes')
                ->insertGetId([
                    'funcionario_id' => $funcionario->id,
                    'evento_id' => $evento->id,
                    'nome' => $funcionario->nome,
                    'cpf' => $funcionario->cpf,
                    'empresa' => $funcionario->empresa,
                    'foto' => $funcionario->foto,
                    'digital' => $funcionario->digital
        ]);

        return redirect()->route('participantes.show', compact('evento'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $evento = Evento::find($id);

        $btVolta = DB::table('empresas')->select('id')->where('id',$evento->empresa_id)->value('id');
        $empresaRazaoSoc = DB::table('empresas')->select('razao_soc')->where('id',$evento->empresa_id)->value('razao_soc');
        
        $empresas = Empresa::all()
                ->where('status', '1');

        $participantes = Participante::all()
                ->where('status', '1')
                ->where('evento_id', $evento->id)
                ->sortBy('nome')
                ->sortBy('empresa');
        
        return view('participantes.show', compact('evento', 'participantes', 'empresas','btVolta','empresaRazaoSoc'));
    }
    
    public function buscaParticipante($id) {
        
        $evento = Evento::find($id);
        
        $participantes = Participante::all()->where('evento_id', $evento->id);
        //dd($participantes);
        return $participantes;
    }

    public function storeParticipante(Request $request, Participante $participante, Funcionario $funcionarios, $id) {

        $evento = Evento::find($id);

        $dadosFuncionarios = $funcionarios->all()
                ->where('status', '1')
                ->where('empresa', $request->emp_participante);

        $buscaCpfParticipantes = DB::table('participantes')
                ->select('cpf')
                ->where('status', '1')
                ->where('evento_id', $evento->id)
                ->where('empresa', $request->emp_participante)
                ->get();

        $buscaCpfFuncionarios = DB::table('funcionarios')
                ->select('cpf')
                ->where('status', '1')
                ->where('empresa', $request->emp_participante)
                ->get();

        if ($buscaCpfParticipantes != $buscaCpfFuncionarios) {
            foreach ($dadosFuncionarios as $funcionario) {
                DB::table('participantes')
                        ->insertGetId([
                            'funcionario_id' => $funcionario->id,
                            'evento_id' => $evento->id,
                            'nome' => $funcionario->nome,
                            'cpf' => $funcionario->cpf,
                            'empresa' => $funcionario->empresa,
                            'foto' => $funcionario->foto,
                            'digital' => $funcionario->digital
                ]);
            }
            return redirect()->route('participantes.show', compact('evento', 'funcionarios', 'participante'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $evento = Evento::find($id);
        DB::table('participantes')
                ->where('evento_id', $evento->id)
                ->delete();

        return redirect()->route('participantes.show', compact('evento'));
    }

}

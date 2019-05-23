<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funcionario;
use App\Empresa;
use App\Uf;
use App\Cidade;
use Auth;
use Illuminate\Support\Carbon;

class FuncionarioController extends Controller {

    public function detalheFuncionario($id) {
        
        $funcionario = Funcionario::find($id);

        return view('funcionarios.funcionarios-detalhe', compact('funcionario'));
    }

    public function createFuncionario($id) {
        $empresa = Empresa::find($id);
        $ufs = Uf::all();
        $cidades = Cidade::all();
        //$eventos = Evento::all();
        return view('funcionarios.funcionarios-create', compact('empresa', 'ufs', 'cidades'));
    }

    public function storeFuncionario(Request $request, Funcionario $funcionario, $id) {

        //dd($request);
        $empresa = Empresa::find($id);

        $this->validate($request, [
            'nome' => 'required|string|min:3|max:80',
            'endereco' => 'required|string|max:200',
            'endereco_num' => 'required|string|max:5',
            'bairro' => 'required|string|max:80',
            'uf' => 'required',
            'cidade' => 'required',
            'telefone' => 'required|string|max:16',
            //'email' => 'required|string|max:100',
            'sexo' => 'required',
            'dt_nasc' => 'required',
            //'cargo' => 'required|string',
            //'salario' => 'string|max:9',
            'cpf' => 'required|string|max:11',
            //'rg' => 'required',
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
        $funcionario->empresa = $empresa->razao_soc;
        $funcionario->dt_admis = date('m-d-Y', strtotime($request->dt_admis));
        $funcionario->cargo = $request->cargo;
        $funcionario->salario = $request->salario;
        $funcionario->empresa_id = $empresa->id;
        $funcionario->user_id = Auth::user()->id;

        $funcionario->save();
 
        return redirect()->route('funcionarios.show', compact('empresa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $empresa = Empresa::find($id);
        $funcionarios = Funcionario::all()
                ->where('empresa_id', $id)
                ->where('status', '1')
                ->sortByDesc('id');
        return view('funcionarios.show', compact('funcionarios', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $funcionario = Funcionario::find($id);

        $ufs = Uf::all();
        $cidades = Cidade::all();

        return view('funcionarios.update', compact('funcionario', 'ufs', 'cidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $funcionario = Funcionario::find($id);

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
        $funcionario->dt_admis = date('m-d-Y', strtotime($request->dt_admis));
        $funcionario->cargo = $request->cargo;
        $funcionario->salario = $request->salario;
        $funcionario->cpf = $request->cpf;
        $funcionario->pis = $request->pis;
        $funcionario->rg = $request->rg;
        $funcionario->foto = $request->foto;
        $funcionario->digital = $request->digital;
        $funcionario->user_id = Auth::user()->id;

        $funcionario->update();

        return redirect()->route('funcionarios.detalhe', compact('funcionario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $funcionario = Funcionario::find($id);
        $empresa = new Empresa();
        $empresa->id = $funcionario->empresa_id;
        $funcionario->status = $request->status;
        $funcionario->status = '0';
        $funcionario->update();

        return redirect()->route('funcionarios.show', compact('empresa'));
    }

}

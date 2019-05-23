<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Funcionario;
use App\Uf;
use App\Cidade;
use Auth;

class EmpresaController extends Controller {

    /**
     * Mostra uma lista dos itens com status igual a 1
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $empresas = Empresa::all()->where('status', '=', '1')->sortByDesc('id');
        //dd($empresas);
    return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $ufs = Uf::all();
        $cidades = Cidade::all();
        //dd($ufs);
        
        return view('empresas.create', compact('ufs', 'cidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empresa $empresa) {
        $this->validate($request, [
            'razao_soc'     => 'required|string|min:3|max:200',
            'cnpj'          => 'required|string|max:18',
            'endereco'      => 'required|string|max:200',
            'endereco_num'  => 'required',
            'bairro'        => 'required|string|max:50',
            'telefone'      => 'required',
            'cidade'     => 'required',
            'uf'         => 'required',
        ]);
        $empresa->razao_soc = $request->razao_soc;
        $empresa->cnpj = $request->cnpj;
        $empresa->endereco = $request->endereco;
        $empresa->endereco_num = $request->endereco_num;
        $empresa->bairro = $request->bairro;
        $empresa->telefone = $request->telefone;
        $empresa->cidade = $request->cidade;
        $empresa->uf = $request->uf;
        $empresa->user_id = Auth::user()->id;
        
        $empresa->save();
        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $empresa = Empresa::find($id);
        $funcionarios = Funcionario::where('empresa_id','=',$id);
        return view('empresas.show', compact('empresa', 'funcionarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $empresa = Empresa::find($id);
        $ufs = Uf::all();
        $cidades = Cidade::all();
        return view('empresas.update', compact('empresa', 'ufs', 'cidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $empresa = Empresa::find($id);
        
        $this->validate($request, [
            'razao_soc'     => 'required|string|min:3|max:200',
            'cnpj'          => 'required|string|max:18',
            'endereco'      => 'required|string|max:200',
            'endereco_num'  => 'required',
            'bairro'        => 'required|string|max:50',
            'telefone'      => 'required',
            'cidade_id'     => 'required',
            'uf_id'         => 'required',
        ]);
        $empresa->razao_soc = $request->razao_soc;
        $empresa->cnpj = $request->cnpj;
        $empresa->endereco = $request->endereco;
        $empresa->endereco_num = $request->endereco_num;
        $empresa->bairro = $request->bairro;
        $empresa->telefone = $request->telefone;
        $empresa->cidade_id = $request->cidade_id;
        $empresa->uf_id = $request->uf_id;
        $empresa->user_id = Auth::user()->id;
        
        $empresa->update();
        return redirect()->route('empresas.index');
    }

    /**
     * Modifica o status de 1 (ativo) para 0 (inativo).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $empresa = Empresa::find($id);
        $empresa->status = $request->status;
        $empresa->status = '0';
        $empresa->update();
        return redirect()->route('empresas.index');
    }

}

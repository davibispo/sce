<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Empresa;
use App\Funcionario;
use Auth;
use DB;

class EventoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function detalheEvento($id) {
        $evento = Evento::find($id);
        
        $btVolta = DB::table('empresas')->select('id')->where('id',$evento->empresa_id)->value('id');
        $empresaRazaoSoc = DB::table('empresas')->select('razao_soc')->where('id',$evento->empresa_id)->value('razao_soc');
        
        $empresa = new Empresa();
        $empresa->id = $evento->empresa_id;
        $funcionarios = Funcionario::all()->where('status', '1')->where('empresa_id', $empresa->id)->sortBy('nome');
        
        return view('eventos.eventos-detalhe', compact('evento', 'empresa', 'funcionarios','btVolta','empresaRazaoSoc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEvento($id) {
        $empresa = Empresa::find($id);
        return view('eventos.eventos-create', compact('empresa', 'participantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeEvento(Request $request, Evento $evento, $id) {
        $empresa = Empresa::find($id);
        //dd($id);
        $this->validate($request, [
            'descricao' => 'required|string|min:3|max:500',
            'local' => 'required|string|min:3|max:200',
            'data' => 'required|date',
            'emp_participante' => 'required',
        ]);

        $evento->descricao = $request->descricao;
        $evento->local = $request->local;
        $evento->data = date('m-d-Y', strtotime($request->data));
        $evento->emp_responsavel = $empresa->razao_soc;
        $evento->emp_participante = $request->emp_participante;
        $evento->empresa_id = $empresa->id;
        $evento->user_id = Auth::user()->id;

        $evento->save();

        return redirect()->route('eventos.show', compact('empresa'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $empresa = Empresa::find($id);
        $eventos = Evento::all()
                ->where('status', '1')
                ->where('empresa_id', $id)
                ->sortByDesc('id');
        $funcionario = new Funcionario();
          
        return view('eventos.show', compact('eventos', 'empresa', 'funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $evento = Evento::find($id);
        $empresa = new Empresa();

        $empresa->id = $evento->empresa_id;
        return view('eventos.update', compact('evento', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $evento = Evento::find($id);
        //dd($id);
        $this->validate($request, [
            'descricao' => 'required|string|min:3|max:500',
            'local' => 'required|string|min:3|max:200',
            'data' => 'required|date',
        ]);

        $evento->descricao = $request->descricao;
        $evento->local = $request->local;
        $evento->data = $request->data;

        $evento->update();

        return redirect()->route('eventos.show', compact('evento'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $evento = Evento::find($id);
        $empresa = new Empresa();
        $empresa->id = $evento->empresa_id;
        $evento->status = $request->status;
        $evento->status = '0';
        $evento->update();

        return redirect()->route('eventos.show', compact('empresa'));
    }

}

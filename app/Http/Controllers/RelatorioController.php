<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Evento;
use App\Funcionario;
use App\Credenciamento;
use League\Csv\Writer;
use Illuminate\Support\Carbon;
use DB;

class RelatorioController extends Controller
{
    public function index() {
        
        $empresas = Empresa::all()->where('status','1');
        $eventos = Evento::all()->where('status','1');
        $funcionarios = Funcionario::all()->where('status','1');
        return view('relatorios.index', compact('empresas','eventos','funcionarios'));
    }
    
    public function relEmpresa() {
        
        $empresas = Empresa::all()->where('status','1');
        
        $eventos = Evento::all()->where('status','1');
        
        return view('relatorios.rel-empresas', compact('empresas','eventos'));
    }
    
    public function relEvento() {
        
        $eventos = Evento::all()->where('status','1');
        
        return view('relatorios.rel-eventos', compact('eventos'));
    }
    
    public function relEventoDet($ev) {
        $eventos = Evento::find($ev); 
        
        $credenciados = Credenciamento::all()->where('evento', $eventos->descricao);

        return view('relatorios.rel-eventos-det', compact('eventos','credenciados'));
    }
    
    public function exportCsvEmpresas() {
        $empresas = Empresa::where('status','1')->select('razao_soc','cnpj','created_at')->get()->all();
        
        //dd($relEmpresas);
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['RazaoSocial','CNPJ','Data Cadastro']);
        foreach ($empresas as $relEmpresa){
            $csv->insertOne($relEmpresa->toArray());
        }
        $csv->output('rel_empresas_'.Carbon::now().'.csv');
        
        return view('relatorios.exportar-empresas');
    }
    
    public function exportCsvEventos() {
        $eventos = Evento::where('status','1')
                ->select('descricao','data','local','emp_responsavel')
                ->get()->all();
        
        //dd($relEmpresas);
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Evento','Data','Local','Empresa']);
        foreach ($eventos as $evento){
            $csv->insertOne($evento->toArray());
        }
        $csv->output('rel_eventos_'.Carbon::now().'.csv');
        
        return view('relatorios.exportar-eventos');
    }
    
    public function exportCsvEventosDet() {
        $credenciados = Credenciamento::where('presente','1')
                ->select('nome','cpf','evento','empresa','created_at')->get()->all();
        
        //dd($relEmpresas);
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Nome','CPF','Evento','Empresa','Data']);
        foreach ($credenciados as $credenciado){
            $csv->insertOne($credenciado->toArray());
        }
        $csv->output('rel_credenciados_'.Carbon::now().'.csv');
        
        return view('relatorios.exportar-eventos-det');
    }
}

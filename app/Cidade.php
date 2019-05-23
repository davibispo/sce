<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';
    
    protected $fillable = ['descricao','uf_id'];
    
    public static function cidades($id){
        return Cidade::where('uf_id',$id)->get();
    }
}

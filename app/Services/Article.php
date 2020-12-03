<?php

namespace App\Services;
use App\Models\ProductStock;

class Article
{
    public function get()
    {
        $articulostock=ProductStock::get();
        $articulostockarray['']="Seleccione un Articulo";
        foreach($articulostock as $article)
        {
            $articulostockarray[$article->idarticulos]= $article->idlarticulos.' - '.$article->nombrearticulo;
        }
        return $articulostockarray;
    }
}



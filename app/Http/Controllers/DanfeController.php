<?php

namespace App\Http\Controllers;

use NFePHP\DA\NFe\Danfe;

class DanfeController extends Controller
{


  public function imprimeDanfe(){
    $xml = 'nota.xml';
    $danfe = new Danfe($xml
);

    
     //$danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC
    // Caso queira mudar a configuracao padrao de impressao
    /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
    // Caso queira sempre ocultar a unidade tributável
    /*  $this->setOcultarUnidadeTributavel(true); */
    //Informe o numero DPEC
    /*  $danfe->depecNumber('123456789'); */
    //Configura a posicao da logo
    /*  $danfe->logoParameters($logo, 'C', false);  */
    //Gera o PDF

    $pdf = $danfe->render();

    header('Content-Type: application/pdf');
    echo $pdf;
   
      
  }
}

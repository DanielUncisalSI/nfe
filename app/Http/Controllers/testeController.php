<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use autoload;
use NFePHP\NFe\Make;
use stdClass;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use NFePHP\Common\Certificate;
use NFePHP\Common\Certificate\CertificationChain;
use NFePHP\DA\NFe\Danfe;

use NFePHP\NFe\Tools;
 

class testeController extends Controller
{
    
    public function teste(){

    $nfe = new Make();

    //tag infNFe
    $std = new stdClass();
    $std->versao = '4.00';
    $std->Id = null;
    $std->pk_nItem = null;
    $nfe->taginfNFe($std);
    
    //tag ide 
    $std = new stdClass();
    $std->cUF = 27; //coloque um código real e válido
    $std->cNF = '80070008';
    $std->natOp = 'VENDA';
    $std->mod = 55;
    $std->serie = 1;
    $std->nNF = 12;
    $std->dhEmi = '2021-05-13T20:48:00-02:00';
    $std->dhSaiEnt = '2021-05-13T20:48:00-02:00';
    $std->tpNF = 1;
    $std->idDest = 1;
    $std->cMunFG = 2704302; //Código de município precisa ser válido
    $std->tpImp = 1;
    $std->tpEmis = 1;
    $std->cDV = 2;
    $std->tpAmb = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
    $std->finNFe = 1;
    $std->indFinal = 0;
    $std->indPres = 0;
    $std->procEmi = '0';
    $std->verProc = 1;
    $nfe->tagide($std);
   
    //tag emit
    $std = new stdClass();
    $std->xNome = 'UNIAO BRASIL TRANSPORTES LTDA';
    $std->IE = '240990137';
    $std->CRT = 3;
    $std->CNPJ = '03949951000108';
    $nfe->tagemit($std);
    
    //tag endrEmit
    $std = new stdClass();
    $std->xLgr = "Rua Joao Jose Pereira Filho";
    $std->nro = '1845';
    $std->xBairro = 'Tabuleiro dos Martins';
    $std->cMun = '2704302'; //Código de município precisa ser válido e igual o  cMunFG
    $std->xMun = 'Maceió';
    $std->UF = 'AL';
    $std->CEP = '57081000';
    $std->cPais = '1058';
    $std->xPais = 'BRASIL';
    $nfe->tagenderEmit($std);
    
    //tag dest (destinatario)
    $std = new stdClass();
    $std->xNome = 'Empresa destinatário teste';
    $std->indIEDest = 1;
    $std->IE = '240990137';
    $std->CNPJ = '03949951000108';
    $nfe->tagdest($std);
    
    //tag enderDest
    $std = new stdClass();
    $std->xLgr = "Rua Joao Jose Pereira Filho";
    $std->nro = '1845';
    $std->xBairro = 'Tabuleiro dos Martins';
    $std->cMun = '2704302';
    $std->xMun = 'Maceió';
    $std->UF = 'AL';
    $std->CEP = '57081000';
    $std->cPais = '1058';
    $std->xPais = 'BRASIL';
    $nfe->tagenderDest($std);
    
    //tag prod
    $std = new stdClass();
    $std->item = 1;
    $std->cEAN = 'SEM GTIN';
    $std->cEANTrib = 'SEM GTIN';
    $std->cProd = '0001';
    $std->xProd = 'Produto teste';
    $std->NCM = '84669330';
    $std->CFOP = '5102';
    $std->uCom = 'PÇ';
    $std->qCom = '1.0000';
    $std->vUnCom = '10.99';
    $std->vProd = '10.99';
    $std->uTrib = 'PÇ';
    $std->qTrib = '1.0000';
    $std->vUnTrib = '10.99';
    $std->indTot = 1;
    $nfe->tagprod($std);
    
    //tag imposto
    $std = new stdClass();
    $std->item = 1;
    $std->vTotTrib = 10.99;
    $nfe->tagimposto($std);
    
     //tag ICMS
    $std = new stdClass();
    $std->item = 1;
    $std->orig = 0;
    $std->CST = '00';
    $std->modBC = 0;
    $std->vBC = '0.20';
    $std->pICMS = '18.0000';
    $std->vICMS = '0.04';
    $nfe->tagICMS($std);
    
     //tag IPI
    $std = new stdClass();
    $std->item = 1;
    $std->cEnq = '999';
    $std->CST = '50';
    $std->vIPI = 0;
    $std->vBC = 0;
    $std->pIPI = 0;
    $nfe->tagIPI($std);
    
     //tag PIS
    $std = new stdClass();
    $std->item = 1;
    $std->CST = '07';
    $std->vBC = 0;
    $std->pPIS = 0;
    $std->vPIS = 0;
    $nfe->tagPIS($std);
    
    //tag COFINS
    $std = new stdClass();
    $std->item = 1;
    $std->vCOFINS = 0;
    $std->vBC = 0;
    $std->pCOFINS = 0;
    $nfe->tagCOFINSST($std);
    
    //tag COFINSST
    $std = new stdClass();
    $std->item = 1;
    $std->CST = '01';
    $std->vBC = 0;
    $std->pCOFINS = 0;
    $std->vCOFINS = 0;
    $std->qBCProd = 0;
    $std->vAliqProd = 0;
    $nfe->tagCOFINS($std);
    
    //tag ICMSTOT
    $std = new stdClass();
    $std->vBC = '0.20';
    $std->vICMS = 0.04;
    $std->vICMSDeson = 0.00;
    $std->vBCST = 0.00;
    $std->vST = 0.00;
    $std->vProd = 10.99;
    $std->vFrete = 0.00;
    $std->vSeg = 0.00;
    $std->vDesc = 0.00;
    $std->vII = 0.00;
    $std->vIPI = 0.00;
    $std->vPIS = 0.00;
    $std->vCOFINS = 0.00;
    $std->vOutro = 0.00;
    $std->vNF = 11.03;
    $std->vTotTrib = 0.00;
    $nfe->tagICMSTot($std);
    
    //tag trasnp
    $std = new stdClass();
    $std->modFrete = 1;
    $nfe->tagtransp($std);

    //tag Vol (volumes)
    $std = new stdClass();
    $std->item = 1;
    $std->qVol = 2;
    $std->esp = 'caixa';
    $std->marca = 'OLX';
    $std->nVol = '11111';
    $std->pesoL = 10.00;
    $std->pesoB = 11.00;
    $nfe->tagvol($std);
    

    $std = new stdClass();
    $std->nFat = '002';
    $std->vOrig = 11.03;
    $std->vLiq = 11.03;
    $nfe->tagfat($std);
    
    $std = new stdClass();
    $std->nDup = '001';
    $std->dVenc = date('Y-m-d');
    $std->vDup = 11.03;
    $nfe->tagdup($std);
    
    $std = new stdClass();
    $std->vTroco = 0;
    $nfe->tagpag($std);
    
    $std = new stdClass();
    $std->indPag = 0;
    $std->tPag = "01";
    $std->vPag = 11.03;
    $std->indPag=0;
    $nfe->tagdetPag($std);
    
    $xml = $nfe->getXML(); // O conteúdo do XML fica armazenado na variável $xml

    $config = [
        "atualizacao" => "2015-10-02 06:01:21",
        "tpAmb" => 2,
        "razaosocial" => "União Brasil Transportes LTDA",
        "siglaUF" => "AL",
        "cnpj" => "03949951000108",
        "schemes" => "PL_009_V4",
        "versao" => "4.00",
        "tokenIBPT" => "AAAAAAA",
        "CSC" => "GPB0JBWLUR6HWFTVEAS6RJ69GPCROFPBBB8G",
        "CSCid" => "000002",
    ];
    
    $json = json_encode($config);
    $certificadoDigital = file_get_contents('certificado.pfx');

    $tools = new Tools($json, Certificate::readPfx($certificadoDigital, '123456'));
try {
    $xmlAssinado = $tools->signNFe($xml); // O conteúdo do XML assinado fica armazenado na variável $xmlAssinado
} catch (\Exception $e) {
    //aqui você trata possíveis exceptions da assinatura
    exit($e->getMessage());
}

//dd($xmlAssinado);

try {
    $idLote = str_pad(100, 15, '0', STR_PAD_LEFT); // Identificador do lote
    $resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

    $st = new Standardize();
    $std = $st->toStd($resp);
    if ($std->cStat != 103) {
        //erro registrar e voltar
        exit("[$std->cStat] $std->xMotivo");
    }
    $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota
} catch (\Exception $e) {
    //aqui você trata possiveis exceptions do envio
    exit($e->getMessage());
} 

try {
    $protocolo = $tools->sefazConsultaRecibo($recibo);
} catch (\Exception $e) {
    //aqui você trata possíveis exceptions da consulta
    exit($e->getMessage());
}

//dd($protocolo);
$request = $xmlAssinado;
$response = $protocolo;

try {
    $xml = Complements::toAuthorize($request, $response);
    header('Content-type: text/xml; charset=UTF-8');
    echo $xml;
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}

file_put_contents('nota.xml',$xml);


$danfe = new Danfe($xml, 'P', 'A4', 'I', '');
//$danfe->montaDANFE();
$pdf = $danfe->render();




} 

}


//Primeiro: a montagem do XML, como no exemplo acima;
//Segundo: a sua assinatura usando um certificado digital;
//Terceiro: o envio para a receita.
//Quarto: vamos consultar o nosso envio para ver se tudo ocorreu como nós esperamos;
//Por fim vamos pegar o protocolo que recebemos da consulta para armazenar no XML.
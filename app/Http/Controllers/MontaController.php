<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Result;
use NFePHP\NFe\Make;
use stdClass;

class MontaController extends Controller
{

    private $config;
    public function __construct()
    {

        $config = [
            "atualizacao" => "2015-10-02 06:01:21",
            "tpAmb" => 2,
            "razaosocial" => "Fake Materiais de construção Ltda",
            "siglaUF" => "SP",
            "cnpj" => "00716345000119",
            "schemes" => "PL_009_V4",
            "versao" => "4.00'",
            "tokenIBPT" => "AAAAAAA",
            "CSC" => "GPB0JBWLUR6HWFTVEAS6RJ69GPCROFPBBB8G",
            "CSCid" => "000002",
        ];

        $json = json_encode($config);
        // $this->config = $config;
    }

    //inicia na pag. 175 do manual
    public function geraNfe()
    {
        $nfe = new Make();

        //tag infNFe
        $std = new stdClass();
        $std->versao = '4.00';
        $std->Id = null; //se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL
        $nfe->taginfNFe($std);
        
        //tag ide 
        $std = new stdClass();
        $std->cUF = 27;
        $std->cNF = '80070008';
        $std->natOp = 'VENDA';
        $std->mod = 55;
        $std->serie = 1;
        $std->nNF = 2;
        $std->dhEmi = '2021-05-13T20:48:00-02:00';
        $std->dhSaiEnt = '2021-05-13T20:48:00-02:00';
        $std->tpNF = 1;
        $std->idDest = 1;
        $std->cMunFG = 2704302;
        $std->tpImp = 1;
        $std->tpEmis = 1;
        $std->cDV = 2;
        $std->tpAmb = 2;
        $std->finNFe = 1;
        $std->indFinal = 0;
        $std->indPres = 0;
        $std->indIntermed = null; //usar a partir de 05/04/2021
        $std->procEmi = '0';
        $std->verProc = 1;
        $std->dhCont = null;
        $std->xJust = null;
        $nfe->tagide($std);


        //tag emit
        $std = new stdClass();
        $std->xNome = 'UNIAO BRASIL TRANSPORTES LTDA';
        $std->IE = '240990137';
        $std->CRT = 3;
        $std->CNPJ = '03949951000108'; //indicar apenas um CNPJ ou CPF
        $std->xFant = 'UNIAO BRASIL TRANSPORTES';
        $nfe->tagemit($std);

        //tag endrEmit
        $std = new stdClass();
        $std->xLgr = 'R   JOAO JOSE PEREIRA FILHO';
        $std->nro = '1845';
        $std->xCpl = 'GALPAOB C D E';
        $std->xBairro = 'TABULEIRO DO MARTINS';
        $std->cMun = 2704302;
        $std->xMun = 'MACEIO';
        $std->UF = 'AL';
        $std->CEP = '57081000';
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $std->fone = '8233240989';
        $nfe->tagenderEmit($std);

        //tag dest (destinatario)
        $std = new stdClass();
        $std->xNome = "UNIÃO BRASIL TRANSPORTES LTDA";
        $std->indIEDest = 2;
        $std->IE = '240990137';
        $std->CNPJ = "03949951000108"; //indicar apenas um CNPJ ou CPF ou idEstrangeiro
        $nfe->tagdest($std);

        //tag enderDest
        $std = new stdClass();
        $std->xLgr = "R   JOAO JOSE PEREIRA FILHO";
        $std->nro = "1845";
        $std->xCpl = "GALPAOB C D E";
        $std->xBairro = "TABULEIRO DO MARTINS";
        $std->cMun = '2704302';
        $std->xMun = "MACEIO";
        $std->UF = "AL";
        $std->CEP = '57081000';
        $std->cPais = '1058';
        $std->xPais = "BRASIL";
        $std->fone = '8233240989';
        $nfe->tagenderDest($std);

        //tag prod
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->cProd = "0001";
        $std->xProd = "produto teste";
        $std->NCM = '84669330';
        $std->CFOP = '5102';
        $std->uCom = "PÇ";
        $std->qCom = '1.000';
        $std->vUnCom = '10.99';
        $std->vProd = '10.99';
        $std->cEANTrib = "SEM GTIN";
        $std->uTrib = "PÇ";
        $std->qTrib = '1.000';
        $std->vUnTrib = '10.99';
        $std->indTot  = 1;
        $nfe->tagprod($std);

        //tag imposto
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->vTotTrib = 10.99;
        $nfe->tagimposto($std);

        //tag ICMS
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->orig = 0;
        $std->CST = '00';
        $std->modBC = 0;
        $std->vBC = '0.20';
        $std->pICMS = '18.000';
        $std->vICMS = '0.04';
        $nfe->tagICMS($std);

        //tag IPI
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->cEnq = '999';
        $std->CST =  '50';
        $std->vBC =  0;
        $std->pIPI = 0;
        $std->vIPI = 0;
        $nfe->tagIPI($std);

        //tag PIS
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->CST = '07';
        $std->vBC = 0;
        $std->pPIS = 0;
        $std->vPIS = 0;
        $nfe->tagPIS($std);

        //tag COFINS
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->vCOFINS = 0;  
        $std->vBC = 0;
        $std->pCOFINS = 0;
        $nfe->tagCOFINS($std);

        //tag COFINSST
        $std = new stdClass();
        $std->item = 1; //item da NFe
        $std->CST = '01';
        $std->vBC  = 0;
        $std->pCOFINS = 0;
        $std->vCOFINS = 0;
        $std->qBCProd = 0;
        $std->vAliqProd = 0;
        $nfe->tagCOFINSST($std);

        //tag ICMSTOT
        $std = new stdClass();
        $std->vBC = 1000.00;
        $std->vICMS = 1000.00;
        $std->vICMSDeson = 1000.00;
        $std->vFCP = 1000.00; //incluso no layout 4.00
        $std->vBCST = 1000.00;
        $std->vST = 1000.00;
        $std->vFCPST = 1000.00; //incluso no layout 4.00
        $std->vFCPSTRet = 1000.00; //incluso no layout 4.00
        $std->vProd = 1000.00;
        $std->vFrete = 1000.00;
        $std->vSeg = 1000.00;
        $std->vDesc = 1000.00;
        $std->vII = 1000.00;
        $std->vIPI = 1000.00;
        $std->vIPIDevol = 1000.00; //incluso no layout 4.00
        $std->vPIS = 1000.00;
        $std->vCOFINS = 1000.00;
        $std->vOutro = 1000.00;
        $std->vNF = 1000.00;
        $std->vTotTrib = 1000.00;
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


        //Soma do valor das parcelas difere do Valor Liquido da Fatura
        //TAG pag 
        $std = new stdClass();
        $std->vTroco = null; //incluso no layout 4.00, obrigatório informar para NFCe (65)
        $nfe->tagpag($std);

        //TAG detpag 
        $std = new stdClass();
        $std->indPag = '0'; //0= Pagamento à Vista 1= Pagamento à Prazo
        $std->tPag = '01';
        $std->vPag = 10.99; //Obs: deve ser informado o valor pago pelo cliente     
        $nfe->tagdetPag($std);

        $xml = $nfe->montaNFe();
    
        dd($nfe->montaNFe());
        
       

        
    }

}

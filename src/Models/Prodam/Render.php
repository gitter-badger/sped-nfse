<?php

namespace NFePHP\NFSe\Models\Prodam;

/**
 * Classe para a renderização dos RPS em XML para a Cidade de São Paulo
 * conforme o modelo Prodam
 *
 * @category  NFePHP
 * @package   NFePHP\NFSe\Models\Prodam\Render
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use NFePHP\Common\Dom\Dom;
use NFePHP\NFSe\Models\Prodam\Rps;

class Render
{
    protected static $dom;
    
    public static function toXml(Rps $rps = null)
    {
        self::$dom = new Dom();
        $root = self::$dom->createElement('RPS');
        //tag Assinatura
        self::$dom->addChild($root, 'Assinatura', '', true, 'Tag assinatura do RPS vazia', true);
        //tag ChaveRPS
        $chaveRps = self::$dom->createElement('ChaveRPS');
        self::$dom->addChild($chaveRps, 'InscricaoPrestador', $rps->prestadorIM, true, "IM do prestador", true);
        self::$dom->addChild($chaveRps, 'NumeroRPS', $rps->numeroRPS, true, "Numero do RPS", true);
        self::$dom->appChild($root, $chaveRps, 'Adicionando tag ChaveRPS');
        //outras tags
        self::$dom->addChild($root, 'TipoRPS', $rps->tipoRPS, true, 'Tipo de RPS', false);
        self::$dom->addChild($root, 'DataEmissao', $rps->dtEmiRPS, true, 'Data de emissão', false);
        self::$dom->addChild($root, 'StatusRPS', $rps->statusRPS, true, 'Status do RPS', false);
        self::$dom->addChild($root, 'TributacaoRPS', $rps->tributacaoRPS, true, 'Tributação do RPS', false);
        self::$dom->addChild($root, 'ValorServicos', $rps->valorServicosRPS, true, 'Valor dos serviços', false);
        self::$dom->addChild($root, 'ValorDeducoes', $rps->valorDeducoesRPS, true, 'Valor das Deduções', false);
        self::$dom->addChild($root, 'ValorPis', $rps->valorPISRPS, true, 'Valor do PIS', false);
        self::$dom->addChild($root, 'ValorCOFINS', $rps->valorCOFINSRPS, true, 'Valor do COFINS', false);
        self::$dom->addChild($root, 'ValorINSS', $rps->valorINSSRPS, true, 'Valor do INSS', false);
        self::$dom->addChild($root, 'ValorIR', $rps->valorIRRPS, true, 'Valor do IR', false);
        self::$dom->addChild($root, 'ValorCSLL', $rps->valorCSLLRPS, true, 'Valor do CSLL', false);
        self::$dom->addChild($root, 'CodigoServico', $rps->codigoServicoRPS, true, 'Código do serviço', false);
        self::$dom->addChild($root, 'AliquotaServicos', $rps->aliquotaServicosRPS, true, 'Aliquota do serviço', false);
        self::$dom->addChild($root, 'ISSRetido', $rps->issRetidoRPS, true, 'ISS Retido', false);
        //tag CPFCNPJTomador
        $tomador = self::$dom->createElement('CPFCNPJTomador');
        if ($rps->tomadorTipoDoc == '2') {
            self::$dom->addChild($tomador, 'CNPJ', $rps->tomadorCNPJCPF, true, "CNPJ do tomador", false);
        } elseif ($rps->tomadorTipoDoc == '1') {
            self::$dom->addChild($tomador, 'CPF', $rps->tomadorCNPJCPF, true, "CPF do tomador", false);
        } else {
            //e se não informado ??? o que fazer ???
        }
        self::$dom->appChild($root, $tomador, 'Adicionando tag CPFCNPJTomador');
        //outras tags
        self::$dom->addChild($root, 'RazaoSocialTomador', $rps->tomadorRazao, true, 'Razão Social do tomador', false);
        //tag EnderecoTomador
        $endtomador = self::$dom->createElement('EnderecoTomador');
        self::$dom->addChild($endtomador, 'TipoLogradouro', $rps->tomadorTipoLogradouro, true, 'Tipo de logradouro do tomador', false);
        self::$dom->addChild($endtomador, 'Logradouro', $rps->tomadorLogradouro, true, 'Logradouro do tomador', false);
        self::$dom->addChild($endtomador, 'NumeroEndereco', $rps->tomadorNumeroEndereco, true, 'Numero do Logradouro do tomador', false);
        self::$dom->addChild($endtomador, 'ComplementoEndereco', $rps->tomadorComplementoEndereco, true, 'Complemento endereço do tomador', false);
        self::$dom->addChild($endtomador, 'Bairro', $rps->tomadorBairro, true, 'Bairro endereço do tomador', false);
        self::$dom->addChild($endtomador, 'Cidade', $rps->tomadorCodCidade, true, 'Cidade endereço do tomador', false);
        self::$dom->addChild($endtomador, 'UF', $rps->tomadorSiglaUF, true, 'UF endereço do tomador', false);
        self::$dom->addChild($endtomador, 'CEP', $rps->tomadorCEP, true, 'CEP endereço do tomador', false);
        self::$dom->appChild($root, $endtomador, 'Adicionando tag EnderecoTomador');
        //outras tags
        self::$dom->addChild($root, 'EmailTomador', $rps->tomadorEmail, true, 'Email do tomador', false);
        //tag intermediario
        //se existir incluir dados do intermediário
        if ($rps->intermediarioCNPJCPF) {
            $intermediario = self::$dom->createElement('CPFCNPJIntermediario');
            self::$dom->addChild($intermediario, 'CNPJ', $rps->intermediarioCNPJCPF, true, "CNPJ do intermediario", false);
            self::$dom->appChild($root, $tomador, 'Adicionando tag CPFCNPJIntermediario');
            self::$dom->addChild($root, 'InscricaoMunicipalIntermediario', $rps->intermediarioIM, false, 'IM do intermediario', false);
            self::$dom->addChild($root, 'EmailIntermediario', $rps->intermediarioEmail, false, 'email do intermediario', false);
        }
        
        
        
        self::$dom->addChild($root, 'Discriminacao', $rps->discriminacaoRPS, true, 'Discriminação do serviço', false);
        
        
        //finaliza
        self::$dom->appendChild($root);
        //retorna o xml em uma string
        return self::$dom->saveXML();
    }
}

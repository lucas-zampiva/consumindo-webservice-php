<?php

$urlWsdl = 'https://www.crcind.com/csp/samples/SOAP.Demo.CLS?WSDL=1';
try {
    //Iniciando conexão com soap, também foi adicionado configuração do proxy,
    //para conseguir verificar as requisições através do Fiddler.
    $soapClient = new \SoapClient($urlWsdl, array(
        'proxy_host'     => '127.0.0.1',
        'proxy_port'     => '8888',
        'stream_context' => stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                )
            )
        )
    ));

    //Consumindo AddInteger
    echo '<pre>';
    $obj = new stdClass();
    $obj->Arg1 = 1;
    $obj->Arg2 = 2;
    $response = $soapClient->AddInteger($obj);
    echo '<strong>AddInteger (1, 2): </strong>' . $response->AddIntegerResult;
    echo '<br/><br/>';

    //Consumindo DivideInteger
    $obj = new stdClass();
    $obj->Arg1 = 1;
    $obj->Arg2 = 2;
    $response = $soapClient->DivideInteger($obj);
    echo '<strong>DivideInteger (1, 2): </strong>' . $response->DivideIntegerResult;
    echo '<br/><br/>';

    //Consumindo GetByName
    echo '<strong>GetByName (Edward): </strong><br/>';
    $obj = new stdClass();
    $obj->name = 'Edward';
    $response = $soapClient->GetByName($obj);
    print_r($response);
    echo '</pre>';
} catch (SoapFault $exception) {
    echo $exception->getMessage();
    return;
}

<?php

$sws = new SoapClient('http://sws.clearforest.com/ws/sws.asmx?wsdl');
try{
  $result = $sws->TagIt(array(
    'UID' => 0,
    'typeID' => 1,
    'content' => 'new york',
    ));
} catch (SoapFault $exception) { return FALSE; }
if ($xml = simplexml_load_string($result->TagITResult)){
  $entities = $xml->xpath('Results/Entities');
}
print_r($entities);
?>
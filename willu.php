Hi Welcome here

<?php
$url = 'https://kvstore.p.rapidapi.com/collections';
$collection_name = 'RapidAPI';

$request_url = 'https://jokeapi.p.rapidapi.com/categories';
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'X-RapidAPI-Host: jokeapi.p.rapidapi.com',
  'X-RapidAPI-Key: 489c6ac42dmsh9417a8ec6b1287fp16ba2fjsn0b5ec4e363f8',
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

echo $response . PHP_EOL;

$jSON = json_decode($response, true);

function array2xml($array, $xml = false){

    if($xml === false){
        $xml = new SimpleXMLElement('<result/>');
    }

    foreach($array as $key => $value){
        if(is_array($value)){
            array2xml($value, $xml->addChild($key));
        } else {
            $xml->addChild($key, $value);
        }
    }

    return $xml->asXML();
}

$raw_data = $response;
$jSON = json_decode($raw_data, true);

$xml = array2xml($jSON, false);

echo '<br>';
print_r($xml);


    $doc = new DOMDocument( );
    $ele = $doc->createElement( 'Root' );
    $ele->nodeValue = $xml;
    $doc->appendChild( $ele );
    $doc->save('test.xml');
?>

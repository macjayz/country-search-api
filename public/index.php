<?php 
require '../vendor/autoload.php';

$app = new \Slim\App();

$countries = json_decode(file_get_contents('items.json'),true);

function startsWith($string, $substring){
    $len = strlen($substring);
    return (substr($string, 0, $len) == $substring);
}

$app ->get('/countries/search', function($request, $response, $args) use ($countries) {
  $term = $request->getQueryParams()['term'];
    $filteredCountries = array();
    foreach($countries as $key => $value){
        if (startsWith(strtolower($value['name']), strtolower($term))){
            array_push($filteredCountries, $value);
        }
    }
    return $response->withJson($filteredCountries);
});

$app->run();
?>
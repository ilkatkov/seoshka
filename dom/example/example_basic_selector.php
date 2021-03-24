<?php
// example of how to use basic selector to retrieve HTML contents
include('../simple_html_dom.php');
 
// get DOM from URL or file
$html = file_get_html('http://www.google.com/');

// find all link
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

// find all image
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// find all image with full tag
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// find all div tags with id=gbar
foreach($html->find('div#gbar') as $e)
    echo $e->innertext . '<br>';

// find all span tags with class=gb1
foreach($html->find('span.gb1') as $e)
    echo $e->outertext . '<br>';

// find all td tags with attribite align=center
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';
    
// extract text from table
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

// extract text from HTML
echo $html->plaintext;
?>



<?php

include('dom/simple_html_dom.php');

require_once 'src\common.php';

$dir = 'dicts';
$lang = 'ru_RU';
$opts = array(
    'storage' => PHPMORPHY_STORAGE_FILE,
    'with_gramtab' => false,
    'predict_by_suffix' => true,
    'predict_by_db' => true
);

try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch(phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
}

## Относительные ссылки на абсолютные ##

function rel2abs($rel, $base)
{
    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
    if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
    extract(parse_url($base));
    $path = preg_replace('#/[^/]*$#', '', $path);
    if ($rel[0] == '/') $path = '';
    $abs = "$host$path/$rel";
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
    return $scheme.'://'.$abs;
}
                                                               
## Получение ссылок с ключевыми словами ##

function getKeywordsLinks($links, $keywords)
{
    $keywords_links = array();
    foreach ($links as $link)
        foreach($keywords as $keyword)
            if (strpos($link, $keyword))
                array_push($keywords_links, $link);

    return $keywords_links;
} 

## Получение ключевых слов с ссылок ##

function parceKeywordsLinks($keywords_links, $keywords, $morphy)
{
    $array_of_content = array();
    $keywords_ready_to_check = array();

    $keywords_html = file_get_html($keywords_links);
    $text_to_parce = $keywords_html->plaintext;
    $words_accesing = array();

   

    foreach($keywords as $key)
        array_push($keywords_ready_to_check, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($key, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));

    foreach(explode(" ", $text_to_parce) as $word)
        if (trim($word) != "")
            array_push($array_of_content, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($word, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));
    $array_of_content = array_unique($array_of_content);
    
    // foreach($keywords_ready_to_check as $value)
    //     echo $value. "<br/>";

    // foreach($array_of_content as $value)
    //     echo $value. "<br/>";

    // echo $keywords_ready_to_check[0];

    foreach($keywords_ready_to_check as $keyword)
        if (in_array($keyword, $array_of_content) == true)
            array_push($words_accesing, $keyword);

    // foreach(array_unique($words_accesing) as $value)
    //     echo $value. "<br/>";

    return $words_accesing;
    // foreach(array_unique($words_accesing) as $value)
    //     echo $value. "<br/>";

    // foreach($keywords as $keyword){
        // if (strpos($link, $keyword))
    

    // echo $text_to_parce;
}



$SEO = 'https://www.lamoda.ru/women-home/';  // То что даёт пользователь
$html = file_get_html($SEO);    // DOM
// $names = getNames($SEO);
$links = array();

foreach($html->find('a') as $e) 
    array_push($links, $e->href);

// getDeliveryLinks($links);

// foreach(getDeliveryLinks($links) as $value)

$finded_delivery_words = array();
echo "<b>Текст доставки:</b><br>";
foreach(getKeywordsLinks($links, array('delivery', "shipment")) as $value)
    $finded_delivery_words = array_merge($finded_delivery_words, parceKeywordsLinks(rel2abs($value, $SEO), array("на дом", "бесконтактная", "доставка", "онлайн", "заказ", "способ", "карта", "город", "бесплатно", "курьер", "возврат", "гарантии", "оплата","банковская", "получение", "отслеживание", "отказ", "адрес", "стоимость"), $morphy));

$finded_delivery_words = array_unique($finded_delivery_words);

foreach($finded_delivery_words as $value)
    echo $value. "<br/>";

?>
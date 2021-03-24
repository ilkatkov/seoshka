<?php

include('../dom/simple_html_dom.php');

require_once '../src/common.php';

$dir = '../dicts/';
$lang = 'ru_RU';
$opts = array(
    'storage' => PHPMORPHY_STORAGE_FILE,
    'with_gramtab' => false,
    'predict_by_suffix' => true,
    'predict_by_db' => true
);

try {
    $morphy = new phpMorphy($dir, $lang, $opts);
} catch (phpMorphy_Exception $e) {
    die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
}

$SEO = $_POST['link'];  // То что даёт пользователь

function parceKeywordsLinksMain($keywords_links, $keywords, $morphy, $array_of_content)
{
    $keywords_ready_to_check = array();
    $words_accesing = array();

    foreach ($keywords as $key)
        array_push($keywords_ready_to_check, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($key, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));

    foreach ($keywords_ready_to_check as $keyword)
        if (in_array($keyword, $array_of_content) == true)
            if (trim($keyword) != "")
                array_push($words_accesing, $keyword);

    return $words_accesing;
}


function parseMain($SEO, $morphy)
{
    ### PARCING MAIN SITE ###
    $array_of_content = array();
    // $text_to_parce = file_get_html($SEO)->plaintext;
    $text_to_parce = array();

    foreach (file_get_html($SEO)->find('p') as $e)
        array_push($text_to_parce, $e->innertext);
    foreach (file_get_html($SEO)->find('span') as $e)
        array_push($text_to_parce, $e->innertext);
    foreach (file_get_html($SEO)->find('a') as $e)
        array_push($text_to_parce, $e->innertext);
    foreach (file_get_html($SEO)->find('h1') as $e)
        array_push($text_to_parce, $e->innertext);

    foreach ($text_to_parce as $string_to_parce)
        foreach (explode(" ", $string_to_parce) as $word) {
            $buffer = array();
            $Bigletters_amount = mb_strlen(preg_replace('/[^A-ZА-ЯЁ]/u', '', $word), 'UTF-8');
            if ($Bigletters_amount > 1) {
                preg_match_all('/[А-ЯA-Z][^А-ЯA-Z]*?/Usu', $word, $buffer);
                foreach ($buffer[0] as $value)
                    if (trim($value != ""))
                        array_push($array_of_content, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($value, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));
            } else
                if (trim($word != ""))
                array_push($array_of_content, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($word, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));
        }
    return $array_of_content;
}
$array_of_content = parseMain($SEO, $morphy);
$array_of_content = array_unique($array_of_content);

// $finded_content_about_us_main = parceKeywordsLinksMain($SEO, array("г.", "Город", "телефон", "почта", "e-mail", "адрес", "улица", "ул.", "контакты", "номер"),  $morphy, $array_of_content);
// foreach ($finded_content_about_us_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст доставки:</b><br>";
// $finded_content_delivery_main = parceKeywordsLinksMain($SEO, array("бесконтактная", "доставка", "онлайн", "заказ", "способ", "карта", "город", "бесплатно", "курьер", "возврат", "гарантии", "оплата", "банковская", "получение", "отслеживание", "отказ", "адрес", "стоимость"),  $morphy, $array_of_content);
// foreach ($finded_content_delivery_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст оплаты:</b><br>";
// $finded_content_payment_main = parceKeywordsLinksMain($SEO, array("бесконтактная", "цена", "онлайн", "заказ", "способ", "карта", "бесплатно", "оплата", "банковская", "отказ", "стоимость"),  $morphy, $array_of_content);
// foreach ($finded_content_payment_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст гарантии:</b><br>";
// $finded_content_waranty_main = parceKeywordsLinksMain($SEO, array("гарантии", "подлинность", "подлинность"),  $morphy, $array_of_content);
// foreach ($finded_content_waranty_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст возврата:</b><br>";
// $finded_content_return_main = parceKeywordsLinksMain($SEO, array("вернуть", "товар", "14", "дней", "возврат", "выдача", "заказ", "оплата", "оплатить"),  $morphy, $array_of_content);
// foreach ($finded_content_return_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст акций:</b><br>";
// $finded_content_sale_main = parceKeywordsLinksMain($SEO, array("скидка", "%", "дополнительно", "сегодня", "распродажа", "бесплатно"),  $morphy, $array_of_content);
// foreach ($finded_content_sale_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст цен:</b><br>";
// $finded_content_prices_main = parceKeywordsLinksMain($SEO, array("бесконтактная", "цена", "онлайн", "категория", "способ", "карта", "бесплатно",  "возврат", "оплата", "банковская", "отказ", "стоимость"),  $morphy, $array_of_content);
// foreach ($finded_content_prices_main as $value)
//     echo $value . "<br/>";

// echo "<b>Текст отзывов:</b><br>";
// $finded_content_feeadback_main = parceKeywordsLinksMain($SEO, array("почему", "вопрос", "спросить", "где", "как", "когда", "узнать", "Какие", "как", "существует", "что"),  $morphy, $array_of_content);
// foreach ($finded_content_feeadback_main as $value)
//     echo $value . "<br/>";




## Относительные ссылки на абсолютные ##

function rel2abs($rel, $base)
{
    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
    if ($rel[0] == '#' || $rel[0] == '?') return $base . $rel;
    extract(parse_url($base));
    $path = preg_replace('#/[^/]*$#', '', $path);
    if ($rel[0] == '/') $path = '';
    $abs = "$host$path/$rel";
    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
    for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
    }
    return $scheme . '://' . $abs;
}

## Получение ссылок с ключевыми словами ##

function getKeywordsLinks($links, $keywords)
{
    $keywords_links = array();
    foreach ($links as $link)
        foreach ($keywords as $keyword)
            if (strpos($link, $keyword))
                array_push($keywords_links, $link);

    return $keywords_links;
}



## Получение ключевых слов с ссылок ##

function parceKeywordsLinks($keywords_links, $keywords, $morphy)
{
    $array_of_content = array();
    $keywords_ready_to_check = array();
    $words_accesing = array();

    $keywords_html = file_get_html($keywords_links);
    $text_to_parce = $keywords_html->plaintext;

    foreach ($keywords as $key)
        array_push($keywords_ready_to_check, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($key, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));

    foreach (explode(" ", $text_to_parce) as $word)
        if (trim($word) != "")
            array_push($array_of_content, mb_strtolower($morphy->castFormByGramInfo(mb_strtoupper($word, 'utf-8'), null, array('ЕД', 'ИМ'), true)[0], "utf-8"));
    $array_of_content = array_unique($array_of_content);

    foreach ($keywords_ready_to_check as $keyword)
        if (in_array($keyword, $array_of_content) == true)
            if (trim($keyword) != "")
                array_push($words_accesing, $keyword);

    return $words_accesing;
}

// ## Найти слова по доставке

// function findDeliveryKeywords($SEO, $links, $morphy)
// {
//     $finded_delivery_words = array();
//     echo "<b>Текст доставки:</b><br>";
//     foreach(getKeywordsLinks($links, array('delivery', "shipment")) as $value)
//         $finded_delivery_words = array_merge($finded_delivery_words, parceKeywordsLinks(rel2abs($value, $SEO), array("на дом", "бесконтактная", "доставка", "онлайн", "заказ", "способ", "карта", "город", "бесплатно", "курьер", "возврат", "гарантии", "оплата","банковская", "получение", "отслеживание", "отказ", "адрес", "стоимость"), $morphy));

//     $finded_delivery_words = array_unique($finded_delivery_words);
//     return $finded_delivery_words;
// }

// ## Найти слова по контактам

// function findContactKeywords($SEO, $links, $morphy)
// {
//     $finded_contact_words = array();
//     echo "<b>Текст контактов:</b><br>";
//     foreach(getKeywordsLinks($links, array('company', "phone", "contact", "about", "us")) as $value)
//         $finded_contact_words = array_merge($finded_contact_words, parceKeywordsLinks(rel2abs($value, $SEO), array("г.", "Город", "телефон", "почта", "e-mail", "адрес", "улица", "ул.", "контакты", "номер"), $morphy));

//     $finded_contact_words = array_unique($finded_contact_words);
//     return $finded_contact_words;
// }

function findKeywords($SEO, $links, $morphy, $words_to_find)
{
    $finded_words = array();
    foreach ($links as $value)
        $finded_words = array_merge($finded_words, parceKeywordsLinks(rel2abs($value, $SEO), $words_to_find, $morphy));

    $finded_words = array_unique($finded_words);
    return $finded_words;
}


$html = file_get_html($SEO);    // DOM

$links = array();

// $finded_link_about_us = array('company', "phone", "contact", "about", "us");
// $finded_link_payment = array("offer", "payment", "credit", "sale", "shop", "buy");
// $finded_link_delivery = array('delivery', "shipment");
// $finded_link_warranty = array("warranty", "guarantee");
// $finded_link_return = array("refunds");
// $finded_link_sales = array("event", "sale", "new", "offer", "shop");
// $finded_link_feedbacks = array("support", "chat", "help", "mention", "feedback");
// $finded_link_prices = array("price", "catalog", "buy", "goods", "cash");


// $finded_link_sertificates = "";

foreach ($html->find('a') as $e)
    if (trim($e->href) != "")
        array_push($links, $e->href);
$links = array_unique($links);





## about us ##
if ($_POST['part'] == "about_us") {
    $finded_link_about_us = getKeywordsLinks($links, array('company', "phone", "contact", "about"));
    $finded_content_about_us_main = parceKeywordsLinksMain($SEO, array("г.", "Город", "год", "телефон", "почта", "e-mail", "адрес", "улица", "ул.", "контакты", "номер"),  $morphy, $array_of_content);
    $finded_content_about_us = array();
    if (count($finded_link_about_us) > 0) {
        $finded_content_about_us = findKeywords($SEO, $finded_link_about_us, $morphy, array("г.", "Город", "телефон", "почта", "e-mail", "адрес", "улица", "ул.", "контакты", "номер"));
    }
    echo json_encode(array_merge($finded_content_about_us, $finded_content_about_us_main));
}

## delivery ##
if ($_POST['part'] == "delivery") {
    $finded_link_delivery = getKeywordsLinks($links, array('delivery', "shipment"));
    $finded_content_delivery_main = parceKeywordsLinksMain($SEO, array("бесконтактная", "доставка", "город", "бесплатно", "курьер", "возврат", "получение", "отслеживание", "почта", "дом", "срок"),  $morphy, $array_of_content);
    $finded_content_delivery = array();
    if (count($finded_link_delivery) > 0) {
        $finded_content_delivery = findKeywords($SEO, $finded_link_delivery, $morphy, array("бесконтактная", "доставка", "город", "бесплатно", "курьер", "возврат", "получение", "отслеживание", "почта", "дом", "срок"));
    }
    echo json_encode(array_merge($finded_content_delivery, $finded_content_delivery_main));
}

## payment ##
if ($_POST['part'] == "payment") {
    $finded_link_payment = getKeywordsLinks($links, array("offer", "payment", "credit", "shop", "buy"));
    $finded_content_payment_main = parceKeywordsLinksMain($SEO, array("цена", "онлайн", "способ", "карта", "банковская", "стоимость", "платёж", "получение", "наличный", "итого"),  $morphy, $array_of_content);
    $finded_content_payment = array();
    if (count($finded_link_payment) > 0) {
        $finded_content_payment = findKeywords($SEO, $finded_link_payment, $morphy, array("цена", "онлайн", "способ", "карта", "банковская", "стоимость", "платёж", "получение", "наличный", "итого"));
    }
    echo json_encode(array_merge($finded_content_payment, $finded_content_payment_main));
}

## waranty ##
if ($_POST['part'] == "warranty") {
    $finded_link_waranty = getKeywordsLinks($links, array("warranty", "guarantee"));
    $finded_content_payment_main = parceKeywordsLinksMain($SEO, array("бесконтактная", "цена", "онлайн", "заказ", "способ", "карта", "бесплатно", "оплата", "банковская", "отказ", "стоимость"),  $morphy, $array_of_content);
    $finded_content_waranty = array();
    if (count($finded_link_waranty) > 0) {
        $finded_content_waranty = findKeywords($SEO, $finded_link_waranty, $morphy, array("гарантии", "подлинность", "подлинность"));
    }
    echo json_encode(array_merge($finded_content_waranty, $finded_content_waranty_main));
}

## return ##
if ($_POST['part'] == "return") {
    $finded_link_return = getKeywordsLinks($links, array("refunds"));
    $finded_content_return_main = parceKeywordsLinksMain($SEO, array("период", "возмещение", "вернуть", "возврат", "отказ", "ненадлежащий", "обмен"),  $morphy, $array_of_content);
    $finded_content_return = array();
    if (count($finded_link_return) > 0) {
        $finded_content_return = findKeywords($SEO, $finded_link_return, $morphy, array("период", "возмещение", "вернуть", "возврат", "отказ", "ненадлежащий", "обмен"));
    }
    echo json_encode(array_merge($finded_content_return, $finded_content_return_main));
}

## sales ##
if ($_POST['part'] == "sales") {
    $finded_link_sales = getKeywordsLinks($links, array("event", "sale", "new", "offer", "shop"));
    $finded_content_sale_main = parceKeywordsLinksMain($SEO, array("лояльность", "промокод", "скидка", "%", "распродажа", "бесплатно", "подарочная", "дарим", "кешбэк"),  $morphy, $array_of_content);
    $finded_content_sales = array();
    if (count($finded_link_sales) > 0) {
        $finded_content_sales = findKeywords($SEO, $finded_link_sales, $morphy, array("лояльность", "промокод", "скидка", "%", "распродажа", "бесплатно", "подарочная", "дарим", "кешбэк"));
    }
    echo json_encode(array_merge($finded_content_sales, $finded_content_sale_main));
}

## prices ##
if ($_POST['part'] == "prices") {
    $finded_link_prices = getKeywordsLinks($links, array("price", "catalog", "buy", "goods", "cash"));
    $finded_content_prices_main = parceKeywordsLinksMain($SEO, array("цена", "категория", "оплата", "стоимость", "каталог", "экономия", "НДС", "специальная", "руб"),  $morphy, $array_of_content);
    $finded_content_prices = array();
    if (count($finded_link_prices) > 0) {
        $finded_content_prices = findKeywords($SEO, $finded_link_prices, $morphy, array("цена", "категория", "оплата", "стоимость", "каталог", "экономия", "НДС", "специальная", "руб"));
    }
    echo json_encode(array_merge($finded_content_prices, $finded_content_prices_main));
}

## feedbacks ##
if ($_POST['part'] == "feedbacks") {
    $finded_link_feedbacks = getKeywordsLinks($links, array("support", "chat", "help", "mention", "feedback"));
    $finded_content_feeadback_main = parceKeywordsLinksMain($SEO, array("почему", "вопрос", "спросить", "где", "как", "когда", "узнать", "Какие", "как", "существует", "что"),  $morphy, $array_of_content);
    $finded_content_feedbacks = array();
    if (count($finded_link_feedbacks) > 0) {
        $finded_content_feedbacks = findKeywords($SEO, $finded_link_feedbacks, $morphy, array("почему", "вопрос", "спросить", "где", "как", "когда", "узнать", "Какие", "как", "существует", "что"));
    }
    echo json_encode(array_merge($finded_content_feedbacks, $finded_content_feeadback_main));
}

if ($_POST['part'] == "other") {
    $metas = 0;
    $erarxii = 0;
    $telsAndMail = 0;

    foreach ($html->find('meta') as $e)
        if (trim($e != ""))
            $metas += 1;

    foreach ($links as $value)
        $erarxii += substr_count($value, "/");

    foreach ($links as $value) {
        $telsAndMail += substr_count($value, "tel:");
        $telsAndMail += substr_count($value, "mailto:");
    }
    $erarxii = count($links) / $erarxii;

    $total = 1;
    if ($erarxii < 0.6)
        if ($metas + $telsAndMail > 4)
            $total = 5;
        else
            $total = 4;
    else {
        if ($erarxii + $telsAndMail > 4)
            $total = 3;
        else
            $total = 2;
    }

    $total = array($total);
    echo json_encode($total);
}


    


// foreach( findContactKeywords($SEO, $links, $morphy) as $value)
//     echo $value. "<br>";

// foreach( findDeliveryKeywords($SEO, $links, $morphy) as $value)
// echo $value. "<br>";
?>
<?php

$languages = languages();

foreach($languages as $language)
{
    define($language->variable, $language->turkish);
}

//$lang["baslik"] = "Başlık";

?>
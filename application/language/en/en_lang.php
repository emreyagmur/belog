<?php

$languages = languages();

foreach($languages as $language)
{
    define($language->variable, $language->english);
}

//$lang["baslik"] = "Title";



?>
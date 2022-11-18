<?php

$genres[] = 'Pop';
$genres[] = 'Baroque pop';
$genres[] = 'Country pop';
$genres[] = 'Contemporary pop';
$genres[] = 'Elecropop';
$genres[] = 'Folk pop';
$genres[] = 'Classical';
$genres[] = 'Ambient pop';
$genres[] = 'Pop rap';
$genres[] = 'Indie pop';
$genres[] = 'Power pop';


$query = $_REQUEST['query'];
$suggestion = "";  // responseText

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($genres as $genre) {
        if (stristr($query, substr($genre, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $genre;
            } else {
                $suggestion .= ", $genre";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}

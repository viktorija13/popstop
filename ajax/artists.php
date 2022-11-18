<?php

$artists[] = 'Rihanna';
$artists[] = 'Taylor Swift';
$artists[] = 'Beyonce';
$artists[] = 'SZA';
$artists[] = 'Katty Perry';
$artists[] = 'Michael Jackson';
$artists[] = 'Lady Gaga';
$artists[] = 'Madonna';
$artists[] = 'Ariana Grande';
$artists[] = 'Adele';
$artists[] = 'Elton John';
$artists[] = 'Britney Spears';
$artists[] = 'Miley Cyrus';
$artists[] = 'Dua Lipa';
$artists[] = 'Manuel Turizo';
$artists[] = 'Harry Styles';
$artists[] = 'Meghan Trainor';
$artists[] = 'Selena Gomez';


$query = $_REQUEST['query'];
$suggestion = "";  // responseText

if ($query !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($artists as $artist) {
        if (stristr($query, substr($artist, 0, $length))) {
            if ($suggestion == "") {
                $suggestion = $artist;
            } else {
                $suggestion .= ", $artist";
            }
        }
    }
}
if ($suggestion == "") {
    echo 'No suggestions';
} else {
    echo $suggestion;
}

<?php
/* Template Name: Jazz Api Template */
get_header();

context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
$url = 'https://affiliates.jazzsports.com/xmlfeed/oanFeed?id_book=4';

$xml = file_get_contents($url, false, $context);
$xml = simplexml_load_string($xml);

$rows = $xml->odds->schedule;

foreach($rows as $sub_row){
    $games = $sub_row->game;
    foreach($games as $game){
        $participant1 = $game->participant[0];
        $participant2 = $game->participant[1];
        $line1 = $participant1->line;
        $line2 = $participant2->line;
        echo 'time is: '.$game['time'].'</br>';
        echo 'Participant 1 is: '.$participant1['name'].'</br>';
        echo 'Money line: '.$line1['money_line'].'</br>';
        echo 'Spread line: '.$line1['spread'].'</br>';
        echo 'Spread Odds line: '.$line1['spread_odds'].'</br>';
        echo 'Participant 2 is: '.$participant2['name'].'</br>';
        echo 'Money line: '.$line2['money_line'].'</br>';
        echo 'Spread line: '.$line2['spread'].'</br>';
        echo 'Spread Odds line: '.$line2['spread_odds'].'</br>';
    }  
    
}

get_footer();
?>
<?php
/**
 * Passt Datum an aktuelles Datum an und gibt dieses dynamisch aus.
 * Mögliche Ausgaben:
 * 
 * just now (<5min)
 * 5-59 minutes ago
 * 1-24 hours ago
 * 12th May, 2020 (>24h)
 * 
 * @param string $date
 * @return string $dd
 */
function dynamicDate( $date )
{
    $now = \Carbon\Carbon::now();
    if(is_string($date)) {
        $request = \Carbon\Carbon::create($date);
    } else {
        $request = \Carbon\Carbon::create($date->toDateTimeString());
    }

    $dd = $request->format('M. d, Y');

    // Dynamische Stringzuweisung
    if($request->greaterThan( $now->sub('5 minutes') )) {

        // < 5 minutes ago
        $dd = 'just now';

    } else if ($request->greaterThan( $now->sub('1 hour') )) {

        // x minutes ago
        $timeDif = 60 - $now->diffinMinutes($request);
        $dd = $timeDif . " minutes ago";

    } else if ($request->greaterThan( $now->sub('24 hour') )) {

        // x hours ago
        $timeDif = $now->diffinHours($request);
        $dd = $timeDif . " hours ago";

    }

    return $dd;
}


/**
 * Kürtzt Text für Latest Expenses Liste auf 20 Zeichen inkl '..' am Ende
 * 
 * @param string $value
 * @return string
 */
function oneRowText (string $value)
{
    $length =  strlen($value);

    if($length > 18) {

        $new = substr($value, 0, 16) . '..';


        return $new;

    } else {
        return $value;
    }

}
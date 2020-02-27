<?php
/**
 * Passt verganngenes Datum relative an aktuelles Datum an und gibt dieses dynamisch aus.
 * Mögliche Ausgaben:
 * 
 * just now    (<5min)
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

    // Default Date Format
    $dd = $request->format('M. d, Y');

    // Dynamische Stringzuweisung
    if($request->greaterThan( $now->sub('5 minutes') )) {

        // < 5 minutes ago
        $dd = 'just now';

    } else if ($request->greaterThan( $now->sub('1 hour') )) {

        // x minutes ago
        $timeDif = 60 - $now->diffinMinutes($request);

        if($timeDif === 1) {
            $subTxt = "minute ago";
        } else {
            $subTxt = "minutes ago";
        }

        $dd = $timeDif . " " . $subTxt;

    } else if ($request->greaterThan( $now->sub('24 hour') )) {

        // x hours ago
        $timeDif = 24 - $now->diffinHours($request);
        if($timeDif === 1) {
            $subTxt = "hour ago";
        } else {
            $subTxt = "hours ago";
        }

        $dd = $timeDif . " " . $subTxt;

    }

    return $dd;
}


/**
 * Passt in Zukunft liegendes Datum relativ an aktuelles Datum an und gibt dieses dynamisch aus.
 * Mögliche Ausgaben:
 * 
 * today
 * tomorrow
 * x days  (< 1y)
 * x years (> 1y)
 * 
 * @param string $value
 * @return string
 */
function dynamicFutureDate( $date )
{
    $now = \Carbon\Carbon::now();

    if(is_string($date)) {
        $request = \Carbon\Carbon::create($date);
    } else {
        $request = \Carbon\Carbon::create($date->toDateTimeString());
    }

    $dd = $request->format('M. d, Y');

    if($request->isToday()) {

        $diff = 'today';
        $subTxt = '';

    } else if ($request->isCurrentMonth()) {

        $diff = $now->diffinDays($request);
        $subTxt = $diff === 1 ? 'day' : 'days';

    } else if ($request->isCurrentYear()) {

        $diff = $now->diffInMonths($request);
        $subTxt = $diff === 1 ? 'month' : 'months';

    } else {

        $diff = $now->diffInYears($request);
        $subTxt = $diff === 1 ? 'year' : 'years';
    }

    return $diff . ' ' . $subTxt;
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
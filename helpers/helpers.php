<?php

function NiceTime($date){
    if(!$date){
        return '';
    }
    $now = time() + 7*3600;
    $date = strtotime($date);
    $delta = $now - $date;

    if($delta < 60){
        return 'Vài giây trước';
    } else if($delta < 3600){
        return floor($delta/60) . ' phút trước';
    }else if($delta < 86400){
        return floor($delta/3600) . ' giờ trước';
    }
    return GetWeekday($date);
}

function GetWeekday($date) {
    $weekday = date("l", strtotime($date));
    $weekday = strtolower($weekday);
    switch($weekday) {
        case 'monday':
            $weekday = 'Thứ hai';
            break;
        case 'tuesday':
            $weekday = 'Thứ ba';
            break;
        case 'wednesday':
            $weekday = 'Thứ tư';
            break;
        case 'thursday':
            $weekday = 'Thứ năm';
            break;
        case 'friday':
            $weekday = 'Thứ sáu';
            break;
        case 'saturday':
            $weekday = 'Thứ bảy';
            break;
        default:
            $weekday = 'Chủ nhật';
            break;
    }
    echo $weekday.', '.date('d/m/Y');
}
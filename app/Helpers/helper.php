<?php

if (!function_exists('get_country_between_parenthesis')) {

    /**
     * return country code which between parenthesis
     * from a given phone number ex. "(xxx) xxxxxxxx"
     * @param $phone
     * @return mixed
     */
    function get_country_between_parenthesis($phone)
    {
        preg_match('#\((.*?)\)#', $phone, $match);
        return $match[1];
    }
}

if (!function_exists('get_phone_without_country')) {

    /**
     * return phone number which is the number after space
     * from a phone code which looks like "(xxx) xxxxxxxx"
     * @param $phone
     * @return mixed|string
     */
    function get_phone_without_country($phone)
    {
        $phone_data = explode(' ', $phone);
        return $phone_data[1];
    }
}

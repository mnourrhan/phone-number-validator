<?php


namespace App\PhoneRegex;


abstract class AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = '';
    const COUNTRY_CODE = '';
    const REGEX = '';

    /**
     * return true if phone number match the country phone regex
     * @param $phone_number
     * @return false|int
     */
    public function isPhoneValid($phone_number){
        return preg_match('/' . $this::REGEX . '/', $phone_number);
    }

    /**
     * return country code with + at the head
     * @return string
     */
    public function getPrettyCode(){
        return '+' . $this::COUNTRY_CODE;
    }
}

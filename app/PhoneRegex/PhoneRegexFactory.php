<?php


namespace App\PhoneRegex;


class PhoneRegexFactory
{
    /**
     * any new regex class should be added to this const
     */
    const ALL_COUNTRIES_PHONE_REGEX = [
        CameroonPhoneRegex::class,
        EthiopiaPhoneRegex::class,
        MoroccoPhoneRegex::class,
        MozambiquePhoneRegex::class,
        UgandaPhoneRegex::class,
    ];

    /**
     * given a country code return instance of appropriate phone regex class
     * any new regex class should be added as a switch case.
     * @param $country_code
     * @return AbstractCountryPhoneRegex
     */
    public static function getInstance($country_code){
        switch ($country_code){
            case CameroonPhoneRegex::COUNTRY_CODE:
                return new CameroonPhoneRegex();
            case EthiopiaPhoneRegex::COUNTRY_CODE:
                return new EthiopiaPhoneRegex();
            case MoroccoPhoneRegex::COUNTRY_CODE:
                return new MoroccoPhoneRegex();
            case MozambiquePhoneRegex::COUNTRY_CODE:
                return new MozambiquePhoneRegex();
            case UgandaPhoneRegex::COUNTRY_CODE:
                return new UgandaPhoneRegex();
            default: // return cameroon phone regex as a default
                return new CameroonPhoneRegex();
        }
    }

    /**
     * get list of the supported country codes
     * @return array
     */
    public static function getCountriesCode(){
        $list = array();
        foreach (self::ALL_COUNTRIES_PHONE_REGEX as $countryRegex){
            array_push($list, $countryRegex::COUNTRY_CODE);
        }
        return $list;
    }


    /**
     * get list of the supported countries with name as key and code as value
     * @return array
     */
    public static function getCountriesCodeWithName(){
        $list = array();
        foreach (self::ALL_COUNTRIES_PHONE_REGEX as $countryRegex){
            $list[$countryRegex::COUNTRY_NAME] = $countryRegex::COUNTRY_CODE;
        }
        return $list;
    }
}

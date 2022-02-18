<?php

namespace App\PhoneRegex;

/**
 * Class MozambiquePhoneRegex
 * @package App\PhoneRegex
 */
class MozambiquePhoneRegex extends AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = 'Mozambique';
    const COUNTRY_CODE = "258";
    const REGEX = "\(258\)\ ?[28]\d{7,8}$";
}

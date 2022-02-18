<?php

namespace App\PhoneRegex;

/**
 * Class UgandaPhoneRegex
 * @package App\PhoneRegex
 */
class UgandaPhoneRegex extends AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = 'Uganda';
    const COUNTRY_CODE = "256";
    const REGEX = "\(256\)\ ?\d{9}$";
}

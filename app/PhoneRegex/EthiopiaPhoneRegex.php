<?php

namespace App\PhoneRegex;

/**
 * Class EthiopiaPhoneRegex
 * @package App\PhoneRegex
 */
class EthiopiaPhoneRegex extends AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = 'Ethiopia';
    const COUNTRY_CODE = "251";
    const REGEX = "\(251\)\ ?[1-59]\d{8}$";
}

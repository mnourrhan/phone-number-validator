<?php

namespace App\PhoneRegex;

/**
 * Class MoroccoPhoneRegex
 * @package App\PhoneRegex
 */
class MoroccoPhoneRegex extends AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = 'Morocco';
    const COUNTRY_CODE = "212";
    const REGEX = "\(212\)\ ?[5-9]\d{8}$";
}

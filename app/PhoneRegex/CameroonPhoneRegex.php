<?php

namespace App\PhoneRegex;

/**
 * Class CameroonPhoneRegex
 * @package App\PhoneRegex
 */
class CameroonPhoneRegex extends AbstractCountryPhoneRegex
{
    const COUNTRY_NAME = 'Cameroon';
    const COUNTRY_CODE = "237";
    const REGEX = "\(237\)\ ?[2368]\d{7,8}$";
}

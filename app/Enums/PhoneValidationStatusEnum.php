<?php


namespace App\Enums;


class PhoneValidationStatusEnum
{
    const VALID = 1;
    const INVALID = 2;

    const VALID_TEXT = 'Ok';
    const INVALID_TEXT = 'NOK';

    const ALL_STATUS = [
        self::VALID,
        self::INVALID
    ];


    const VALIDATION_STATUS_TEXT = [
        self::VALID => self::VALID_TEXT,
        self::INVALID => self::INVALID_TEXT
    ];

}

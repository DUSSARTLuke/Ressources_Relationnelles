<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class ProgressStatusType extends AbstractEnumType
{
    public const NOT_STARTED = 'NS';
    public const IN_PROGRESS = 'IP';
    public const FINISHED = 'FI';

    protected static array $choices = [
        self::NOT_STARTED => 'Non commencée',
        self::IN_PROGRESS => 'En cours',
        self::FINISHED => 'Finie'
    ];

    public static function getDefaultValue(): ?string
    {
        return self::NOT_STARTED; // This value will be used as default in DDL statement
    }

}

<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class ResourceVisibilityType extends AbstractEnumType
{
    public const PUBLIC = 'PUB';
    public const PRIVATE = 'PRI';
    public const SHARED = 'SH';

    protected static $choices = [
        self::PUBLIC => 'Publique',
        self::PRIVATE => 'Privées',
        self::SHARED => 'Partagées',
    ];

    public static function getDefaultValue(): ?string
    {
        return self::PUBLIC; // This value will be used as default in DDL statement
    }
}

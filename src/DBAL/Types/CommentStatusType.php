<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class CommentStatusType extends AbstractEnumType
{
    public const CREATED = 'CR';
    public const WAITING_VALIDATION = 'WA';
    public const PUBLISHED = 'PU';
    public const DELETED = 'DE';

    protected static $choices = [
        self::CREATED => 'Créé',
        self::WAITING_VALIDATION => 'En attente de validation',
        self::PUBLISHED => 'Publié',
        self::DELETED => 'Supprimé'
    ];

    public static function getDefaultValue(): ?string
    {
        return self::CREATED; // This value will be used as default in DDL statement
    }
}

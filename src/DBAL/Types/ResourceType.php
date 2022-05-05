<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class ResourceType  extends AbstractEnumType
{
    public const GAME = 'GA';
    public const ARTICLE = 'AR';
    public const CHALLENGE = 'CH';
    public const PDF_COURSE = 'PC';
    public const WORKSHOP = 'WO';
    public const READING_SHEET = 'RS';
    public const ONLINE_GAME = 'OG';
    public const VIDEO = 'VI';

    protected static array $choices = [
        self::GAME => 'Jeu à réaliser / activité',
        self::ARTICLE => 'Article',
        self::CHALLENGE => 'Carte défi',
        self::PDF_COURSE => 'Cours au format PDF',
        self::WORKSHOP => 'Exercice / atelier',
        self::READING_SHEET => 'Fiche de lecture',
        self::ONLINE_GAME => 'Jeu en ligne',
        self::VIDEO => 'Vidéo'
    ];

}

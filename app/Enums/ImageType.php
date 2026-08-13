<?php

namespace App\Enums;

enum ImageType: string
{
    case Logo = 'logo';
    case Banner = 'banner';
    case Background = 'background';
    case Tarifs = 'tarifs';

    public function getLabel(): string
    {
        return match ($this) {
            self::Logo => 'Logo',
            self::Banner => 'Bannière',
            self::Background => 'Image de fond',
            self::Tarifs => 'Image des tarifs',
        };
    }
}

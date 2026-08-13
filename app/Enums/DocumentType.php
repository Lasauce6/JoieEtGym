<?php

namespace App\Enums;

enum DocumentType: string
{
    case Planning = 'planning';
    case Depliant = 'depliant';
    case QstMajeurs = 'qst_majeurs';
    case QstMineurs = 'qst_mineurs';
    case AssuranceMaif = 'assurance_maif';
    case AssuranceIaSports = 'assurance_ia_sports';
    case CompteRenduAg = 'compte_rendu_ag';

    public function getLabel(): string
    {
        return match ($this) {
            self::Planning => 'Planning des cours',
            self::Depliant => "Dépliant d'informations",
            self::QstMajeurs => 'Questionnaire de santé (Majeurs)',
            self::QstMineurs => 'Questionnaire de santé (Mineurs)',
            self::AssuranceMaif => 'Assurance MAIF',
            self::AssuranceIaSports => 'Assurance complémentaire IA Sports',
            self::CompteRenduAg => 'Compte rendu AG',
        };
    }
}

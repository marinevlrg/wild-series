<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Program;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMLIST = [
        [
            "Title" => "Wednesday",
            "Synopsis" => "A présent étudiante à la singulière Nevermore Academy, 
            Wednesday Addams tente de s'adapter auprès des autres élèves tout en enquêtant à la suite d'une série de meurtres qui terrorise la ville...",
            "Category" => "category_Comédie"
        ],
        [
            "Title" => "Arcane",
            "Synopsis" => "Raconte l'intensification des tensions entre deux villes suite à l'apparition de nouvelles
                inventions qui menacent de provoquer une véritable révolution",
            "Category" => "category_Animation"
        ],
        [
            "Title" => "1899",
            "Synopsis" => "La série suit les circonstances mystérieuses du voyage d’un bateau d’immigrés d’Europe navigant vers New York. 
            Les passagers sont tous d’origines différentes mais partagent les mêmes rêves et espoirs quant au nouveau centenaire et à leur avenir à l’étranger.",
            "Category" => "category_Drame"
        ],
        [
            "Title" => "The boyz",
            "Synopsis" => "Une histoire d'action centrée sur une équipe de la CIA chargée de maintenir les super-héros
                en ligne, par tous les moyens nécessaires.",
            "Category" => "category_Action"
        ],
        [
            "Title" => "Sandman",
            "Synopsis" => "Après des années d'emprisonnement, le Seigneur des Rêves commence son périple à travers les mondes pour retrouver ce qu'on lui a volé et récupérer son pouvoir.",
            "Category" => "category_Drame"
        ],
        [
            "Title" => "Home for christmas",
            "Synopsis" => "Johanne, éternelle célibataire, va enfin amener un petit ami dans sa famille pour Noël!
                  Mais quand elle se fait larguer, il ne lui reste que 24 jours pour le remplacer.",
            "Category" => "category_Romance"
        ],
    ];
    public function load(ObjectManager $manager): void
    {

        foreach (self::PROGRAMLIST as $key => $ProgramInfo) {
            $program = new Program();
            $program->setTitle($ProgramInfo["Title"]);
            $program->setSynopsis($ProgramInfo["Synopsis"]);
            $program->setCategory($this->getReference($ProgramInfo["Category"]));
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

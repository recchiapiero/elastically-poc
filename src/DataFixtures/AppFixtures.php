<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\OfferFactory;
use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public const CATEGORIES = [
        'Audio',
        'Video',
        'Games',
        'Accessories',
        'Cellphones',
        'Laptops',
        'Tablets',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $CATEGORY) {
            CategoryFactory::createOne(['name' => $CATEGORY]);
        }

        ProductFactory::createMany(100, function () {
            return [
                'category' => CategoryFactory::random(),
                'offers' => OfferFactory::new()->many(1, 5),
            ];
        });

        $manager->flush();
    }
}

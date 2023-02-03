<?php

namespace App\Factory;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Offer>
 *
 * @method        Offer|Proxy create(array|callable $attributes = [])
 * @method static Offer|Proxy createOne(array $attributes = [])
 * @method static Offer|Proxy find(object|array|mixed $criteria)
 * @method static Offer|Proxy findOrCreate(array $attributes)
 * @method static Offer|Proxy first(string $sortedField = 'id')
 * @method static Offer|Proxy last(string $sortedField = 'id')
 * @method static Offer|Proxy random(array $attributes = [])
 * @method static Offer|Proxy randomOrCreate(array $attributes = [])
 * @method static OfferRepository|RepositoryProxy repository()
 * @method static Offer[]|Proxy[] all()
 * @method static Offer[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Offer[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Offer[]|Proxy[] findBy(array $attributes)
 * @method static Offer[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Offer[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class OfferFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'description' => self::faker()->sentence(),
            'price' => self::faker()->randomFloat(2, 50, 4000),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Offer $offer): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Offer::class;
    }
}

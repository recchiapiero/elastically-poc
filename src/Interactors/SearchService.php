<?php

namespace App\Interactors;

use App\Dto\Product;
use Elastica\Query\MultiMatch;
use JoliCode\Elastically\Client;

class SearchService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(string $query): array
    {
        $searchQuery = new MultiMatch();
        $searchQuery->setFields([
            'name^5',
            'name.autocomplete',
            'category^5',
            'category.autocomplete',
        ]);
        $searchQuery->setQuery($query);
        $searchQuery->setType(MultiMatch::TYPE_MOST_FIELDS);

        $items = $this->client->getIndex('product')->search($searchQuery);
        $data = [];

        foreach ($items->getResults() as $item) {
            /** @var Product $product */
            $product = $item->getModel();
            $data[] = [
                'name' => $product->name,
                'category' => $product->category,
                'offers' => $product->offers,
            ];
        }

        return $data;
    }
}

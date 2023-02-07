<?php

namespace App\OpenSearch;

use App\Dto\Product;
use App\Repository\ProductRepository;
use Elastica\Document;
use JoliCode\Elastically\Messenger\DocumentExchangerInterface;

class DocumentExchanger implements DocumentExchangerInterface
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function fetchDocument(string $className, string $id): ?Document
    {
        if (Product::class === $className) {
            $product = $this->productRepository->find($id);

            if ($product) {
                return new Document($id, $product->toDto());
            }
        }

        return null;
    }
}

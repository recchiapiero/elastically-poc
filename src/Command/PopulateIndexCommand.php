<?php

namespace App\Command;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Elastica\Document;
use JoliCode\Elastically\Client;
use JoliCode\Elastically\IndexBuilder;
use JoliCode\Elastically\Indexer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:populate-index',
    description: 'Add a short description for your command',
)]
class PopulateIndexCommand extends Command
{
    private Client $client;
    private ProductRepository $productRepository;
    private IndexBuilder $indexBuilder;
    private Indexer $indexer;

    protected function configure(): void
    {
        $this
            ->setDescription('Build new index from scratch and populate.')
        ;
    }

    public function __construct(
        Client $client,
        ProductRepository $productRepository,
        IndexBuilder $indexBuilder,
        Indexer $indexer,
        string $name = null
    )
    {
        parent::__construct($name);
        $this->client = $client;
        $this->productRepository = $productRepository;
        $this->indexBuilder = $indexBuilder;
        $this->indexer = $indexer;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->note('Creating and populating index.');

        $index = $this->indexBuilder->createIndex('product');

        /** @var Product[] $products */
        $products = $this->productRepository->createQueryBuilder('product')->getQuery()->toIterable();

        foreach ($products as $product) {
            $this->indexer->scheduleIndex($index, new Document($product->getId(), $product->toDto()));
        }

        $this->indexer->flush();

        $this->indexBuilder->markAsLive($index, 'product');
        $this->indexBuilder->speedUpRefresh($index);
        $this->indexBuilder->purgeOldIndices('product');

        $io->success('The process finished ok.');

        return Command::SUCCESS;
    }
}

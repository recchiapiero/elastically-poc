# Elasticallt POC

A [Elastically](https://github.com/jolicode/elastically) POC using [OpenSearch](https://opensearch.org/), open-source software suite for search and [Symfony](https://symfony.com)  5.4.

## Getting Started

1. Clone the repo [Elastically POC](https://github.com/recchiapiero/elastically-poc)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up -d` (if you get an error with opensearch container about memory leak, run `sudo sysctl -w vm.max_map_count=262144`)
4. Run `docker compose exec php bin/console doctrine:migration:migrate` and answer yes
5. Run `docker compose exec php bin/console doctrine:fixtures:load` and answer yes
6. Run `docker compose exec php bin/console app:populate-index`
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334) make a search, examples: video, audio, phones.
5. Run `docker compose down --remove-orphans` to stop the Docker containers.


**Enjoy!**

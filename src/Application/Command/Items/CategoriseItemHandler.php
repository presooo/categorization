<?php

namespace App\Application\Command\Items;

use App\Application\Command\CommandHandler;
use App\Domain\WriteModel\Item;
use App\Domain\WriteModel\Repository\ItemsRepository;


/**
 * This can either be a specific categorisation handler or an Update handler that will update everything that the user provided 
 * different to the currently saved data.
 */
class CategoriseItemHandler implements CommandHandler
{

    private $repository;

    public function __construct(ItemsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CategoriseItem $command): void
    {
        $item = $this->repository->findById(ItemId::fromString($command->id));

        if (!$item instanceof Item) {
            // throw
        }

        $item->updateCategory($command->category);

        $this->repository->persist($item);
    }
}

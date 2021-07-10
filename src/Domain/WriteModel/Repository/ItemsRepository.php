<?php

namespace App\Domain\WriteModel\Repository;

use App\Domain\WriteModel\Item;

interface ItemsRepository
{

    public function findById(ItemId $id): ?Item;

    public function persist(Item $item): void;
}

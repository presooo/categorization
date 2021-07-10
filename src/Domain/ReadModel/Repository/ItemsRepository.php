<?php

namespace App\Domain\ReadModel\Repository;

use App\Domain\ReadModel\Items\ItemDataSet;
use App\Domain\ReadModel\Items\ItemFilter;

interface ItemsRepository
{
    public function items(UserId $userId, ItemFilter $filter): ItemDataSet;

    public function itemsById(ItemId ...$ids): ItemDataSet;
}

<?php

declare(strict_types=1);

namespace App\Domain\Exception;


class ItemNotFound
{
    public function __construct(ItemId $id)
    {
        parent::__construct($id);
    }
}

<?php

namespace App\Domain\Event;

use App\Domain\WriteModel\Item;

class ItemUpdated implements Event
{

    private Item $entity;
    private DateTimeImmutable $dateTime;

    public function __construct(Item $entity, DateTimeImmutable $updatedAt)
    {
        $this->entity   = $entity;
        $this->dateTime = $updatedAt;
    }

    public function item(): Item
    {
        return $this->entity;
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public static function name(): string
    {
        return __CLASS__;
    }
}

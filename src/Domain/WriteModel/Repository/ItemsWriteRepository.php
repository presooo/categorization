<?php

namespace App\Domain\WriteModel\Repository;

use App\Domain\Event\ItemUpdated;
use App\Domain\WriteModel\Item;

class ItemsWriteRepository implements ItemsRepository
{

    /** @var Database */
    private $adapter;

    /** @var Table */
    private $table;


    /** @var EventDispatcher */
    private $eventDispatcher;


    public function __construct(
        Database $adapter,
        EventDispatcher $eventDispatcher
    ) {
        $this->adapter         = $adapter;
        $this->table           = new Table('items');
        $this->eventDispatcher = $eventDispatcher;
    }

    public function findById(ItemId $id): ?Item
    {
        /** @var Database\ResultRow|null $result */
        $result = $this->adapter->selectOne(
            $this->table,
            Database\Columns::withColumns(['title', 'category', 'label']),
            new Database\Where(['id' => $id->toString()])
        );

        if ($result === null) {
            return null;
        }

        return new Item(
            ItemId::fromString($id),
            $result->column('title'),
            Category::fromDbValue($result->column('category')),
            Label::fromString($result->column('label'))
        );
    }


    public function persist(Item $item): void
    {
        $dbData = [
            'id'       => $item->id()->toString(),
            'title'    => $item->title(),
            'category' => $item->category()->toDbValue(),
            'label'    => $item->label()->toString(),
        ];

        $upsertResult = $this->adapter->upsert($this->table, new Data($dbData), new Database\Where([
            'id' => $item->id()->toString(),
        ]), 'date_created');


        $this->eventDispatcher->dispatch(new ItemUpdated($item, new DateTimeImmutable()));
    }
}

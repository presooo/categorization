<?php

namespace App\Domain\ReadModel\Repository;

use App\Domain\ReadModel\Items\ItemData;
use App\Domain\ReadModel\Items\ItemDataSet;
use App\Domain\ReadModel\Items\ItemFilter;

class ItemsReadRepository implements ItemsRepository
{

    public function __construct(Database $adapter)
    {
        $this->adapter = $adapter;
    }


    public function items(UserId $userId, ItemFilter $filter): ItemDataSet
    {
        $filterSql = $this->extractFilterSql($filter);

        $query = sprintf(
            'SELECT i.* 
                FROM items pd
                    INNER JOIN users u ON i.creator = u.id
                WHERE i.creator = :userId
                %s
            ',
            $filterSql
        );

        $statement = $this->adapter->PDOInstance()->prepare($query);

        $statement->execute([
            'userId' => $userId->toString()
        ]);

        $rows = $statement->fetchAll();

        return $this->itemsFromQueryResult($rows);
    }


    public function itemsById(ItemId ...$ids): ItemDataSet
    {
        // Very similar to the one above. They can potentially use the same code that is extracted in a separate function
        // that both this and the method above can use.
    }


    private function itemsFromQueryResult(array $rows): ItemDataSet
    {
        $items = [];
        foreach ($rows as $row) {
            $items[] = new ItemData(
                ItemId::fromString($row['id']),
                $row['title'],
                Category::fromDbValue($row['category']),
                Label::fromString($row['label'])
            );
        }

        return new ItemDataSet(...$items);
    }
}

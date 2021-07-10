<?php


namespace App\Domain\ReadModel\Items;


class ItemDataSet
{

    /** @var ItemData[] $items*/
    private $items;


    public function __construct(ItemData ...$items)
    {
        $this->items = $items;
    }


    /**
     * @return ItemData[]
     */
    public function toArray(): array
    {
        return $this->items;
    }


    public function count(): int
    {
        return count($this->items);
    }


    public function toSerialisable(): array
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = [
                'id'       => $item->id()->toString(),
                'title'    => $item->title(),
                'category' => $item->category()->serializedValue(),
                'label'    => $item->label()->toString()
            ];
        }

        return $items;
    }
}

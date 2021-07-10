<?php

namespace App\Domain\ReadModel\Items;

class ItemData
{

    private ItemId   $id;
    private string   $title;
    private Category $category;
    private Label    $label;


    public function __construct(ItemId $id, string $title, Category $category, Label $label)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->category    = $category;
        $this->label       = $label;
    }


    public function id(): ItemId
    {
        return $this->id;
    }


    public function title(): string
    {
        return $this->title;
    }


    /**
     *  Category is a value object
     */
    public function category(): Category
    {
        return $this->category;
    }


    /**
     *  Label is a value object
     */
    public function label(): Label
    {
        return $this->label;
    }
}

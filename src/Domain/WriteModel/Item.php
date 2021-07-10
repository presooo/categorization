<?php


namespace App\Domain\WriteModel;


class Item
{

    private ItemId   $id;
    private string   $title;
    private Category $category;
    private Label    $label;

    public function __construct(ItemId $id, string $title, Category $category, Label $label)
    {
        $this->id       = $id;
        $this->title    = $title;
        $this->category = $category;
        $this->label    = $label;
    }

    public function updateCategory(Category $category): void
    {
    }


    public function updateLabel(string $label): void
    {
    }
}

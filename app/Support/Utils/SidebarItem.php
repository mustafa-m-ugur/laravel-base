<?php

namespace App\Support\Utils;

class SidebarItem
{
    public $name;
    public $icon;
    public $link;
    public $id;
    public $permission;
    public $items;

    public function __construct($name, $icon, $link, $permission, $id = '', $items = [])
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->link = $link;
        $this->permission = $permission;
        $this->items = $items;
    }

    public function setNewItem($item)
    {
        $this->items = array_merge($this->items, $item);
    }

}

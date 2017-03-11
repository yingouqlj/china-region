<?php

/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 2017/3/12
 * Time: 上午2:37
 */
class Area
{
    public $id;
    public $name;
    public $title;
    public $parent_id;

    public function __construct($row)
    {
        if (!count($row) > 4) {
            throw new Exception('area row error');
        }
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->title = $row['title'];
        $this->parent_id = $row['parent_id'];
    }

    public function isCity()
    {

    }

}
<?php
namespace Yingou\ChinaRegion;
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 2017/3/12
 * Time: 上午2:37
 */
class Region
{
    const DEFAULT_PARENT_ID = 000000;
    private $id;
    private $name;
    private $title;
    private $parentId;

    public function __construct($row)
    {
        if (!count($row) > 4) {
            throw new \Exception('area row error');
        }
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->title = $row['title'];
        $this->parentId = $row['parent_id'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }


    /**
     * 取省份
     * @return $this|bool
     */
    public function province()
    {
        if ($this->parentId == self::DEFAULT_PARENT_ID) {
            return $this;
        }
        $parentArea = RegionUtils::findByCode($this->parentId);
        if ($parentArea) {
            return $parentArea->province();
        }
        return null;
    }


    public function isCity()
    {

    }

}
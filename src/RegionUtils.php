<?php
namespace Yingou\ChinaRegion;
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 2017/3/12
 * Time: 上午2:35
 */
class RegionUtils
{


    public static function findByCode($areaCode)
    {
        return self::find(intval(trim($areaCode)), 'id');
    }

    public static function findByTitle($areaName){
        return self::find(trim($areaName), 'title');
    }

    /**
     * @param $value
     * @param string $column
     * @return bool|Region
     */
    protected static function findFirst($value, $column = RegionTable::COLUMN_ID)
    {
        $row = array_search($value, array_column(RegionTable::$table, $column));
        if($row){
            return new Region(RegionTable::$table[$row]);
        }
        return false;
    }

    /**
     * @param $value
     * @param string $column
     * @return bool|Region[]
     */
    protected static function find($value, $column = RegionTable::COLUMN_ID)
    {
        $ids = array_keys(array_column(RegionTable::$table, $column), $value);
        $rows = false;
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $rows[$id] = new Region(RegionTable::$table[$id]);
            }
        }
        return $rows;
    }
}
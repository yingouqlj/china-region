<?php
/**
 * Created by PhpStorm.
 * User: yingouqlj
 * Date: 17/3/13
 * Time: 下午5:03
 */

namespace Yingou\ChinaRegion;


class ImportRegion
{
    public static function readCsv()
    {
        $csvFile = fopen(dirname(__FILE__) . "/region.csv", "r");
        while (!feof($csvFile)) {
            yield fgetcsv($csvFile);
        }
        fclose($csvFile);
    }

    public static function makeData()
    {
        $table = [];
        foreach (self::readCsv() as list($id, $title)) {
            $parentId = null;
            if (substr($id, 2, 4) == '0000') {
                $parentId = '000000';
            } elseif (substr($id, 4, 2) == '00') {
                $parentId = substr($id, 0, 2) . '0000';
            } else {
                $parentId = substr($id, 0, 4) . '00';
            }
            $name = $title;
            if (mb_strlen($title) > 2) {
                if (mb_substr($title, -2, 2) == '地区') {
                    $name = mb_substr($title, 0, -2);
                } elseif (in_array(mb_substr($title, -1, 1), ['市', '区', '县']) && !in_array(mb_substr($title, -2, 2), ['新区', '矿区', '坝区', '坡区'])) {
                    $name = mb_substr($title, 0, -1);
                }
            }
            if (empty($parentId) || empty($name)) {
                throw new \Exception($id, $title);
            }
            $table[] = [
                'id' => $id,
                'name' => $name,
                'title' => $title,
                'parent_id' => $parentId
            ];
        }
        return $table;
    }

    public static function createFile()
    {
        $tpl = <<<EOF
<?php
namespace Yingou\ChinaRegion;
class GeneratedRegion
{
    public static \$table =
EOF;
        $genFile = dirname(__FILE__) . "/GeneratedRegion.php";
        $text = $tpl . var_export(self::makeData(), true) . ';}';
        if (false !== fopen($genFile, 'w+')) {
            file_put_contents($genFile, $text);
        } else {
            throw new \Exception(__LINE__);
        }

        return $text;
    }

    public static function varDump()
    {
        foreach (self::makeData() as $row) {
            echo "['id' => {$row['id']}, 'name' => '{$row['name']}', 'title' => '{$row['title']}', 'parent_id' => {$row['parent_id']}]," . PHP_EOL;
        }
    }
}
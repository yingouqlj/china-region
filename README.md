# china-region
中国区域表（反正就是个区域代码表的数组）

中国地区的区域表
数据来源 
中华人民共和国统计局官网> 统计数据 > 统计标准 > 行政区划代码（定期我会更新）




单个查找

```php
//根据编号查询
$region=RegionUtils::findByCode(310000);

//根据名称查询
$region=RegionUtils::findByTitle(上海市);
//返回 Region 类；

//取ID 
$region->getId();
//取上级id
$region->getParentId();
//取名称
$region->getTitle();
//取省份
$region->getProvince();


```



取下级列表
```php
$regions=RegionUtils::listSubNode(310000);
//返回类型 Region[]

foreach($regions as $r){
	//取ID 
$r->getId();
//取上级id
$r->getParentId();
//取名称
$r->getTitle();
//取省份
$r->getProvince();
}



```

# china-region
中国区域表（反正就是个区域代码表的数组）

中国地区的区域表
数据来源 
中华人民共和国统计局官网> 统计数据 > 统计标准 > 行政区划代码（定期我会更新）


用法

```php
$region=RegionUtils::findByCode(310000);
//返回 Region 类；

//取名称 
$region->getName();

```

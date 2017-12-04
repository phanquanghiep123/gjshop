<?php

namespace Modules\Shop\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Models\ShippingMethod;

/**
 * Description of ShopShippingMethodsTableSeeder
 *
 * @author dinhtrong
 */
trait ShopShippingMethodsTableSeederTrait {

    public function run() {
        Model::unguard();
        $sql = "INSERT INTO `shop_shipping_methods` (`id`, `name`, `origin`, `destination`, `min_weight`, `max_weight`, `size`, `type`, `fee`, `service`, `status`, `created_at`, `updated_at`)
        VALUES
	(1,'Royal Mail 1st Class (standard)','UK','UK',101,250,'LL',2,1.27,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(2,'Royal Mail 1st Class (standard)','UK','UK',251,500,'LL',2,1.71,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(3,'Royal Mail 1st Class (standard)','UK','UK',501,750,'LL',2,2.46,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(4,'Royal Mail 1st Class (standard)','UK','UK',751,1000,'SP',2,3.30,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(5,'Royal Mail 1st Class (standard)','UK','UK',1001,2000,'SP',2,5.45,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(6,'Royal Mail 1st Class (standard)','UK','UK',751,1000,'MP',2,5.57,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(7,'Royal Mail 1st Class (standard)','UK','UK',1001,2000,'MP',2,8.80,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(8,'Royal Mail 1st Class (standard)','UK','UK',2001,5000,'MP',2,15.85,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(9,'Royal Mail 1st Class (standard)','UK','UK',5001,10000,'MP',2,21.90,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(10,'Royal Mail 1st Class (standard)','UK','UK',10001,20000,'MP',2,21.90,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(11,'Royal Mail 1st Class (standard)','UK','RW',101,250,'SP',2,5.55,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(12,'Royal Mail 1st Class (standard)','UK','RW',251,500,'SP',2,8.50,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(13,'Royal Mail 1st Class (standard)','UK','RW',501,750,'SP',2,11.20,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(14,'Royal Mail 1st Class (standard)','UK','RW',751,1000,'SP',2,13.95,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(15,'Royal Mail 1st Class (standard)','UK','RW',1001,1250,'SP',2,15.75,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(16,'Royal Mail 1st Class (standard)','UK','RW',1251,1500,'SP',2,17.65,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(17,'Royal Mail 1st Class (standard)','UK','RW',1501,1750,'SP',2,19.55,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(18,'Royal Mail 1st Class (standard)','UK','RW',1751,2000,'SP',2,21.45,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(21,'Royal Mail 1st Class (standard)','UK','EU',101,250,'LL',2,3.70,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(22,'Royal Mail 1st Class (standard)','UK','EU',251,500,'LL',2,5.15,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(23,'Royal Mail 1st Class (standard)','UK','EU',501,750,'LL',2,6.60,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(24,'Royal Mail 1st Class (standard)','UK','EU',751,1000,'SP',2,8.30,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(25,'Royal Mail 1st Class (standard)','UK','EU',1001,1250,'SP',2,9.55,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(26,'Royal Mail 1st Class (standard)','UK','EU',1251,1500,'MP',2,10.90,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(27,'Royal Mail 1st Class (standard)','UK','EU',1501,1750,'MP',2,12.25,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(28,'Royal Mail 1st Class (standard)','UK','EU',1751,2000,'MP',2,13.40,'RMFC',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(29,'Royal Mail 1st Class (Signed For)','UK','EU',101,250,'SP',2,8.65,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(30,'Royal Mail 1st Class (Signed For)','UK','EU',251,500,'SP',2,10.10,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(31,'Royal Mail 1st Class (Signed For)','UK','EU',501,750,'SP',2,11.05,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(32,'Royal Mail 1st Class (Signed For)','UK','EU',751,1000,'SP',2,12.45,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(33,'Royal Mail 1st Class (Signed For)','UK','EU',1001,1250,'SP',2,13.50,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(34,'Royal Mail 1st Class (Signed For)','UK','EU',1251,1500,'MP',2,14.90,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(35,'Royal Mail 1st Class (Signed For)','UK','EU',1501,1750,'MP',2,15.40,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(36,'Royal Mail 1st Class (Signed For)','UK','EU',1751,2000,'MP',2,16.60,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(37,'USPS standard','US','US',200,500,'SPP',2,3.88,NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(38,'Parcelforce 48h','UK','UK',20001,25000,'PARCEL',2,39.64,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(39,'Parcelforce 24h','UK','UK',20001,25000,'PARCEL',2,44.41,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(40,'Parcelforce 48h','UK','EU',20001,25000,'PARCEL',2,110.00,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(41,'Parcelforce 24h','UK','EU',20001,25000,'PARCEL',2,126.00,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(42,'Parcelforce 48h','UK','RW',20001,25000,'PARCEL',2,250.00,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(43,'Parcelforce 24h','UK','RW',20001,25000,'PARCEL',2,275.00,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(44,'Parcelforce 48h','UK','UK',1,5000,'PARCEL',2,12.98,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(45,'Parcelforce 24h','UK','UK',5001,10000,'PARCEL',2,16.40,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(46,'Parcelforce 24h','UK','UK',10001,15000,'PARCEL',2,23.14,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(47,'Parcelforce 24h','UK','UK',15000,20000,'PARCEL',2,28.51,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(48,'Parcelforce 24h','UK','UK',20001,25000,'PARCEL',2,39.64,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(49,'Parcelforce 24h','UK','UK',25001,30000,'PARCEL',2,43.78,'PF24',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(50,'Parcelforce 48h','UK','UK',1,5000,'PARCEL',2,17.48,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(51,'Parcelforce 48h','UK','UK',5001,10000,'PARCEL',2,20.90,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(52,'Parcelforce 48h','UK','UK',10001,15000,'PARCEL',2,27.64,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(53,'Parcelforce 48h','UK','UK',15000,20000,'PARCEL',2,33.01,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(54,'Parcelforce 48h','UK','UK',20001,25000,'PARCEL',2,44.14,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(55,'Parcelforce 48h','UK','UK',25001,30000,'PARCEL',2,48.28,'PF48',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(56,'Royal Mail 1st Class (Signed For)','UK','UK',1,1000,'SP',2,4.40,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(57,'Royal Mail 1st Class (Signed For)','UK','UK',1001,2000,'SP',2,4.40,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(58,'Royal Mail 1st Class (Signed For)','UK','UK',1,1000,'MP',2,6.70,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(59,'Royal Mail 1st Class (Signed For)','UK','UK',1001,2000,'MP',2,10.00,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(60,'Royal Mail 1st Class (Signed For)','UK','UK',2001,5000,'MP',2,16.95,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(61,'Royal Mail 1st Class (Signed For)','UK','UK',5001,10000,'MP',2,23.00,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(62,'Royal Mail 1st Class (Signed For)','UK','UK',10001,20000,'MP',2,23.00,'RMSF',1,'2016-04-09 07:02:49','2016-04-25 07:48:42');
        ";
        \DB::statement($sql);
    }

}

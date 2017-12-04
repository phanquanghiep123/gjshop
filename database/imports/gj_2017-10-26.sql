# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.33-0ubuntu0.14.04.1)
# Database: gj
# Generation Time: 2017-10-26 17:38:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table affiliate_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `affiliate_products`;

CREATE TABLE `affiliate_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table article_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_category`;

CREATE TABLE `article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_category_article_id_foreign` (`article_id`),
  CONSTRAINT `article_category_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `article_category` WRITE;
/*!40000 ALTER TABLE `article_category` DISABLE KEYS */;

INSERT INTO `article_category` (`id`, `article_id`, `category_id`, `created_at`, `updated_at`)
VALUES
	(1,1,3,NULL,NULL),
	(2,2,3,NULL,NULL);

/*!40000 ALTER TABLE `article_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_product`;

CREATE TABLE `article_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `article_product` WRITE;
/*!40000 ALTER TABLE `article_product` DISABLE KEYS */;

INSERT INTO `article_product` (`id`, `article_id`, `product_id`, `created_at`, `updated_at`)
VALUES
	(1,1,1,NULL,NULL),
	(2,1,2,NULL,NULL),
	(3,1,4,NULL,NULL),
	(4,2,4,NULL,NULL),
	(5,2,1,NULL,NULL),
	(6,2,2,NULL,NULL),
	(7,1,3,NULL,NULL),
	(8,1,7,NULL,NULL);

/*!40000 ALTER TABLE `article_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revised_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `revised_content` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `video_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_placeholder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '2',
  `approved` tinyint(4) NOT NULL DEFAULT '2',
  `approved_date` datetime DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;

INSERT INTO `articles` (`id`, `title`, `revised_title`, `list_image`, `share_image`, `slug`, `user_id`, `description`, `content`, `revised_content`, `meta_keywords`, `meta_description`, `video_link`, `video_placeholder`, `status`, `approved`, `approved_date`, `approved_by`, `post_date`, `created_at`, `updated_at`)
VALUES
	(1,'Things to do with Pink Himalayan Salt','','/uploads/articles/thingtodowithhimalayansalt/things-to-do-with-himalayan-salt_md.jpg','/uploads/articles/thingtodowithhimalayansalt/things-to-do-with-himalayan-salt_share.jpg','things-to-do-with-pink-himalayan-salt',1,'<p>Pink Himalayan salt has been around for millions of years however some of us have only just heard about it! Whether you’re a regular user or just using it for the first time, here are a few ways to incorporate it into your daily routine.</p>','<p><img src=\"http://nurturedforliving.com/uploads/articles/thingtodowithhimalayansalt/things-to-do-with-himalayan-salt.jpg\" alt=\"thing to do with himalayan salt\" class=\"img-border img-responsive\"></p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p>Pink Himalayan salt has been around for millions of years however some of us have only just heard about it! Whether you’re a regular user or just using it for the first time, here are a few ways to incorporate it into your daily routine.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h3>Get Clearer Skin:</h3>\r\n<p>Pink Himalayan crystal salt can be remarkably beneficial for your skin. Whether you suffer from acne, psoriasis or just ageing, the nutrients in the salt can help to alleviate skin problems. Some experts recommend using the salt as a treatment for insect bites, blisters, and dry skin. </p><p>Himalayan salt contains;&nbsp;<br><b>Zinc</b> to aid healing and reduce the risk of scarring<br><b>Iodine</b> to increase oxygen and aid in healing any skin infections<br><b>Chromium</b> which reduces infection&nbsp;<br><b>Sulphur</b> which helps to keep the skin smooth and clear.</p>\r\n\r\n<p><em>With regular use over time you should soon see a difference!</em></p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h3>Improve Dental Hygiene:</h3>\r\n<p>Dental hygiene is considered to be vital to the sanitation and cleanliness of the body. There are even threads of evidence linking gum disease with an increased risk of developing cardiovascular disease. While there are lots of different toothpaste brands around, claiming to reduce cavities and tartar, one of the most effective ways to improve your dental hygiene is to brush your teeth with pink Himalayan salt. If you choose to use fine salt or make a brine solution, you should see an improvement in the health of your teeth and gums. The salt has been used in the Himalayas as a way to clean the teeth and prevent gingivitis for hundreds of years. Himalayan salt contains potassium, which reduces the risk of gums bleeding and calcium to strengthen and whiten the teeth.</p> \r\n\r\n<hr class=\"dashed\">\r\n\r\n<h3>Clear Foot Fungus:</h3>\r\n<p>Foot fungus can be an embarrassing condition. If you are prone to athlete’s foot or another form of foot fungus, the discolouration, and thickening of the toenails, cracked skin and odour can make you reluctant to take off your socks in public. However, by creating a soak with pink Himalayan crystal salt, purified water, and white vinegar, you can use this on a regular basis to restore your foot health. The vinegar and salt will create an inhospitable environment while the Himalayan salt provides vital nutrients to aid healing and reduce infection. In a couple of weeks of regular use, you should see your toenails and skin restored to health.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h3>Detoxify:</h3>\r\n<p>In today’s environment, our bodies are attacked by toxins from all directions! Well, when you dissolve Pink Himalayan salt into your bathtub, it not only releases the nutrients in the salt our bodies need, but it also creates an ionic solution that helps to draw toxins out of the skin. After your salt bath, you\'ll get a good nights sleep and eventually feel refreshed and energised.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p>These are just a few ways we use Pink Himalayan salt, let us know how you use yours.</p>\r\n\r\n\r\n','','clearer skin, improved dental hygiene, clear foot fungus, detoxify','Great things to do with Pink Himalayan Salt','','',1,1,'2016-12-11 16:47:07',1,'2016-12-11','2016-12-11 16:40:34','2017-07-20 10:28:46'),
	(2,'Pink Himalayan Crystal Salt or Regular Table Salt! You decide.','','/uploads/articles/81/things-to-do-with-himalayan-salt.jpg',NULL,'pink-himalayan-crystal-salt-or-regular-table-salt-you-decide',1,'<p>Pink Himalayan Crystal Salt is considered to be the purest form of salt on earth. Many of us have been warned/told of the dangers of consuming too much salt. However, Himalayan salt contains over 84 different trace minerals in their natural state, in addition to not containing any added chemicals, pollutants, and contaminants, there are some very good reasons to include it in your diet.</p>','<h3>Pink Himalayan Crystal Salt:</h3>\r\n\r\n<p>Pink Himalayan Crystal Salt is considered to be the purest form of salt on earth. Many of us have been warned/told of the dangers of consuming too much salt. However, Himalayan salt contains over 84 different trace minerals in their natural state, in addition to not containing any added chemicals, pollutants, and contaminants, there are some very good reasons to include it in your diet. </p>\r\n\r\n<p>Pink Himalayan Crystal Salt is mined from the Himalayan foothills, and it has been preserved for 250 million years under ice, snow and lava. This form of salt is linked with numerous health benefits including improving digestion and lowering blood pressure. The high iron content can also increase oxygenation and increase the red blood cell count, which helps to rejuvenate cells, improve tissue and bone strength and increase cognitive function. </p>\r\n\r\n\r\n\r\n<h3><br>How the Body Responds to Pink Himalayan Crystal Salt:</h3>\r\n\r\n<p>Pink Himalayan Crystal Salt stimulates the salivary glands and other essential digestive enzymes the moment it is ingested. This not only ensures proper digestion but encourages the PH balance in the stomach and body. This can help to improve the absorption of nutrients and reduce acid reflux.</p> \r\n\r\n<p>Since the salt crystals are preserved in a true form, Himalayan salt is highly absorbable and can be easily recognised by the body. The mineral content encourages detoxification in the body, strengthening immunity and rejuvenating the cells in the body. Himalayan salt is also naturally antibacterial and antimicrobial which helps to destroy potentially harmful bacteria and germs, encouraging the healing of infections faster and preventing colds or flu. </p>\r\n\r\n<p>It is also linked to reducing asthma symptoms and decongestion of the sinuses. Additionally, Himalayan salt is lower in sodium than table salt, reducing water retention and blood pressure caused by table salt. </p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>So, how does it differ from regular table salt?</h2>\r\n\r\n\r\n<h3><br>Regular Table Salt:</h3>\r\n\r\n<p>Regular table salt can be detrimental to health. This form of salt is produced by heating sea salt to a temperature of 1200 degrees Fahrenheit. This heating process strips the salt of all natural minerals. It is then bleached, before being combined with anti-caking agents and iodine. </p>\r\n\r\n<p>Iodine was introduced into table salt in the 1920s when it was determined that it was necessary to correct iodine deficiency in the population. This supplementation was needed to prevent cretinism, goitre, thyroid malfunction and other health effects of low iodine intake. Unfortunately, this two percent supplementation is achieved at the cost of toxic chemicals being introduced into the body. </p>\r\n\r\n<p>Typical table salt contains 98% sodium chloride with 2% bleach, synthetic iodine, and other unnatural chemicals. The anti-caking agents and preservatives added to table salt are toxic and can have terrible effects on health.  \r\n\r\n</p><p>Over 90% of processed foods contain more than the daily recommended amount of sodium. According to the World Health Organisation, we should limit our sodium consumption to 2000 milligrams each day. This means that when you add table salt to your foods, you will be increasing your likelihood of developing oedema, high blood pressure, weight gain and imbalance in the body. </p>\r\n\r\n<p>Table salt particles are totally isolated, which taxes the body in the effort to efficiently metabolise it. This causes disruption in your fluid balance and could lead to discomfort, chronic inflammation and an increased risk of multiple diseases. If your body is unable to eliminate all of this sodium, it will be forced to use 23 times the weight of water to neutralise it. This water is drawn from living cells, which can lead to dehydration, rheumatism, kidney stones and cellulite.</p> \r\n\r\n<p>Each teaspoon of table salt exceeds the daily recommended limit of sodium by 16% since it contains 2325 milligrams of sodium. Research has shown that average Americans consume between 6,000 and 10,000 milligrams of sodium each day, which could explain why almost a third of the population suffers from some form of hypertension. Additionally, the anti-caking agents which prevent the salt from being dissolved in the package, also prevent it from being dissolved inside the body. This means that excess salt can be deposited in the tissues and organs, causing severe health issues over time. </p>','','Pink Himalayan Crystal Salt, Regular Table Salt','Pink Himalayan Crystal Salt vs Regular Table Salt',NULL,'',2,1,NULL,NULL,NULL,'2016-12-12 14:56:19','2016-12-16 17:59:12');

/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table brands
# ------------------------------------------------------------

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;

INSERT INTO `brands` (`id`, `name`, `meta_keywords`, `meta_description`, `slug`, `brand_logo`, `description`, `content`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Nurtured For Living',NULL,NULL,'nurtured-for-living','/uploads/brands/nfl.jpg','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','<p>Through Nurtured For Living  we have released several of Europes top brands.</p>',1,'2016-03-10 11:39:37','2016-08-30 19:25:43'),
	(2,'Lion\'s Mane',NULL,NULL,'lions-mane','uploads/brands/lions-mane.jpg','<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','<p>Through Nurtured For Living  we have released several of Europes top brands.</p>',2,'2016-03-10 11:39:37',NULL);

/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(10) unsigned DEFAULT NULL,
  `show_in_menu` tinyint(1) NOT NULL DEFAULT '1',
  `list_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `parent_id`, `meta_keywords`, `meta_description`, `name`, `position`, `show_in_menu`, `list_image`, `status`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,0,'','','Natural Health',1,1,NULL,1,'natural-health','Queen, the royal children; there were TWO little shrieks, and more sounds of broken glass.','2016-02-27 12:02:59','2016-12-10 00:27:32'),
	(2,0,'','','Natural Home',2,1,NULL,1,'natural-home','So she sat still and said \'No, never\') \'--so you can find them.\' As she said this, she came upon a little sharp bark just over her head on her spectacles, and began smoking again. This time there.','2016-02-27 12:23:18','2016-12-10 00:29:16'),
	(3,1,'Himalayan Crystal Salt','Himalayan Crystal Salt','Pink Himalayan Salt',1,1,'/uploads/articles/thingtodowithhimalayansalt/things-to-do-with-himalayan-salt_md.jpg',1,'pink-himalayan-salt','Himalayan Crystal Salt','2016-09-16 21:14:40','2017-07-21 15:39:53');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table certificates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `certificates`;

CREATE TABLE `certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `certification_board` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;

INSERT INTO `certificates` (`id`, `certification_board`, `file`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'National Health Institute Islamabad',NULL,1,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(2,'Pakistan Council of Scientific and Industrial Research',NULL,1,'2016-03-10 11:39:40','2016-03-10 11:39:40');

/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table competitions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `competitions`;

CREATE TABLE `competitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bg_colour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `winner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prize_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `competitions` WRITE;
/*!40000 ALTER TABLE `competitions` DISABLE KEYS */;

INSERT INTO `competitions` (`id`, `name`, `slug`, `list_image`, `image_alt`, `bg_colour`, `start_date`, `end_date`, `description`, `winner`, `country`, `prize_image`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Natural Salt Lamp Competition','natural-salt-lamp-competition','salt_lamp_comp.jpg','Win a salt lamp competition','#f2db89','2016-03-15 13:12:03','2016-07-30 13:12:03','<p>Here&#39;s your opportunuity to win a beautyful Nurtured For Living natural salt lamp! If you don&#39;t already know about <a href=\"http://localhost:19107/nurtured-for-living/public/natural-health/beauty-body-care/how-to-use-a-pink-himalayan-salt-lamp\">their health benefits</a> then you&#39;re missing out. Enter now and get your&nbsp;chance&nbsp;help improve your health and wellbeing, <strong>absolutely FREE</strong>.&nbsp;</p>\r\n\r\n<p><span style=\"color:#2F4F4F\"><strong>To enter:</strong></span> Just get 2 friends to like our facebook page and you&#39;ll be entered into our draw.</p>\r\n','Micah Angus 55','Saudi Arabia 55','gdfgdfg',1,'2016-03-15 13:12:03','2016-03-19 16:45:48');

/*!40000 ALTER TABLE `competitions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_tag`;

CREATE TABLE `content_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `resource_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `content_tag` WRITE;
/*!40000 ALTER TABLE `content_tag` DISABLE KEYS */;

INSERT INTO `content_tag` (`id`, `resource_id`, `tag_id`, `resource_type`, `created_at`, `updated_at`)
VALUES
	(1,2,1,'',NULL,NULL),
	(2,1,1,'',NULL,NULL);

/*!40000 ALTER TABLE `content_tag` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contributors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contributors`;

CREATE TABLE `contributors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `border_colour` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mini_bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `google` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `vimeo` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contributors` WRITE;
/*!40000 ALTER TABLE `contributors` DISABLE KEYS */;

INSERT INTO `contributors` (`id`, `user_id`, `slug`, `title`, `border_colour`, `bio_image`, `mini_bio`, `bio`, `facebook`, `linkedin`, `google`, `twitter`, `website`, `youtube`, `vimeo`, `status`, `created_at`, `updated_at`)
VALUES
	(1,19,'umm-layla','Woman\'s Wellness Coach','#FAB0CA','uploads/contributors/umm-layla.jpg','I am a Life, Birth and Breastfeeding Coach but in short I’m a Woman\'s Wellness Coach. I  love to help women connect with their true inner-selves aiding them to form meaningful and loving relationships.','\r<p>Hi, I’m Salma, Umm Layla, I am a Life, Birth and Breastfeeding Coach but in short I’m a Woman\'s Wellness Coach. I  love to help women connect with their true inner-selves aiding them to form meaningful and loving relationships.</p>\r\r<p>Along my personal and professional journey, I have discovered that wellness is not just about what you eat, but it is also about what you feed your body, mind and soul.</p>\r\r<p>I began as a Doula because I felt a desire to empower women to achieve the birth that they wanted. I then went on to become a Childbirth Educator after realising women didn\'t fully understand the choices available to them and limited themselves due to lack of knowledge.</p>\r\r<p>I continued my studies to become a Breastfeeding Counsellor to offer support in their postpartum but recognised women needed counselling and support in more than just breastfeeding. </p>\r\r<p>Working in my community and seeing the health crisis that was going on I become drawn into becoming a Health Coach. I started with my family and continued to do so, alongside other women and even though we made changes it wasn\'t enough to keep us going. </p>\r\r<p>Through health coaching, I discovered Primary foods, our ultimate source of energy and recognised that health and wellness is more than just about what we eat and how much exercise we do. Our lives have so much more meaning than that and so came the Life Coaching course. </p>\r\r<p>So I return full circle with helping women to achieve the lifestyle, the happiness and contentment that they deserve from their births, marriages and professional lives. I want women to be in a good state of body, spirit and mind so that they can make conscious, informed choices in their lives and get rid of the baggage that has been holding them back. </p>\r\r<p>For those of you who are ready to really have a deep look into your life, tackle some of the issues that you have been stopping you progressing and ready to take responsibility for your actions then Wellness coaching is definitely for you. Don\'t be shy to finally meet yourself, let\'s move your life in a better direction starting today.\r</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL);

/*!40000 ALTER TABLE `contributors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(44) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_name` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_symbol_1` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`id`, `name`, `nationality`, `currency_code`, `currency_name`, `currency_symbol_1`, `flag`, `created_at`, `updated_at`)
VALUES
	(1,'Afghanistan','Afghan','AFN','Afghani','؋','AF.png',NULL,NULL),
	(2,'Albania','Albanian','ALL','Lek','Lek','AL.png',NULL,NULL),
	(3,'Algeria','Algerian','DZD','Dinar',NULL,'DZ.png',NULL,NULL),
	(4,'American Samoa','American Samoan','USD','Dollar','$','AS.png',NULL,NULL),
	(5,'Andorra','Andorran','EUR','Euro','€','AD.png',NULL,NULL),
	(6,'Angola','Angolan','AOA','Kwanza','Kz','AO.png',NULL,NULL),
	(7,'Anguilla','Anguillan','XCD','Dollar','$','AI.png',NULL,NULL),
	(8,'Antarctica','Antarctican','','',NULL,'AQ.png',NULL,NULL),
	(9,'Antigua and Barbuda','Antiguans, Barbudans','XCD','Dollar','$','AG.png',NULL,NULL),
	(10,'Argentina','Argentinean','ARS','Peso','$','AR.png',NULL,NULL),
	(11,'Armenia','Armenian','AMD','Dram',NULL,'AM.png',NULL,NULL),
	(12,'Aruba','Aruban','AWG','Guilder','ƒ','AW.png',NULL,NULL),
	(13,'Australia','Australian','AUD','Dollar','$','AU.png',NULL,NULL),
	(14,'Austria','Austrian','EUR','Euro','€','AT.png',NULL,NULL),
	(15,'Azerbaijan','Azerbaijani','AZN','Manat','ман','AZ.png',NULL,NULL),
	(16,'Bahamas','Bahamian','BSD','Dollar','$','BS.png',NULL,NULL),
	(17,'Bahrain','Bahraini','BHD','Dinar',NULL,'BH.png',NULL,NULL),
	(18,'Bangladesh','Bangladeshi','BDT','Taka',NULL,'BD.png',NULL,NULL),
	(19,'Barbados','Barbadian','BBD','Dollar','$','BB.png',NULL,NULL),
	(20,'Belarus','Belarusian','BYR','Ruble','p.','BY.png',NULL,NULL),
	(21,'Belgium','Belgian','EUR','Euro','€','BE.png',NULL,NULL),
	(22,'Belize','Belizean','BZD','Dollar','BZ$','BZ.png',NULL,NULL),
	(23,'Benin','Beninese','XOF','Franc',NULL,'BJ.png',NULL,NULL),
	(24,'Bermuda','Bermudian','BMD','Dollar','$','BM.png',NULL,NULL),
	(25,'Bhutan','Bhutanese','BTN','Ngultrum',NULL,'BT.png',NULL,NULL),
	(26,'Bolivia','Bolivian','BOB','Boliviano','$b','BO.png',NULL,NULL),
	(27,'Bosnia and Herzegovina','Bosnian, Herzegovinian','BAM','Marka','KM','BA.png',NULL,NULL),
	(28,'Botswana','Motswana (singular), Batswana (plural)','BWP','Pula','P','BW.png',NULL,NULL),
	(29,'Bouvet Island','Bouvet Island','NOK','Krone','kr','BV.png',NULL,NULL),
	(30,'Brazil','Brazilian','BRL','Real','R$','BR.png',NULL,NULL),
	(31,'British Indian Ocean Territory','British Indian Ocean Territory','USD','Dollar','$','IO.png',NULL,NULL),
	(32,'British Virgin Islands','British Virgin Islander','USD','Dollar','$','VG.png',NULL,NULL),
	(33,'Brunei','Bruneian','BND','Dollar','$','BN.png',NULL,NULL),
	(34,'Bulgaria','Bulgarian','BGN','Lev','лв','BG.png',NULL,NULL),
	(35,'Burkina Faso','Burkinabe','XOF','Franc',NULL,'BF.png',NULL,NULL),
	(36,'Burundi','Burundian','BIF','Franc',NULL,'BI.png',NULL,NULL),
	(37,'Cambodia','Cambodian','KHR','Riels','៛','KH.png',NULL,NULL),
	(38,'Cameroon','Cameroonian','XAF','Franc','FCF','CM.png',NULL,NULL),
	(39,'Canada','Canadian','CAD','Dollar','$','CA.png',NULL,NULL),
	(40,'Cape Verde','Cape Verdian','CVE','Escudo',NULL,'CV.png',NULL,NULL),
	(41,'Cayman Islands','Caymanian','KYD','Dollar','$','KY.png',NULL,NULL),
	(42,'Central African Republic','Central African','XAF','Franc','FCF','CF.png',NULL,NULL),
	(43,'Chad','Chadian','XAF','Franc',NULL,'TD.png',NULL,NULL),
	(44,'Chile','Chilean','CLP','Peso',NULL,'CL.png',NULL,NULL),
	(45,'China','Chinese','CNY','Yuan Renminbi','¥','CN.png',NULL,NULL),
	(46,'Christmas Island','Christmas Islander','AUD','Dollar','$','CX.png',NULL,NULL),
	(47,'Cocos Islands','Cocos Islander','AUD','Dollar','$','CC.png',NULL,NULL),
	(48,'Colombia','Colombian','COP','Peso','$','CO.png',NULL,NULL),
	(49,'Comoros','Comoran','KMF','Franc',NULL,'KM.png',NULL,NULL),
	(50,'Cook Islands','Cook Islands','NZD','Dollar','$','CK.png',NULL,NULL),
	(51,'Costa Rica','Costa Rican','CRC','Colon','₡','CR.png',NULL,NULL),
	(52,'Croatia','Croatian','HRK','Kuna','kn','HR.png',NULL,NULL),
	(53,'Cuba','Cuban','CUP','Peso','₱','CU.png',NULL,NULL),
	(54,'Cyprus','Cypriot','CYP','Pound',NULL,'CY.png',NULL,NULL),
	(55,'Czech Republic','Czech','CZK','Koruna','K','CZ.png',NULL,NULL),
	(56,'Democratic Republic of the Congo','Congolese','CDF','Franc',NULL,'CD.png',NULL,NULL),
	(57,'Denmark','Danish','DKK','Krone','kr','DK.png',NULL,NULL),
	(58,'Djibouti','Djibouti','DJF','Franc',NULL,'DJ.png',NULL,NULL),
	(59,'Dominica','Dominican','XCD','Dollar','$','DM.png',NULL,NULL),
	(60,'Dominican Republic','Dominican','DOP','Peso','RD$','DO.png',NULL,NULL),
	(61,'East Timor','East Timorese','USD','Dollar','$','TL.png',NULL,NULL),
	(62,'Ecuador','Ecuadorean','USD','Dollar','$','EC.png',NULL,NULL),
	(63,'Egypt','Egyptian','EGP','Pound','£','EG.png',NULL,NULL),
	(64,'El Salvador','Salvadoran','SVC','Colone','$','SV.png',NULL,NULL),
	(65,'Equatorial Guinea','Equatorial Guinean','XAF','Franc','FCF','GQ.png',NULL,NULL),
	(66,'Eritrea','Eritrean','ERN','Nakfa','Nfk','ER.png',NULL,NULL),
	(67,'Estonia','Estonian','EEK','Kroon','kr','EE.png',NULL,NULL),
	(68,'Ethiopia','Ethiopian','ETB','Birr',NULL,'ET.png',NULL,NULL),
	(69,'Falkland Islands','Falkland Islands','FKP','Pound','£','FK.png',NULL,NULL),
	(70,'Faroe Islands','Faroese','DKK','Krone','kr','FO.png',NULL,NULL),
	(71,'Fiji','Fijian','FJD','Dollar','$','FJ.png',NULL,NULL),
	(72,'Finland','Finnish','EUR','Euro','€','FI.png',NULL,NULL),
	(73,'France','French','EUR','Euro','€','FR.png',NULL,NULL),
	(74,'French Guiana','French Guianese','EUR','Euro','€','GF.png',NULL,NULL),
	(75,'French Polynesia','French Polynesian','XPF','Franc',NULL,'PF.png',NULL,NULL),
	(76,'French Southern Territories','French Southern Territories','EUR','Euro  ','€','TF.png',NULL,NULL),
	(77,'Gabon','Gabonese','XAF','Franc','FCF','GA.png',NULL,NULL),
	(78,'Gambia','Gambian','GMD','Dalasi','D','GM.png',NULL,NULL),
	(79,'Georgia','Georgian','GEL','Lari',NULL,'GE.png',NULL,NULL),
	(80,'Germany','German','EUR','Euro','€','DE.png',NULL,NULL),
	(81,'Ghana','Ghanaian','GHC','Cedi','¢','GH.png',NULL,NULL),
	(82,'Gibraltar','Gibraltarian','GIP','Pound','£','GI.png',NULL,NULL),
	(83,'Greece','Greek','EUR','Euro','€','GR.png',NULL,NULL),
	(84,'Greenland','Greenland','DKK','Krone','kr','GL.png',NULL,NULL),
	(85,'Grenada','Grenadian','XCD','Dollar','$','GD.png',NULL,NULL),
	(86,'Guadeloupe','Guadeloupian','EUR','Euro','€','GP.png',NULL,NULL),
	(87,'Guam','Guam','USD','Dollar','$','GU.png',NULL,NULL),
	(88,'Guatemala','Guatemalan','GTQ','Quetzal','Q','GT.png',NULL,NULL),
	(89,'Guinea','Guinean','GNF','Franc',NULL,'GN.png',NULL,NULL),
	(90,'Guinea-Bissau','Guinea-Bissauan','XOF','Franc',NULL,'GW.png',NULL,NULL),
	(91,'Guyana','Guyanese','GYD','Dollar','$','GY.png',NULL,NULL),
	(92,'Haiti','Haitian','HTG','Gourde','G','HT.png',NULL,NULL),
	(93,'Heard Island and McDonald Islands','Heard Island and McDonald Islands','AUD','Dollar','$','HM.png',NULL,NULL),
	(94,'Honduras','Honduran','HNL','Lempira','L','HN.png',NULL,NULL),
	(95,'Hong Kong','Chinese','HKD','Dollar','$','HK.png',NULL,NULL),
	(96,'Hungary','Hungarian','HUF','Forint','Ft','HU.png',NULL,NULL),
	(97,'Iceland','Icelander','ISK','Krona','kr','IS.png',NULL,NULL),
	(98,'India','Indian','INR','Rupee','₨','IN.png',NULL,NULL),
	(99,'Indonesia','Indonesian','IDR','Rupiah','Rp','ID.png',NULL,NULL),
	(100,'Iran','Iranian','IRR','Rial','﷼','IR.png',NULL,NULL),
	(101,'Iraq','Iraqi','IQD','Dinar',NULL,'IQ.png',NULL,NULL),
	(102,'Ireland','Irish','EUR','Euro','€','IE.png',NULL,NULL),
	(103,'Israel','Israeli','ILS','Shekel','₪','IL.png',NULL,NULL),
	(104,'Italy','Italian','EUR','Euro','€','IT.png',NULL,NULL),
	(105,'Ivory Coast','Ivory Coast','XOF','Franc',NULL,'CI.png',NULL,NULL),
	(106,'Jamaica','Jamaican','JMD','Dollar','$','JM.png',NULL,NULL),
	(107,'Japan','Japanese','JPY','Yen','¥','JP.png',NULL,NULL),
	(108,'Jordan','Jordanian','JOD','Dinar',NULL,'JO.png',NULL,NULL),
	(109,'Kazakhstan','Kazakhstani','KZT','Tenge','лв','KZ.png',NULL,NULL),
	(110,'Kenya','Kenyan','KES','Shilling',NULL,'KE.png',NULL,NULL),
	(111,'Kiribati','I-Kiribati','AUD','Dollar','$','KI.png',NULL,NULL),
	(112,'Kuwait','Kuwaiti','KWD','Dinar',NULL,'KW.png',NULL,NULL),
	(113,'Kyrgyzstan','Kyrgyzstani','KGS','Som','лв','KG.png',NULL,NULL),
	(114,'Laos','Laotian','LAK','Kip','₭','LA.png',NULL,NULL),
	(115,'Latvia','Latvian','LVL','Lat','Ls','LV.png',NULL,NULL),
	(116,'Lebanon','Lebanese','LBP','Pound','£','LB.png',NULL,NULL),
	(117,'Lesotho','Mosotho','LSL','Loti','L','LS.png',NULL,NULL),
	(118,'Liberia','Liberian','LRD','Dollar','$','LR.png',NULL,NULL),
	(119,'Libya','Libyan','LYD','Dinar',NULL,'LY.png',NULL,NULL),
	(120,'Liechtenstein','Liechtensteiner','CHF','Franc','CHF','LI.png',NULL,NULL),
	(121,'Lithuania','Lithuanian','LTL','Litas','Lt','LT.png',NULL,NULL),
	(122,'Luxembourg','Luxembourger','EUR','Euro','€','LU.png',NULL,NULL),
	(123,'Macao','Macanese','MOP','Pataca','MOP','MO.png',NULL,NULL),
	(124,'Macedonia','Macedonian','MKD','Denar','ден','MK.png',NULL,NULL),
	(125,'Madagascar','Malagasy','MGA','Ariary',NULL,'MG.png',NULL,NULL),
	(126,'Malawi','Malawian','MWK','Kwacha','MK','MW.png',NULL,NULL),
	(127,'Malaysia','Malaysian','MYR','Ringgit','RM','MY.png',NULL,NULL),
	(128,'Maldives','Maldivan','MVR','Rufiyaa','Rf','MV.png',NULL,NULL),
	(129,'Mali','Malian','XOF','Franc',NULL,'ML.png',NULL,NULL),
	(130,'Malta','Maltese','MTL','Lira',NULL,'MT.png',NULL,NULL),
	(131,'Marshall Islands','Marshallese','USD','Dollar','$','MH.png',NULL,NULL),
	(132,'Martinique','Martiniquais','EUR','Euro','€','MQ.png',NULL,NULL),
	(133,'Mauritania','Mauritanian','MRO','Ouguiya','UM','MR.png',NULL,NULL),
	(134,'Mauritius','Mauritian','MUR','Rupee','₨','MU.png',NULL,NULL),
	(135,'Mayotte','Mayotte','EUR','Euro','€','YT.png',NULL,NULL),
	(136,'Mexico','Mexican','MXN','Peso','$','MX.png',NULL,NULL),
	(137,'Micronesia','Micronesia','USD','Dollar','$','FM.png',NULL,NULL),
	(138,'Moldova','Moldovan','MDL','Leu',NULL,'MD.png',NULL,NULL),
	(139,'Monaco','Monegasque','EUR','Euro','€','MC.png',NULL,NULL),
	(140,'Mongolia','Mongolian','MNT','Tugrik','₮','MN.png',NULL,NULL),
	(141,'Montserrat','Montserratian','XCD','Dollar','$','MS.png',NULL,NULL),
	(142,'Morocco','Moroccan','MAD','Dirham',NULL,'MA.png',NULL,NULL),
	(143,'Mozambique','Mozambican','MZN','Meticail','MT','MZ.png',NULL,NULL),
	(144,'Myanmar','Burmese','MMK','Kyat','K','MM.png',NULL,NULL),
	(145,'Namibia','Namibian','NAD','Dollar','$','NA.png',NULL,NULL),
	(146,'Nauru','Nauruan','AUD','Dollar','$','NR.png',NULL,NULL),
	(147,'Nepal','Nepalese','NPR','Rupee','₨','NP.png',NULL,NULL),
	(148,'Netherlands','Dutch','EUR','Euro','€','NL.png',NULL,NULL),
	(149,'Netherlands Antilles','Dutch Antillean','ANG','Guilder','ƒ','AN.png',NULL,NULL),
	(150,'New Caledonia','New Caledonian','XPF','Franc',NULL,'NC.png',NULL,NULL),
	(151,'New Zealand','New Zealander','NZD','Dollar','$','NZ.png',NULL,NULL),
	(152,'Nicaragua','Nicaraguan','NIO','Cordoba','C$','NI.png',NULL,NULL),
	(153,'Niger','Nigerien','XOF','Franc',NULL,'NE.png',NULL,NULL),
	(154,'Nigeria','Nigerian','NGN','Naira','₦','NG.png',NULL,NULL),
	(155,'Niue','Niueans','NZD','Dollar','$','NU.png',NULL,NULL),
	(156,'Norfolk Island','Norfolk Island','AUD','Dollar','$','NF.png',NULL,NULL),
	(157,'North Korea','Korean','KPW','Won','₩','KP.png',NULL,NULL),
	(158,'Northern Mariana Islands','Northern Mariana Islands','USD','Dollar','$','MP.png',NULL,NULL),
	(159,'Norway','Norwegian','NOK','Krone','kr','NO.png',NULL,NULL),
	(160,'Oman','Omani','OMR','Rial','﷼','OM.png',NULL,NULL),
	(161,'Pakistan','Pakistani','PKR','Rupee','₨','PK.png',NULL,NULL),
	(162,'Palau','Palauan','USD','Dollar','$','PW.png',NULL,NULL),
	(163,'Palestinian Territory','Palestinian','ILS','Shekel','₪','PS.png',NULL,NULL),
	(164,'Panama','Panamanian','PAB','Balboa','B/.','PA.png',NULL,NULL),
	(165,'Papua New Guinea','Papua New Guinean','PGK','Kina',NULL,'PG.png',NULL,NULL),
	(166,'Paraguay','Paraguayan','PYG','Guarani','Gs','PY.png',NULL,NULL),
	(167,'Peru','Peruvian','PEN','Sol','S/.','PE.png',NULL,NULL),
	(168,'Philippines','Filipino','PHP','Peso','Php','PH.png',NULL,NULL),
	(169,'Pitcairn','Pitcairn','NZD','Dollar','$','PN.png',NULL,NULL),
	(170,'Poland','Polish','PLN','Zloty','z','PL.png',NULL,NULL),
	(171,'Portugal','Portuguese','EUR','Euro','€','PT.png',NULL,NULL),
	(172,'Puerto Rico','Puerto Rican','USD','Dollar','$','PR.png',NULL,NULL),
	(173,'Qatar','Qatari','QAR','Rial','﷼','QA.png',NULL,NULL),
	(174,'Republic of the Congo','Congolese','XAF','Franc','FCF','CG.png',NULL,NULL),
	(175,'Reunion','Reunion','EUR','Euro','€','RE.png',NULL,NULL),
	(176,'Romania','Romanian','RON','Leu','lei','RO.png',NULL,NULL),
	(177,'Russia','Russian','RUB','Ruble','руб','RU.png',NULL,NULL),
	(178,'Rwanda','Rwandan','RWF','Franc',NULL,'RW.png',NULL,NULL),
	(179,'Saint Helena','Saint Helena','SHP','Pound','£','SH.png',NULL,NULL),
	(180,'Saint Kitts and Nevis','Kittian and Nevisian','XCD','Dollar','$','KN.png',NULL,NULL),
	(181,'Saint Lucia','Saint Lucian','XCD','Dollar','$','LC.png',NULL,NULL),
	(182,'Saint Pierre and Miquelon','Saint Pierre and Miquelon','EUR','Euro','€','PM.png',NULL,NULL),
	(183,'Saint Vincent and the Grenadines','Saint Vincent and the Grenadines','XCD','Dollar','$','VC.png',NULL,NULL),
	(184,'Samoa','Samoan','WST','Tala','WS$','WS.png',NULL,NULL),
	(185,'San Marino','Sammarinese','EUR','Euro','€','SM.png',NULL,NULL),
	(186,'Sao Tome and Principe','Sao Tomean','STD','Dobra','Db','ST.png',NULL,NULL),
	(187,'Saudi Arabia','Saudi Arabian','SAR','Rial','﷼','SA.png',NULL,NULL),
	(188,'Senegal','Senegalese','XOF','Franc',NULL,'SN.png',NULL,NULL),
	(189,'Serbia and Montenegro','Serbian','RSD','Dinar','Дин','CS.png',NULL,NULL),
	(190,'Seychelles','Seychellois','SCR','Rupee','₨','SC.png',NULL,NULL),
	(191,'Sierra Leone','Sierra Leonean','SLL','Leone','Le','SL.png',NULL,NULL),
	(192,'Singapore','Singaporean','SGD','Dollar','$','SG.png',NULL,NULL),
	(193,'Slovakia','Slovak','SKK','Koruna','Sk','SK.png',NULL,NULL),
	(194,'Slovenia','Slovene','EUR','Euro','€','SI.png',NULL,NULL),
	(195,'Solomon Islands','Solomon Islander','SBD','Dollar','$','SB.png',NULL,NULL),
	(196,'Somalia','Somali','SOS','Shilling','S','SO.png',NULL,NULL),
	(197,'South Africa','South African','ZAR','Rand','R','ZA.png',NULL,NULL),
	(198,'South Georgia and the South Sandwich Islands','South Georgia and the South Sandwich I','GBP','Pound','£','GS.png',NULL,NULL),
	(199,'South Korea','Korean','KRW','Won','₩','KR.png',NULL,NULL),
	(200,'Spain','Spanish','EUR','Euro','€','ES.png',NULL,NULL),
	(201,'Sri Lanka','Sri Lankan','LKR','Rupee','₨','LK.png',NULL,NULL),
	(202,'Sudan','Sudanese','SDD','Dinar',NULL,'SD.png',NULL,NULL),
	(203,'Suriname','Surinamer','SRD','Dollar','$','SR.png',NULL,NULL),
	(204,'Svalbard and Jan Mayen','Svalbard and Jan Mayen','NOK','Krone','kr','SJ.png',NULL,NULL),
	(205,'Swaziland','Swazi','SZL','Lilangeni',NULL,'SZ.png',NULL,NULL),
	(206,'Sweden','Swedish','SEK','Krona','kr','SE.png',NULL,NULL),
	(207,'Switzerland','Swiss','CHF','Franc','CHF','CH.png',NULL,NULL),
	(208,'Syria','Syrian','SYP','Pound','£','SY.png',NULL,NULL),
	(209,'Taiwan','Taiwanese','TWD','Dollar','NT$','TW.png',NULL,NULL),
	(210,'Tajikistan','Tadzhik','TJS','Somoni',NULL,'TJ.png',NULL,NULL),
	(211,'Tanzania','Tanzanian','TZS','Shilling',NULL,'TZ.png',NULL,NULL),
	(212,'Thailand','Thai','THB','Baht','฿','TH.png',NULL,NULL),
	(213,'Togo','Togolese','XOF','Franc',NULL,'TG.png',NULL,NULL),
	(215,'Tonga','Tongan','TOP','Paanga','T$','TO.png',NULL,NULL),
	(216,'Trinidad and Tobago','Trinidadian','TTD','Dollar','TT$','TT.png',NULL,NULL),
	(217,'Tunisia','Tunisian','TND','Dinar',NULL,'TN.png',NULL,NULL),
	(218,'Turkey','Turkish','TRY','Lira','YTL','TR.png',NULL,NULL),
	(219,'Turkmenistan','Turkmen','TMM','Manat','m','TM.png',NULL,NULL),
	(220,'Turks and Caicos Islands','Turks and Caicos Islands','USD','Dollar','$','TC.png',NULL,NULL),
	(221,'Tuvalu','Tuvaluan','AUD','Dollar','$','TV.png',NULL,NULL),
	(222,'U.S. Virgin Islands','Virgin Islander','USD','Dollar','$','VI.png',NULL,NULL),
	(223,'Uganda','Ugandan','UGX','Shilling',NULL,'UG.png',NULL,NULL),
	(224,'Ukraine','Ukrainian','UAH','Hryvnia','₴','UA.png',NULL,NULL),
	(225,'United Arab Emirates','Emirian','AED','Dirham',NULL,'AE.png',NULL,NULL),
	(226,'United Kingdom','British','GBP','Pound','£','GB.png',NULL,NULL),
	(227,'United States','American','USD','Dollar','$','US.png',NULL,NULL),
	(228,'United States Minor Outlying Islands','United States Minor Outlying Islands','USD','Dollar ','$','UM.png',NULL,NULL),
	(229,'Uruguay','Uruguayan','UYU','Peso','$U','UY.png',NULL,NULL),
	(230,'Uzbekistan','Uzbekistani','UZS','Som','лв','UZ.png',NULL,NULL),
	(231,'Vanuatu','Ni-Vanuatu','VUV','Vatu','Vt','VU.png',NULL,NULL),
	(232,'Vatican','Vatican','EUR','Euro','€','VA.png',NULL,NULL),
	(233,'Venezuela','Venezuelan','VEF','Bolivar','Bs','VE.png',NULL,NULL),
	(234,'Vietnam','Vietnamese','VND','Dong','₫','VN.png',NULL,NULL),
	(235,'Wallis and Futuna','Wallis and Futuna','XPF','Franc',NULL,'WF.png',NULL,NULL),
	(236,'Western Sahara','Western Saharan','MAD','Dirham',NULL,'EH.png',NULL,NULL),
	(237,'Yemen','Yemeni','YER','Rial','﷼','YE.png',NULL,NULL),
	(238,'Zambia','Zambian','ZMK','Kwacha','ZK','ZM.png',NULL,NULL),
	(239,'Zimbabwe','Zimbabwean','ZWD','Dollar','Z$','ZW.png',NULL,NULL),
	(240,'All',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table couriers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `couriers`;

CREATE TABLE `couriers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `couriers` WRITE;
/*!40000 ALTER TABLE `couriers` DISABLE KEYS */;

INSERT INTO `couriers` (`id`, `name`, `website`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Royal Mail','https://www.royalmail.com/track-your-item',1,'2016-03-15 13:12:03','2016-03-15 13:12:03'),
	(2,'MyHermes','https://international.myhermes.co.uk/tracking',1,'2016-03-15 13:12:03','2016-03-15 13:12:03'),
	(3,'UPS','https://www.ups.com/WebTracking/track?loc=en_us',1,'2016-03-15 13:12:03','2016-03-15 13:12:03'),
	(4,'Parcel Force','http://www.parcelforce.com/track-trace',1,'2016-03-15 13:12:03','2016-03-15 13:12:03');

/*!40000 ALTER TABLE `couriers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer_addresses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_addresses`;

CREATE TABLE `customer_addresses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` tinyint(2) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `customer_addresses` WRITE;
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;

INSERT INTO `customer_addresses` (`id`, `user_id`, `name`, `address`, `town`, `city`, `zip_code`, `country`, `default`, `created_at`, `updated_at`)
VALUES
	(3,2,'Dads','37 Lynwood Road','Tooting','London','SW17 8SB','United Kingdom',1,'2017-04-18 23:53:42','2017-04-18 23:53:42'),
	(7,12,'Home','37, Lynwood Road','London','London','SW17 8SB','United Kingdom',0,'2017-04-19 23:05:40','2017-04-19 23:05:40'),
	(8,13,'Home','47 Eckweek Gardens, Peasedown St. John','Bath','Bath','BA2 8EL','United Kingdom',0,'2017-04-19 23:10:03','2017-04-19 23:10:03'),
	(9,14,'Home','37, Lynwood Road','London','London','SW17 8SB','United Kingdom',0,'2017-04-19 23:15:49','2017-04-19 23:15:49'),
	(10,15,'Home','37, Lynwood Road','London','London','SW17 8SB','United Kingdom',0,'2017-04-20 10:57:24','2017-04-20 10:57:24'),
	(11,16,'Home','463 High Street','Clapham Common','London','SW4 3BS','United Kingdom',0,'2017-04-20 15:27:21','2017-04-20 15:27:21'),
	(12,1,'Bob\'s house','44 Sandbourne Road','Brockley','London','SE4 2NP','United Kingdom',0,'2017-04-20 17:43:12','2017-07-14 10:43:38'),
	(14,18,'MY HOME','37 Lynwood Road,','Tooting','London','SW17 8SB','United Kingdom',1,'2017-05-18 18:17:00','2017-05-18 18:17:00'),
	(41,1,'DADS','37 Lynwood Road','Tooting Bec','London','SW17 8SB','United Kingdom',1,NULL,'2017-07-14 10:43:38'),
	(42,1,'Rehab','Group 7, building 4, flat 21','Al Rehab','Cairo','383922','Egypt',0,NULL,'2017-07-14 10:43:38');

/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table email_templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;

INSERT INTO `email_templates` (`id`, `name`, `template`, `subject`, `email`, `created_at`, `updated_at`)
VALUES
	(1,'user-registration-welcome','account_created','Account Created - Nurtured For Living','<p><b>Welcome to Nurtured For Living!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>Thank you for visiting our website. In order to process any orders we need to store some basic information. We have therefore created a user account for you so that all of your orders can be grouped together in one place.</p>\r\n\r\n<p>You can now login to our website at any time using the details below:</p>\r\n\r\n<p><b>Website Address<br></b><a href=\"http://www.nurturedforliving.com/login\">http://www.nurturedforliving.com/login</a></p>\r\n\r\n<p><b>Email Address<br></b>{email}</p>\r\n<p><b>Password<br></b>{password}</p>\r\n\r\n<p>(You can change your password at anytime by logging in to your account and clicking \"Edit Account\").</p>\r\n<p>Kind Regards,</p>','2016-10-27 11:53:24','2016-11-14 13:55:40'),
	(2,'newsletter-signup','standard_template','Keep up to date with Nurtured For Living','<p><b>Congratulations!</b></p>\n\n<p>Dear {username},</p>\n\n<p>You have just joined the growing number of subscribers who are getting healthy with Nurtured For Living. We\'ll send you emails with special offers, updates about the our latest product or article and any competitions we\'re running.</p>\n\n<p>We won\'t bombard your inbox and you can unsubscribe at anytime. Just use the subscriptions link when logged in or by click unsubscribe at the bottom of the emails.</p>\n\n<p>Stay focused, and stay healthy!</p>\n<p>Kind Regards,</p>','2016-10-27 12:26:24','2016-11-14 21:07:54'),
	(3,'order-confirmation','order_confirmation','Order confirmation - Nurtured For Living','<p><b>Order Confirmation!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>\nThank you for placing an order at nurturedforliving.com. Full details of your order are provided below for your reference. \nYou can login to our website at any time to track the order status.\n</p>\n<p>\nYou have earned {points} loyalty points with this order, <a href=\"http://nurturedforliving.com/loyalty-scheme\">click here</a> to find out more about our loyalty scheme or <a href=\"http://nurturedforliving.com/opportunity\">here</a> to read about our rewards program.\n</p>\n<p>Please contact <a href=\"mailto:info@nurturedforliving.com\"> customer services</a> if you have any queries.</p>\r\n\r\n<p>Kind Regards,<br></p>','2016-10-27 12:28:18','2016-11-25 18:39:30'),
	(4,'order-status-update-trackable','standard_template','Status update for order #{order_number} - Nurtured For Living','<p><b>Order Status Updated to Shipped!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>This is to inform you that your order #{order_number} placed on {order_date} has been updated to shipped.<br>Your order will be delivered by {courier} within {duration}.</p>\r\n\r\n<p>You can track your order by visiting the link below and entering tracking number: {tracking_number}</p>\r\n\r\n<p>Tracking link: {url}</p>\r\n\r\n<p>Please contact <a href=\"mailto:info@nurturedforliving.com\">customer services</a> if you have any queries.</p>\r\n\r\n<p>Kind Regards,<br></p>','2016-10-27 12:31:20','2016-11-26 00:47:52'),
	(5,'cancelled-subscription','standard_template','Cancelled Subscription - Nurtured For Living','<p><b>We\'re sad to see you go!</b></p>\n\n<p>Dear {username},</p>\n\n<p>We hope that you enjoyed the content we\'ve been sending you and we\'re sad to see you go!</p>\n\n<p>We look forward to you joining us again in the future, Stay focused, and stay healthy!</p>\n<p>Kind Regards,</p>','2016-10-27 12:33:11','2016-10-27 12:33:11'),
	(6,'password-reset','standard_template','Password Reset - Nurtured For Living','<p>Hi {username},</p>\r\n\r\n<p>You recently requested to reset your password for your nurturedforliving.com account. Click the button below to reset your password. The reset link is only valid for the next 24 hours.</p>\r\n\r\n<p class=\"align-center\"><a href=\"{action_url}\" class=\"btn\">Reset Your Password</a></p>\r\n\r\n<p>If you did not request a password reset, please ignore this email or <a href=\"mailto:info@nurturedforliving.com\">contact support</a> if you have questions.</p>\r\n\r\n<p>Thanks, <br>Nurtured For Living Team</p>\r\n<hr>\r\n<p>If you’re having trouble with the button above, copy and paste the URL below into your web browser.\r\n<br>\r\n<small>{action_url}</small></p>','2016-10-27 12:33:11','2016-11-15 06:50:42'),
	(7,'order-status-update-untrackable','standard_template','Status update for order #{order_number} - Nurtured For Living','<p><b>Order Status Updated to Shipped!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>This is to inform you that your order #{order_number} placed on {order_date} has been updated to shipped.<br>Your order will be delivered by {courier} within {duration}.</p>\r\n\r\n<p>Please contact <a href=\"mailto:info@nurturedforliving.com\">customer services</a> if you have any queries.</p>\r\n\r\n<p>Kind Regards,<br></p>','2016-11-25 17:50:04','2016-11-26 00:36:41'),
	(8,'order-cancelled','standard_template','Status update for order #{order_number} - Nurtured For Living','<p><b>Order Cancelled!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>This is to inform you that your order #{order_number} placed on {order_date} has been cancelled.</p>\r\n\r\n<p>Please contact <a href=\"mailto:info@nurturedforliving.com\">customer services</a> if you have any queries.</p>\r\n\r\n<p>Kind Regards,<br></p>','2016-11-25 17:50:04','2016-11-26 00:36:41'),
	(9,'order-refunded','standard_template','Status update for order #{order_number} - Nurtured For Living','<p><b>Order Refunded!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>This is to inform you that your order #{order_number} placed on {order_date} has been refunded.</p>\r\n\r\n<p>Please contact <a href=\"mailto:info@nurturedforliving.com\">customer services</a> if you have any queries.</p>\r\n\r\n<p>Kind Regards,<br></p>','2016-11-25 17:50:04','2016-11-26 00:36:41'),
	(10,'referral-account-created','referral_account_created','Welcome to Nurtured For Living','<p><b>Welcome to Nurtured For Living!</b></p>\r\n\r\n<p>Dear {username},</p>\r\n\r\n<p>{referrer_name} would like to introduce you to join our growing list of users.</p>\r\n\r\n<p>Visit our website <a href=\"http://www.nurturedforliving.com\">Nurtured For Living</a></p>\r\n\r\n<p><b>Website Address</b><br><a href=\"http://www.nurturedforliving.com/login\">http://www.nurturedforliving.com/login</a></p>\r\n\r\n<p><b>Email Address<br></b>{email}</p>\r\n<p><b>Password<br></b>{password}</p>\r\n\r\n<p>(You can change your password at anytime by logging in to your account and clicking \"Edit Account\").</p>\r\n<p>Kind Regards,</p>','2017-04-17 15:43:44','2017-04-17 15:57:17');

/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table faqs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faq_category_id` int(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  `answer` text,
  `order` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;

INSERT INTO `faqs` (`id`, `faq_category_id`, `question`, `answer`, `order`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'Do you ship outside of the UK?','We deliver worldwide through UK postal, parcel and courier services.',1,1,'2014-07-07 13:56:45','2016-10-05 19:56:17'),
	(2,2,'Where do I send return items?','<p>Please send returns to:</p>\r\n\r\n<p>\r\nNurtured For Living LTD,<br>\r\nPO box 69041<br>\r\nLondon, SW17 1FU</p><p><i>Items should be returned by registered post and will only be considered as returned once received.</i></p><p>\r\n</p>',4,1,'2014-07-07 13:58:03','2016-10-05 19:53:37'),
	(3,3,'Are your products certified natural / organic?\r\n','<p>Any of our products that claim to be natural or organic are certified by the relevant agencies. Certificates are displayed on the product\'s listing page.</p>\r\n\r\n<p><b>Pink Himalayan Salt</b><br>\r\nCertified by the NHI (National Health Institute Islamabad) and the PCSIR (Pakistan Council of Scientific and Industrial Research).</p>',2,1,'2016-09-03 19:20:25','2016-10-26 19:29:51'),
	(4,5,'Can I buy your products in stores?','<p> Our products can be purchased from outlets listed on our retailer\'s page. </p>',1,1,'2016-10-05 19:14:41','2016-10-26 19:31:03'),
	(5,1,'What is the estimated delivery time?','<p>The delivery time is determined by the service chosen at checkout. </p>',2,1,'2016-10-05 19:19:15','2016-10-26 19:54:19'),
	(6,4,'Can I get my items gift wrapped?','<p>Gift wrapping is available on selected products at an additional cost and can be chosen on the view cart page. </p>',1,1,'2016-10-05 19:28:48','2016-10-26 19:52:40'),
	(7,1,'Can I collect my items?','<p>Unfortunately, orders are not available for collection</p>',4,1,'2016-10-05 19:31:33','2016-10-05 19:31:33'),
	(8,2,'My items arrived damaged, what should I do?','<p>We try extremely hard to ensure that orders are packed adequately. In the unlikely event that your order arrives damaged, you should inform us as soon as possible, and we will take the necessary steps to resolve the situation.</p>',1,1,'2016-10-05 19:37:38','2016-10-26 20:03:01'),
	(9,2,'What is your returns policy?','<p>Our returns policy is in line with the UK consumer rights act. We want our customers to be happy with the products we supply, so customers are eligible for a refund for up to 14 days from the date they receive their order. This only applies to non-perishable goods. Items should be returned unopened, unused and undamaged in their original packaging.</p>\r\n\r\n<p>For cases where items may have been damaged or faulty upon arrival, customers should contact us as soon as possible so we can rectify the situation.</p>\r\n\r\n<p><a href=\"returns-and-refunds\">Read more about refunds and returns</a></p>',2,1,'2016-10-05 20:14:53','2016-10-26 20:07:38'),
	(10,5,'Can I purchase your items wholesale?','<p>Yes, we are always happy to establish relationships with new retailers, contact our <a href=\"contact-us\">customer services department </a>, and they will gladly answer your queries.</p>',2,1,'2016-10-05 22:54:33','2016-10-26 20:00:18'),
	(11,1,'I missed my delivery, what should I do?','<p>There will be three consecutive attempts to deliver your parcel. On each attempt a card will be left with the attempt details and information related to how you can reschedule your delivery or collect your parcel from the relevant collection point.</p>',3,1,'2016-10-26 19:55:48','2016-10-26 19:55:48'),
	(12,5,'Do you offer bulk discounts?','<p>Discounts are displayed on the product list page. For higher discounts contact us about our wholesale benefits. </p>',3,1,'2016-10-26 20:01:24','2016-10-26 20:01:24');

/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table faqs_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faqs_categories`;

CREATE TABLE `faqs_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `faqs_categories` WRITE;
/*!40000 ALTER TABLE `faqs_categories` DISABLE KEYS */;

INSERT INTO `faqs_categories` (`id`, `name`, `status`, `order`, `created_at`, `updated_at`)
VALUES
	(1,'Shipping / delivery',1,3,'2014-07-07 13:40:16','2016-10-05 18:22:14'),
	(2,'Returns',1,5,'2014-07-07 13:42:05','2016-10-05 18:22:36'),
	(3,'Products',1,1,'2016-09-03 19:01:29','2016-09-03 19:01:29'),
	(4,'Packaging',1,2,'2016-10-05 18:21:41','2016-10-05 18:21:41'),
	(5,'Stores / Distribution',1,4,'2016-10-05 18:23:02','2016-10-05 18:23:02');

/*!40000 ALTER TABLE `faqs_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table favorite_articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favorite_articles`;

CREATE TABLE `favorite_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table medias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `medias`;

CREATE TABLE `medias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail_150` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_300` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `medias_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `name`, `items`, `created_at`, `updated_at`)
VALUES
	(1,'main_menu','[{\"type\":\"1\",\"id\":\"2\"},{\"type\":\"3\",\"link\":\"shop\",\"title\":\"Products\"},{\"type\":\"1\",\"id\":\"18\"},{\"type\":\"1\",\"id\":\"19\"},{\"type\":\"1\",\"id\":\"22\"},{\"type\":\"1\",\"id\":\"6\"}]',NULL,'2017-07-21 15:24:39'),
	(2,'privacy','[{\"type\":\"1\",\"id\":\"24\"},{\"type\":\"1\",\"id\":\"9\"},{\"type\":\"1\",\"id\":\"12\"},{\"type\":\"1\",\"id\":\"6\"}]','2016-04-09 12:09:12','2016-10-25 02:31:57'),
	(3,'customer_service','[{\"type\":\"1\",\"id\":\"6\"},{\"type\":\"1\",\"id\":\"25\"},{\"type\":\"1\",\"id\":\"28\"},{\"type\":\"1\",\"id\":\"26\"},{\"type\":\"1\",\"id\":\"9\"},{\"type\":\"1\",\"id\":\"24\"},{\"type\":\"1\",\"id\":\"12\"}]','2016-10-24 01:47:47','2017-04-12 17:59:27');

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`migration`, `batch`)
VALUES
	('2016_03_08_073717_create_nurturned_database',1),
	('2016_03_11_110614_add_seo_fields_to_categories_table',2),
	('2016_03_15_111521_clearmenucaching',3),
	('2016_03_15_192831_add_competition_table',4),
	('2016_03_17_930283_add_food_groups_table',5),
	('2016_03_17_143434_add_fulltext_search_to_articles_table',6),
	('2016_03_19_001931_add_food_guide_fields',7),
	('2016_03_22_833292_add_permission_cats',8),
	('2000_01_1_195953_add_cart_session_id_to_users_table',9),
	('2016_03_24_993283_add_to_users',10),
	('2016_03_28_442820_add_course_modules',11),
	('2016_03_25_163735_create_shop_products_table',12),
	('2016_03_26_171828_create_shop_product_categories_table',12),
	('2016_03_26_172400_create_shop_product_product_category_table',12),
	('2016_03_27_104018_create_shop_orders_table',12),
	('2016_03_27_151043_create_medias_table',12),
	('2016_04_01_093814_rename_product_weight',13),
	('2016_04_05_033901_add_token_to_shop_order_table',13),
	('2016_04_05_072206_add_meta_to_shop_orders_table',13),
	('2016_04_05_083902_rename_ship_fee_shop_orders_table',13),
	('2016_04_07_023331_create_shop_shipping_methods',13),
	('2016_04_09_883723_change_settings',14),
	('2016_04_09_055718_add_address_state_to_users_table',15),
	('2016_04_13_062017_create_shop_setting_table',15),
	('2016_04_20_119231_modify_products',16),
	('2016_04_23_119201_add_comment_and_review_tables',17),
	('2016_04_25_043314_add_meta_to_shop_shipping_methods_table',18),
	('2016_04_28_111921_add_inventory',19),
	('2016_04_29_134321_add_product_status',20),
	('2016_04_29_155333_create_shop_favorites_products',21),
	('2016_05_02_999912_add_stock_email_table',22),
	('2016_05_08_749222_add_missing',23),
	('2016_05_09_072318_add_weight_to_shop_shipping_methods_table',24),
	('2016_05_09_073334_create_region_shipping_table',24),
	('2016_05_09_073459_create_shop_country_shipping_table',24),
	('2016_05_09_082851_add_is_allow_over_the_world_to_shop_shipping_methods_table',24),
	('2016_05_09_093715_remove_type_shop_shipping_methods_table',24),
	('2016_05_09_141911_add_fee_rates_to_shop_shipping_methods_table',24),
	('2016_05_12_023803_recreate_shop_shipping_methods_table',24),
	('2016_05_12_080856_add_size_to_shop_products_table',25),
	('2016_05_12_140144_rename_weigh_to_weight_shop_products_table',25),
	('2016_05_22_134321_add_recipe_table',26),
	('2016_05_25_075435_add_details_to_shop_orders_table',26),
	('2016_05_25_993012_add_zip_code',27),
	('2016_05_27_002931_add_missing',28),
	('2016_06_03_999123_add_missing_two',28),
	('2016_06_06_042327_make_order_fields_nullable',29),
	('2016_06_06_104754_add_is_multiple_shop_locations_to_site_settings_table',30),
	('2016_06_07_074734_change_items_field_to_text_to_shop_orders',31),
	('2016_06_07_074820_add_shiping_method_id_to_shop_orders_table',31),
	('2016_05_27_002931_add_missing_one',32),
	('2016_06_08_273449_add_to_settings',33),
	('2016_06_10_111112_add_revisions',34),
	('2016_06_15_333827_add_approved_to_articles',35),
	('2016_06_17_111231_add_to_notifications',36),
	('2016_06_18_040302_create_course_files_table',38),
	('2016_06_18_040924_create_cources_cource_files_table',38),
	('2016_06_18_000212_add_extra_fields',39),
	('2016_06_20_032526_rename_course_files_table',40),
	('2016_06_20_033709_change_contributor_pivo_table',40),
	('2016_06_20_095206_and_content_to_course_module_table',42),
	('2016_06_20_132034_add_course_id_to_coach_courses_table',42),
	('2016_06_21_111121_add_chef_bio',43),
	('2016_06_23_043831_add_courses_to_shop_orders_table',44),
	('2016_06_23_044025_add_shipping_method_name_to_shop_orders_table',44),
	('2016_06_23_101806_make_some_order_fiels_nullable',46),
	('2016_06_23_993822_add_module_intro_video',47),
	('2016_06_23_113937_create_coach_course_user_table',48),
	('2016_06_28_063007_create_recipe_reviews_table',50),
	('2016_06_24_101010_add_start_date',51),
	('2016_07_09_119212_modify_enrolments',52),
	('2016_09_26_101654_change_shop_discount_codes_fields_to_bit',53),
	('2016_10_05_039283_add_missing_fields',53),
	('2016_10_18_948372_add_wholesale_orders',54),
	('2016_10_27_038624_add_email_templates',55),
	('2016_11_14_002912_add_template_to_emails',56),
	('2016_11_15_070953_create_jobs_table',57),
	('2016_11_25_884937_email_fields',58),
	('2016_11_28_144851_add_discount_to_orders_table_and_make_order_number_null',59),
	('2016_12_09_112233_extra_tables',60),
	('2016_12_23_445566_add_dsiplayed_product_qty',61),
	('2016_12_25_778899_add_instock_date',62),
	('2017_04_10_101112_add_referrals',63),
	('2017_07_13_123456_rename_points',64),
	('2017_07_26_123456_add_contributors',65);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `list_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table newsletters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `newsletters`;

CREATE TABLE `newsletters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `signup_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signup_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT '2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;

INSERT INTO `newsletters` (`id`, `signup_name`, `signup_email`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Maryam Jordan','eamirahomer@aol.com',1,'2016-10-25 16:44:41','2016-10-25 16:44:41'),
	(2,'Karen Drakes','Kdrakes@ymail.com',1,'2016-12-11 22:48:42','2016-12-11 22:48:42'),
	(3,'Beverley','bevdrakes@yahoo.com',1,'2016-12-24 16:21:53','2016-12-24 16:21:53'),
	(4,'IsaacPouff IsaacPouff','owen@1milliondollars.xyz',1,'2017-02-13 15:13:54','2017-02-13 15:13:54'),
	(5,'Muhammad Angus','m@kedstudio.com',1,'2017-04-12 14:06:39','2017-04-12 14:06:39'),
	(6,'New User','micah@ambient-group.com',1,'2017-04-18 23:53:38','2017-04-18 23:53:38'),
	(7,'Micah Angus','micah@nurturedforliving.com',1,'2017-04-19 17:34:54','2017-04-19 17:34:54'),
	(8,'Micah Angus','tom@email.com',1,'2017-04-19 22:55:43','2017-04-19 22:55:43'),
	(9,'David Daly','Dave@email.com',1,'2017-04-19 23:10:01','2017-04-19 23:10:01'),
	(10,'Micah Angus','john@email.com',1,'2017-04-19 23:15:46','2017-04-19 23:15:46'),
	(11,'Chris Smith','chris@email.com',1,'2017-04-20 10:57:21','2017-04-20 10:57:21'),
	(12,'James Bond','james@email.com',1,'2017-04-20 15:27:18','2017-04-20 15:27:18'),
	(13,'micalyah angus','fefe.mcqueen.ig@gmail.com',1,'2017-04-20 17:43:09','2017-04-20 17:43:09');

/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `extra_info` text COLLATE utf8_unicode_ci,
  `setting` text COLLATE utf8_unicode_ci,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `show_top_share_icons` tinyint(1) NOT NULL DEFAULT '2',
  `show_bottom_share_icons` tinyint(1) NOT NULL DEFAULT '2',
  `allow_comments` tinyint(1) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `title`, `meta_description`, `meta_keywords`, `slug`, `content`, `extra_info`, `setting`, `status`, `show_top_share_icons`, `show_bottom_share_icons`, `allow_comments`, `created_at`, `updated_at`)
VALUES
	(2,'About Us','At Nurtured for Living, we have a passion for living naturally. We believe that using and consuming chemical-free food and household products, leads to better overall health, wellness, and happiness and is good for the environment in which we live.','Who we are and what we do.','about-us','<p>At Nurtured for Living, we have a passion for living naturally. We believe that using and consuming chemical-free food and household products,  leads to better overall health, wellness, and happiness and is good for the environment in which we live.</p>\r\n\r\n<p>Our aim is to maintain high standards and  create high quality 100% naturally and ethically produced products.</p>\r\n\r\n<p>We understand that many people may be skeptical about the authenticity of the \'natural\' products they buy online. At Nurtured for Living we provide certification and seals of approval where possible, from the relevant governing bodies. Our families and friends are showing great confidence in our products and are making them part of their daily lives.  </p>\r\n\r\n<p>Overall we aim is to help raise awareness about ‘going natural’ and its advantages. We intend to continually update our online resources, which includes; articles, guides, videos and news, to help keep you informed about everything there is to know about natural living.</p>\r\n\r\n<p>We bring together some of nature’s most powerful elements and resources to share with the rest of the world. We believe that living a natural, healthy life should be an opportunity available to everyone.</p>\r\n\r\n<p>Nurtured for Living, enhancing the world naturally, step by step.</p>\r\n\r\n<hr>\r\n\r\n<h3>Contributors </h3>','',NULL,1,2,2,2,'2016-03-10 11:39:40','2017-07-26 17:10:53'),
	(6,'Contact Us','','','contact-us','<p>At Nurtured for Living, we pride ourselves on the quality of our products and our excellent customer service. We welcome any enquiries, and we value your feedback. If you have any questions about your shipped items, our current or future stock, how to become one of our retail partners, or if you would just like to offer us some feedback, then we would love to hear from you.</p>','<p>Please contact us via the appropriate method and our customer service team will be happy to assist you.</p>',NULL,1,2,2,2,'2016-03-16 12:21:40','2017-03-17 10:28:36'),
	(7,'Competitions','competitions','competitions','competitions','<p>competitions</p>\r\n',NULL,NULL,2,1,1,2,'2016-03-19 15:06:50','2016-03-19 15:06:50'),
	(9,'Privacy & Cookies','When you use Nurturedforliving.com, you trust us with your information. This policy sets out the different areas where user privacy is concerned and outlines the obligations & requirements of the users, the website and website owners.','Privacy, Cookies, Policy','privacy-and-cookies','<p>When you use Nurturedforliving.com, you trust us with your information. This policy sets out the different areas where user privacy is concerned and outlines the obligations &amp; requirements of the users, the website and website owners.</p>\r\n\r\n<h2>The Website</h2>\r\n\r\n<p>This website and its owners take a proactive approach to user privacy and ensure the necessary steps are taken to protect the privacy of its users throughout their visiting experience. This website complies to all UK national laws and requirements for user privacy.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n\r\n<h2>Collected Information</h2>\r\n\r\n<p>We collect a small amount of information necessary to fulfil orders made through the site. This data is taken through securely encrypted pages and generally includes name, address, email and telephone number. No credit / debit card details are processed or stored on our website.</p>\r\n\r\n<p>The website also collects some general information to help us improve our site and your user experience.</p>\r\n\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Use of Cookies</h2>\r\n\r\n<p>This website uses cookies to better the user\'s experience while visiting the website. Where applicable we use a cookie control system, allowing the user on their first visit, to allow or disallow the use of cookies on their device.</p>\r\n\r\n<p>Cookies are small files saved to the user\'s computer hard drive that track, save and store information about the user\'s interactions and usage of the website. This allows the website, through its server to provide the users with a tailored experience within the website.</p>\r\n\r\n<p>Users are advised that if they wish to deny the use and saving of cookies from this website onto their computers hard drive they should take necessary steps within their web browsers security settings to block all cookies from this website.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Contact &amp; Communication</h2>\r\n\r\n<p>Users contacting this website and/or its owners do so at their own discretion and provide any requested personal details at their own risk. Your personal information is kept private and stored securely until a time it is no longer required or has no use, as detailed in the Data Protection Act 1998.</p>\r\n\r\n<p>This website and its owners use any information submitted to provide you with further information about the products / services they offer or to assist you in answering any questions or queries you may have submitted. This includes using your details to subscribe you to any email newsletter program the website operates. Or whereby you the consumer have previously purchased or enquired about purchasing a product that relates to the email newsletter. You are free to opt-out of these programs at any time. This is by no means an entire list of your user rights in regard to receiving email marketing material. Rest assured that your details are not passed on to any third parties.\r\n</p>\r\n\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Email Newsletter</h2>\r\n\r\n<p>This website operates an email newsletter program, used to inform subscribers about products, services and general wellbeing information supplied by this website. Users can subscribe through an automated online process should they wish to do so but do so at their own discretion. Some subscriptions will be processed automatically as mentioned above.</p>\r\n\r\n<p>All personal details relating to subscriptions are held securely and in agreement with the Data Protection Act 1998. No personal details are passed on to third parties nor shared with companies / people outside of the company that operate this website. You may request a copy of personal information held about you by this website\'s email newsletter program. A small fee will be payable. If you would like a copy of the information held on you, please write to the business address at the bottom of this policy.</p>\r\n\r\n\r\n<p>Email marketing campaigns published by this website or its owners may contain tracking facilities within the actual email. Subscriber activity is tracked and stored in a database for future analysis and evaluation. Such tracked activity may include; the opening of emails, forwarding of emails, the clicking of links within the email content, times, dates and frequency of activity. This information is used to refine future email campaigns and supply the user with more relevant content based on their activity.</p>\r\n\r\n<p>Subscribers are given the opportunity to unsubscribe at any time through an automated system. This process is detailed at the footer of each email campaign and can be managed via your account on the \"My Subscriptions\" page. If an automated unsubscribe system is unavailable, clear instructions on how to unsubscribe will by detailed instead.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Social Media Platforms</h2>\r\n\r\n<p>Communication, engagement and actions taken through external social media platforms that this website and its owners participate on, are custom to the terms and conditions as well as the privacy policies held with each social media platform respectively.</p>\r\n\r\n<p>Users are advised to use social media platforms wisely and communicate / engage upon them with due care and caution in regard to their own privacy and personal details. This website nor its owners will ever ask for personal or sensitive information through social media platforms and encourage users wishing to discuss sensitive details to contact them through primary communication channels such as by telephone or email.</p>\r\n\r\n<p>This website may use social sharing buttons which help share web content directly from web pages to the social media platform in question. Users are advised before using such social sharing buttons that they do so at their discretion and note that the social media platform may track and save your request to share a web page respectively through your social media platform account.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Shortened Links in Social Media</h2>\r\n\r\n<p>This website and its owners through their social media platform accounts may share web links to relevant web pages. By default, some social media platforms shorten lengthy urls [web addresses] (this is an example: http://bit.ly/zyVUBo).</p>\r\n\r\n<p>Users are advised to take caution and good judgement before clicking any shortened urls published on social media platforms by this website and its owners. Despite the best efforts to ensure only genuine urls are published, many social media platforms are prone to spam and hacking and therefore this website and its owners cannot be held liable for any damages or implications caused by visiting any shortened links.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p>\r\n<b>Nurtured For Living LTD</b><br>\r\nPO Box 69041<br>\r\nLondon, SW17 1FU<br>\r\nCompany No 9966047\r\n</p>','',NULL,1,2,2,2,'2016-04-09 12:07:48','2016-11-15 17:28:58'),
	(11,'Press & Media','Press & Media','Press & Media','press-and-media','<p>Press &amp; Media Coverage</p>\r\n',NULL,NULL,2,2,2,2,'2016-04-09 12:13:41','2016-06-05 13:53:19'),
	(12,'Disclaimer','This disclaimer governs the use of information published on NurturedForLiving.com. By using this website, you accept this disclaimer in its entirety.','Nurtured For Living, disclaimer','disclaimer','<p>You are advised to read this disclaimer thoroughly before using the website. This disclaimer governs the use of information published on NurturedForLiving.com. By using this website, you accept this disclaimer in its entirety. Should you disagree with any part of it, you should refrain from reading any of the content found herein. We reserve the right to modify these terms at any time and it is your responsibility to check for updates periodically. Use of this site after an update is deemed as acceptance of the terms even without you viewing them. <b><i>By reading the content on this website, you acknowledge and agree that you are solely responsible for your health decisions.</i></b>\r\n</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Website Articles</h2>\r\n\r\n<p>All information and resources published are based on research obtained by our admin team unless otherwise stated. Any references will be mentioned for you to evaluate for yourself. <b>None of the content published on this website can be used to make a medical diagnosis, determine treatment for any specific conditions or dietary needs.</b>. This information is meant to inspire and encourage you to make your own health-related decisions while consulting your health care provider or a qualified practitioner.</p>\r\n\r\n<p>We reserve the right to edit or remove any articles at any time and for any reason. Articles are copyright to Nurtured For Living and may not be re-printed/published digitally or in print without written permission. Excerpts may be used with attribution, provided links are clearly visible.</p>\r\n\r\n <p>We may update our articles at any time. There is no obligation upon us to ensure that the information published is up to date, nor do we guarantee that our site, or any content posted on it, will be free from errors or omissions.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Product Related Information</h2>\r\n\r\n<p>All product related information is provided by suppliers, related agencies or governing bodies. While we take every precaution to use only  credible sources, we take no responsibility for the accuracy of the information published.</p>\r\n\r\n\r\n<hr class=\"dashed\">','',NULL,1,2,2,2,'2016-04-09 12:22:02','2016-11-15 17:48:08'),
	(13,'News','Nurtured For Living\'s news updates','Nurtured For Living News, Nurtured For Living press release','news','<p>Ever since we launched in early 2016, we have been busy. We aim to keep all our customers up to date with all the latest industry related news such as press releases, marketing news, new contracts, new supplier relationships, and even new countries where we are doing business. It’s exciting stuff!</p>\r\n','',NULL,1,2,2,2,'2016-04-09 13:23:05','2016-09-02 19:18:16'),
	(15,'Brands','brands','brands','brands','<p>our&nbsp;brands</p>',NULL,NULL,2,2,2,2,'2016-07-26 16:32:26','2016-07-26 20:03:17'),
	(16,'Retailers','retailers','retailers','retailers','<p>Nurtured for Living have retailers based in all four corners of the globe with whom  we have fostered excellent long-lasting relationships. If you are interested in stocking our products, please <a href=\"contact-us\">get in touch</a>. We are happy to answer any questions you might have and give you more advice on how to become one of Nurtured for Living’s retailers.\r\n</p>\r\n\r\n<p>We look forward to partnering with you and making positive natural, healthy changes together.</p>\r\n','',NULL,2,2,2,2,'2016-07-26 16:33:02','2016-09-07 05:23:41'),
	(17,'Corporate','Our expertise allows us to fulfil large volume orders for catering or local authority\'s snow clearing in line with government standards and requirements.','Nurtured For Living, government relations.','corporate','<p> We at Nurtured for Living pride ourselves on our reputation and our relationships. We believe that business should be a win win situation for all involved. We specialise in the supply of Himalayan Pink Salt directly from the source without any contaminates and additions. Although we supply under our brand as a retailer, we also supply on a wholesale and distributors capacity.\r\n</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Wholesale</h2>\r\n\r\n<p>Our wholesale opportunities are ideal for retailers who are interested in making more of an impact, by stocking high-quality ethically sourced, natural products. If you would like to find out more please <a href=\"contact-us\">contact us today</a> and one of our representatives will be happy to assist you.\r\n</p>\r\n<hr class=\"dashed\">\r\n\r\n<h2>Distribution</h2>\r\n\r\n<p>We pride ourselves in forming healthy relationships with government authorities across the globe; as nothing pleases us more than being able to help communities overcome their transport obstacles during the winter months.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Businesses</h2>\r\n\r\n<p>We pride ourselves in forming healthy relationships with government authorities across the globe; as nothing pleases us more than being able to help communities overcome their transport obstacles during the winter months.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Local Authorities</h2>\r\n\r\n<p> Our expertise allows us to fulfil large volume orders for local authority\'s snow clearing in line with government standards and requirements. We pride ourselves in forming healthy relationships with government authorities across the globe; as nothing pleases us more than being able to help communities overcome their transport obstacles during the winter months.</p>\r\n\r\n<hr class=\"dashed\">','',NULL,2,2,2,2,'2016-07-26 16:33:41','2016-12-23 10:32:52'),
	(18,'Articles','Articles','Articles','articles','<p>In line with our values and beliefs of living a natural, healthy life, our objective is to provide our customers with educational, reliable information related to the products we sell. Stay up to date with the latest health-related news through our series of articles and videos to see how living naturally can transform your life.</p>','',NULL,1,2,2,2,'2016-07-26 16:37:05','2016-09-07 05:17:22'),
	(19,'FAQ\'s','We are here to help. If you have any questions whatsoever, please take a look at the categories below and scroll down until you find the questions and answers you require.','Nurtured For Living, FAQ\'s','faqs','<p>We are here to help. If you have any questions whatsoever, please take a look at the categories below and scroll down until you find the questions and answers you require. Can\'t find your answer? Don\'t worry! <a href=\"contact-us\">Contact us</a>, and one of our friendly customer service representatives will give you all the information you need.</p>','',NULL,1,2,2,2,'2016-07-28 15:05:28','2016-10-05 23:00:56'),
	(21,'Press','Press','Press','press','<p>Press</p>',NULL,NULL,1,2,2,2,'2016-07-28 15:18:11','2016-07-28 15:18:11'),
	(22,'Opportunity','If you are interested in making more of an impact, by stocking high-quality ethically sourced, natural products, then please contact us today and one of our representatives will be happy to assist you.','opportunities to benefit with Nurtured For Living','opportunity','<p>We believe in rewarding those that help contribute to our success, so we developed our \"Many Hands\" program. This program is designed to help our products reach a wider audience and thank those who made it possible. We believe in transparency and fairness, so there\'s nothing hidden and no small print.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h4 class=\"opp-title\">NFL REFERRER</h4>\r\n<p> If you\'re already one of our valued customers, recommend any of our products to your family and friends and they\'ll receive a 10% discount on their first purchase. As a token of appreciation we will also give you a 10% commission of the purchase value. You can use your commissions for product purchases or receive a cash payment.</p>\r\n\r\n<p> To benefit from this opportunity, simply ask your friends and family to enter your registered account email in the referrer box at the time of checkout. Whenever one of your referrals makes a purchase you\'ll receive an email with the details of your commission. You can also view all paid and pending commissions on your user dashboard when logged into your account.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h4 class=\"opp-title\">NFL ADVOCATE</h4>\r\n<p> Why not become a Nurtured For Living advocate and benefit from your hard work. As an advocate  you can earn up to 10% commission of every purchase made by your directly referred retailers, advocates and customers. <b>Registration is free with no monthly or annual fees</b>.</p>\r\n\r\n<p> 1 point is awarded for every £1 spent. The monthly total of all your direct referrals determines the level of commission you will receive.The table below shows the number of qualifying points required for each commission level.</p>\r\n\r\n<table class=\"table table-hover xlarge-margin-top large-margin-bottom\">\r\n<tbody>\r\n<tr>\r\n<th> Points (Monthly)</th>\r\n<th> Commission </th>\r\n</tr>\r\n<tr>\r\n<td> 100 </td>\r\n<td> 10% </td>\r\n</tr>\r\n<tr>\r\n<td> 70-99 </td>\r\n<td> 7% </td>\r\n</tr>\r\n<tr>\r\n<td> 50-69 </td>\r\n<td> 5% </td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n\r\n\r\n<p> To ensure your referrals are correctly linked to your account. After completing the <a href=\"advocate-registration\">registration form</a>, login and click \"Add Referral\" which is displayed on the left, under the User Menu. Your referral will receive a welcome email with their login details and 10% discount voucher.</p>\r\n\r\n<p> Another great benefit about being one of our advocates, is that we will reward you with double points for all of your purchases under our <a href=\"loyalty-scheme\">loyalty scheme</a>.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<p><em>Commissions are calculated at the end of each calendar month and paid at the end of the following month. Full <a href=\"terms-and-conditions#many-hands\">terms and conditions</a>.</em></p>\r\n','',NULL,1,2,2,2,'2016-07-28 15:19:43','2017-07-26 11:29:01'),
	(24,'Terms & Conditions','By using this website or submitting an order (and any subsequent orders) you are agreeing to the terms as outlined below. We reserve the right to update the terms at anytime and it is your responsibility to check for updates.','Nurtured For Living, terms & conditions','terms-and-conditions','<p>Please read these terms and conditions carefully. By using this website or submitting an order (and any subsequent orders) you are agreeing to the terms as outlined below. We reserve the right to update the terms at anytime and it is your responsibility to check for updates. The update date will be displayed at the bottom of the page for your convenience. If you do not agree to these terms, do not use our website</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>WEBSITE USE (1)</h2>\r\n<p><strong>	1.1</strong> This website is operated by Nurtured For Living Ltd (\"we\", \"us\" or \"our\"). Use of our site includes accessing, browsing, or purchasing from NurturedForLiving.com, as a guest or registered user. Other policies are also applicable such as the Privacy Policy, Returns Policy and Disclaimer.</p>\r\n\r\n\r\n<p><strong>1.2</strong> We do not guarantee that our website, or any content published on it, will always be available. We may at any time withdraw or discontinue any part of our site without prior notice. We will not be liable to you if for any reason our site is unavailable at any time or for any period.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>PRICES (2)</h2>\r\n<p><strong>2.1 </strong> The price of goods displayed on the website is the price you will be charged upon completion of your order. The price can change at any time and you will be charged the latest price for any amendments made to your order. As promotions are valid for a limited period, changes made to your order may mean that promotional offers are no longer valid.</p>\r\n\r\n\r\n<p><strong>2.2</strong> Each order may include a delivery charge. If your delivery is subject to a fee, the delivery services will be displayed on the checkout page before you pay for your order. The delivery charge will be dependent upon the total weight of the goods and the delivery service chosen.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>SPECIAL OFFERS, PROMOTIONS &amp; COMPETITIONS (3)</h2>\r\n<p><strong>3.1 </strong> Prices of goods may be reduced under a special offer or promotion. If your order is subject to a price reduction due to a special offer or promotion, your order is still subject to these Terms and Conditions.</p>\r\n\r\n\r\n<p><strong>3.2</strong> We may at any time change the terms of an offer/promotion or withdraw it without prior notice. Orders which are subject to an offer/promotion will be honoured if placed prior to the withdrawal or end of the promotion.</p>\r\n\r\n\r\n<p><strong>3.3</strong> We reserve the right to provide different customers special offers or promotions specifically for them. Offers can not be transferred or redeemed by other customers.</p>\r\n\r\n\r\n<p><strong>3.4</strong> We may at our discretion enrol customers into a competition. Some competitions may also be reserved for a particular type of user. Items received via a contest can not be exchanged or returned for cash.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>PURCHASE CONTRACT (4)</h2>\r\n<p><strong>4.1 </strong> Upon completion of your order, you will receive immediate confirmation via the web browser and the email used at the time of purchase. At this point, the purchase contract will be made and we will supply the ordered goods to the specified address in accordance with these Terms and Conditions.</p>\r\n\r\n\r\n<p><strong>4.2</strong> You must be 16 years or over and possess a valid email address to make a purchase. Your email address will be used to update you with important information about your order and email marketing communication which you can opt-out of at any time.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>PAYMENT METHODS (5)</h2>\r\n<p>We accept debit and credit card payments through PayPal. No account is required. Cash or cheque payments are not accepted.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>ORDER AMENDMENTS AND CANCELLATIONS (6)</h2>\r\n<p><strong>6.1</strong> It is your responsibility to check the items added to your bag carefully before checking out as it is not possible to amend your order after it has been placed.</p>\r\n\r\n\r\n<p><strong>6.2</strong> You have the right to cancel your order up to 14 days from the date of delivery either by phone or email. You will receive a refund for all non-perishable items as long as they are returned to us unopened, unused and in their original packaging. If however, you cancel the order before the goods have been despatched you will receive a full refund minus a 5% administration fee. You are responsible for the cost of returning the items.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>DELIVERY (7)</h2>\r\n<p><strong>7.1</strong> Deliveries will be made to the delivery address entered at the time of checkout. If you need to change the delivery address after you have placed your order, please contact our customer service department immediately. We currently ship worldwide. However, we reserve the right to remove or restrict deliveries to specific countries/areas at any time.</p>\r\n\r\n\r\n<p><strong>7.2</strong> We shall always try to ensure that your order is despatched on time with the correct items and with adequate packaging. If for any reason your order is incomplete or contains items that you did not order, please notify us promptly. You will not be charged for either items and we are only liable for the cost of the goods that have not been delivered.</p>\r\n\r\n\r\n<p><strong>7.3</strong> It is your responsibility to ensure that the appropriate person is available to receive your order. Depending upon the service chosen at the time of checkout, up to 3 attempts will be made to deliver your order. On each attempt, a card will be left with the attempt details and information detailing where you can collect you parcel or how to reschedule delivery.</p>\r\n\r\n\r\n<p><strong>7.4</strong> if your order is delayed or cancelled for any reason beyond our reasonable control, we are only liable for the cost of the goods and the cost of delivery.</p>\r\n\r\n\r\n<p><strong>7.5</strong> We will always attempt to follow any specific delivery instructions you may have given at checkout. However, we expressly disclaim all liability which may arise from following them which includes and is not limited to theft, tampering and contamination. We are not liable should the delivery driver not adhere to the instructions given.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>DEFECTIVE ITEMS &amp; RETURNS (8)</h2>\r\n<p>We guarantee the quality of the goods we despatch. It is your responsibility to inspect your order and notify us immediately of any damages or concerns. We will resolve any issues under of returns and refund policy.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>COMPLAINTS (9)</h2>\r\n<p>Any customer complaints should be sent to Customer Services. Please use the contact form on the contact us page.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>PRIVACY (10)</h2>\r\n<p><strong>10.1</strong>  When you use Nurturedforliving.com, you trust us with your information and we respect your privacy. The personal information that you provide us is held with care and security. We do not sell, rent or transfer this information to third parties. Read our full privacy policy.</p>\r\n\r\n\r\n<p><strong>10.2</strong> When registering for an account you will set a password. If you chose not to create an account during checkout, we will automatically create an account for your convenience. A password will be generated and sent to your email. You are responsible for keeping your password confidential. You can change your password at any time by logging into your account and clicking \"Edit Profile\". We reserve the right to disable your account without warning if we deem that you have violated this term.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>WARRANTY AND LIABILITY (11)</h2>\r\n<p><strong>11.1</strong>  Nothing in these Terms and Conditions will restrict our liability for death or personal injury resulting from our negligence, breach of contract or breach of statutory duty, nor will any of these terms restrict any of your statutory rights. For further information about your statutory rights, contact your local authority Trading Standards Department or Citizen\'s Advice Bureau.</p>\r\n\r\n\r\n<p><strong>11.2</strong> We will not be deemed to be in breach of these Terms and Conditions or contract, as a result of any delay in our performance or failure to perform our obligations, if that delay is due to any cause or circumstance beyond our reasonable control. Including, but not limited to, fire, flood and other acts of God, strike, accident, disruption to energy supplies, acts of terrorism or war, a breakdown of equipment, and road transportation problems. Our maximum liability arising out of any order for the supply of goods to you under this contract will be limited to the retail price of the goods contained in that order.</p>\r\n\r\n\r\n<a name=\"many-hands\"></a> \r\n<p><strong>11.3</strong> Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up-to-date.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n\r\n<h2>MANY HANDS PROGRAM (12)</h2>\r\n\r\n<p><strong>12.1</strong> Only one account is permitted per user. Users who try to create multiple accounts will be permitted to keep their first account and all other accounts will be deleted. Persistent abuse will result in account termination.</p>\r\n\r\n<p><strong>12.2</strong> In the event that a user is referred by more than one advocate, the first referrer will be kept. All others accounts and orders will be merged into the first account.</p>\r\n\r\n<p><strong>12.3</strong> An advocate becomes eligible to receive commission once their account has been created and approved. Any prior referrals will not count towards their \"Many Hands\" network.</p>\r\n\r\n<p><strong>12.4</strong> Orders completely paid for by loyalty points or loyalty vouchers do not count towards advocate commissions.</p>\r\n\r\n<p><strong>12.5</strong> One off referral commissions payments are eligible for payment 30 days after the transaction date. </p>\r\n\r\n\r\n<p><strong>12.6</strong>&nbsp;Advocate commissions are calculated at the end of each calendar month and paid at the end of the following month. </p>\r\n<a name=\"loyalty-scheme\"></a> \r\n<p><strong>12.7</strong> Advocates agree not to misrepresent Nurtured For Living and abide to anti spam regulations. Any advocates who are proven to be in violation of this clause will have their accounts terminated indefinitely.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n\r\n<h2>LOYALTY SCHEME (13)</h2>\r\n<p><strong>13.1</strong> The loyalty scheme is provided at our discretion and can be cancelled at anytime. Participants will be notified 90 days prior to the termination date. We reserve the right to update or amend the terms &nbsp;without prior warning or consent.</p>\r\n\r\n<p><strong>13.2</strong> Participation in the loyalty scheme is acceptance of these terms and conditions.</p>\r\n\r\n<p><strong>13.3</strong> Points can only be redeemed for products. Shipping will be charged separately. Any items which are obtained through the loyalty scheme and subsequently returned can not be refunded. In such cases the points will be credited back to the users account. </p>\r\n\r\n<p><strong>13.4</strong> Points can not be transferred except in the case of the account holder\'s death, in which case the points will transfer to their next of kin.</p>\r\n\r\n<p><strong>13.5</strong> Points can be redeemed at the checkout or converted into loyalty vouchers. Points can only be converted into vouchers when their value exceeds {$amount$}. Once converted into a voucher, the voucher will be valid for 6 months.</p>\r\n\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>GENERAL (14)</h2>\r\n<p><strong>14.1</strong>  Product images used on our website are only a representation of the goods on offer. Actual goods may not be exactly the same dimensions, design or packaging. If you are not happy with any goods received, you have the right to cancel your order, return the goods and receive a full refund.</p>\r\n\r\n\r\n<p><strong>14.2</strong> All copyright belongs to Nurtured For Living LTD. You are permitted to use the content for your personal use, and you may not copy, reproduce, transmit, publish, display, distribute, commercially exploit, use or create derivative works of any content on our site without prior written permission.</p>\r\n\r\n\r\n<p><strong>14.3</strong> You may create links to our website as long as it does not suggest any form of association, approval or endorsement on our part where you have not had prior written consent from us. You can not load or display our website in an iframe nor display our website in a way that damages our reputation.</p>\r\n\r\n\r\n<p><strong>14.4</strong> If any of these Terms and Conditions are deemed to be invalid, unlawful or unenforceable in whole or in part is by a court in the United Kingdom, it will not affect the validity of the remaining terms which will continue to be valid and enforceable to the fullest extent permitted by law.</p>','',NULL,1,2,2,2,'2016-10-24 00:53:57','2017-09-02 12:27:45'),
	(25,'Delivery Information','We ship our products worldwide via a range of parcel and courier companies which are displayed at checkout. All overseas orders are sent registered/recorded post. Orders are despatched for delivery from Monday - Friday.','Nurtured For Living delivery information','delivery-information','<p>We ship our products worldwide via a range of parcel and courier companies which are displayed at checkout. All overseas orders are sent registered/recorded post. Orders are despatched for delivery from Monday - Friday. Orders placed before 2 pm will be sent out the same day, orders placed after 2 pm will be sent out the following day. In special circumstances, some orders maybe prepared and despatched on Saturdays. If you have any specific delivery requirements please <a href=\"contact-us\">contact us</a> before placing your order.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2> Free UK Delivery </h2>\r\n\r\n<p>We offer FREE UK delivery on orders over {free_shipping}. These orders are delivered by standard parcel or courier service depending on the total package size, weight and dimentions. Delivery time is usually between 1-3 days.</p>\r\n\r\n\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2> Delivery</h2>\r\n\r\n<p>There will be three consecutive attempts to deliver your parcel. On each attempt, a card will be left with the attempt details and information related to how to reschedule your delivery or collect your parcel from the relevant collection point. All orders sent via courier can be tracked on the courier\'s website. Tracking details will be sent to you via email when your order is despatched and is also available on the order details page when logged in.</p>\r\n\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2> General Postage Rates</h2>\r\n\r\n<p>We charge a flat rate for all UK postage and packaging, other available postal rates are automatically calculated and displayed at checkout.</p>\r\n\r\n\r\n<table class=\"table no-margin-bottom\">\r\n    <thead>\r\n        <tr>\r\n            <th>Weight</th>\r\n            <th>Fee</th>\r\n            <th>Duration</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n    	<tr><td>0-1.75kg</td><td>£1.99</td><td>2-3 days</td></tr>\r\n    	<tr><td>1.75-10kg</td><td>£3.99</td><td>24h</td></tr>\r\n    	<tr><td>10-20kg</td><td>£5.99</td><td>24h</td></tr>\r\n    	<tr><td>20-32kg</td><td>£7.99</td><td>24h</td></tr>\r\n    </tbody>\r\n</table>\r\n\r\n<hr class=\"dashed\">','',NULL,1,2,2,2,'2016-10-24 02:06:40','2016-12-23 09:49:16'),
	(26,'Returns & Refunds','We want our customers to be happy with the products we supply, if for any reason you are dissatisfied with the delivery, items or customer service you received, please contact us to let us know why. ','Nurtured For Living returns & refunds','returns-and-refunds','<p> We want our customers to be happy with the products we supply, if for any reason you are dissatisfied with the delivery, items or customer service you received, please <a href=\"contact-us\">contact us</a> to let us know why. </p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>Refund (14 day money back guarantee)</h2>\r\n<p>In line with the UK Consumer Rights Act, our customers are eligible for a refund for up to 14 days from the date of receiving their order. This right however, does NOT apply in the following cases.</p>\r\n\r\n<p>\r\n<b>1. Perishable items</b>&nbsp;this includes food and flowers.<br>\r\n<b>2. Made to order</b> or personalised items.<br>\r\n<b>3. DVDs, music and computer software</b> if the seal or packaging has been broken.<br>\r\n<b>4. Underwear</b> or any items that could cause risk to public health if opened or used. <br>\r\n</p>\r\n\r\n<p> To cancel your order and receive your refund, please contact us by phone or email within the cancellation period. Any delivered items should be returned to us unopened, unused and undamaged in their original packaging (Please note that you are responsible for the cost of returning the item if it is not faulty). Your refund for the item/s along with any applicable delivery charges will be returned to you within 14 working days.</p>\r\n\r\n\r\n<p> This does not affect your statutory rights. Please contact your local Citizens\' Advice Bureau or Trading Standards office for more help and support.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n\r\n<h2>Returns (faulty or damaged items)</h2>\r\n\r\n<p>All items are inspected before being despatched and we try extremely hard to ensure that they are packed adequately. In the unlikely event that your items are faulty or damaged upon arrival, please inform us as soon as possible and we will take the necessary steps to resolve the situation.</p>\r\n\r\n<hr class=\"dashed\">\r\n','',NULL,1,2,2,2,'2016-10-24 02:49:35','2016-11-15 17:44:10'),
	(27,'Advocate Registration','1111','1111','advocate-registration','<p>Congratulations on deciding to become one of <a href=\"opportunity\">our valued advocates</a>. Complete the form below and you will receive an email with your login and advocate details, plus information to help you keep track of your progress.</p>','',NULL,1,2,2,2,'2017-04-09 17:19:01','2017-04-09 23:31:30'),
	(28,'Loyalty Scheme','','Nurtured For Living Loyalty Scheme','loyalty-scheme','<p>We believe in rewarding loyalty, so we have created our loyalty program with exciting and exclusive rewards to say \'thank you\' to our amazing customers. You can redeem your points for products or convert them into vouchers to give away to your family and friends.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h2>FAQs </h2> \r\n\r\n\r\n<h4>How do I join Nurtured For Living\'s loyalty scheme?</h4>\r\n<p>A customer account is created with your first purchase and you are automatically enrolled in to our loyalty program.</p>\r\n\r\n<h4>How do I earn loyalty points?</h4>\r\n<p>Each time you make a purchase you earn loyalty points for each product. The amount of points earned may vary and are clearly visible on the product details page.&nbsp;</p>\r\n\r\n<h4>How do I check my loyalty points balance and redeem rewards?</h4>\r\n<p>Each time you shop online, you will receive an electronic invoice via email with the amount of points earned for that specific purchase and your loyalty points balance. Your balance is also displayed on your account overview page or you can click the \"Points &amp; Vouchers\" link in the USER MENU.</p>\r\n\r\n<h4>How do I use my rewards?</h4>\r\n<p>You have the option to redeem your points at checkout by clicking the \"Redeem Points\" button (you must be logged-in) or you can convert your points into vouchers to use yourself or give away to your friends and family. To convert points into vouchers click the \"Points &amp; Vouchers\" link in the USER MENU, select the required voucher amount from the drop-down list and click convert. A voucher code will be created and added to the list below.</p>\r\n\r\n<hr class=\"dashed\">\r\n\r\n<h4>Terms and Conditions </h4>\r\n\r\n<p><small>View full <a href=\"terms-and-conditions#loyalty-scheme\">terms and conditions</a></small></p>\r\n','',NULL,1,2,2,2,'2017-04-12 17:58:57','2017-09-02 19:06:23');

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permission_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_categories`;

CREATE TABLE `permission_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permission_categories` WRITE;
/*!40000 ALTER TABLE `permission_categories` DISABLE KEYS */;

INSERT INTO `permission_categories` (`id`, `name`, `status`, `position`, `created_at`, `updated_at`)
VALUES
	(1,'Permissions',1,1,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(2,'Articles',1,2,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(3,'CMS Pages',1,3,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(4,'Users',1,4,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(5,'Roles',1,5,'2016-03-10 11:39:40','2016-03-10 11:39:40'),
	(6,'Quotes',1,6,'2016-03-22 12:23:40','2016-03-22 12:23:40'),
	(7,'Products',1,7,'2016-06-07 03:11:25','2016-06-07 03:11:25'),
	(8,'Orders',1,8,'2016-06-07 03:11:47','2016-06-07 03:11:47');

/*!40000 ALTER TABLE `permission_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permission_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `slug`, `category_id`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'View Users',' view-users',1,'Grant access to view users only','2016-02-26 07:44:51','2016-02-28 08:52:28'),
	(2,'Edit Articles','edit-articles',1,'To edit must have view permissions','2016-02-26 07:44:52','2016-03-22 11:08:07'),
	(3,'She was moving.56d0027404dc2','she-was-moving56d0027404dc2',1,'Hatter said, tossing his head sadly. \'Do I look like one, but the Dormouse shall!\' they both sat.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(4,'Alice)--\'and.56d0027408b95','alice-and56d0027408b95',1,'Alice, that she had a large arm-chair at one and then nodded. \'It\'s no business there, at any rate.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(5,'Good-bye, feet!\'.56d002740c66e','good-bye-feet56d002740c66e',1,'The door led right into a conversation. Alice replied, rather shyly, \'I--I hardly know, sir, just.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(6,'She had already.56d00274107c0','she-had-already56d00274107c0',1,'HER about it.\' \'She\'s in prison,\' the Queen furiously, throwing an inkstand at the sudden change,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(7,'She took down a.56d0027414cd8','she-took-down-a56d0027414cd8',1,'Mock Turtle, \'Drive on, old fellow! Don\'t be all day to day.\' This was such a puzzled expression.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(8,'No, it\'ll never do.56d0027418775','no-itll-never-do56d0027418775',1,'French lesson-book. The Mouse did not much larger than a rat-hole: she knelt down and began to.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(9,'It was so small as.56d002741c2db','it-was-so-small-as56d002741c2db',2,'Duchess\'s voice died away, even in the pool as it can be,\' said the King. On this the whole party.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(10,'No room!\' they.56d002742019a','no-room-they56d002742019a',2,'No, no! You\'re a serpent; and there\'s no harm in trying.\' So she stood looking at it again: but he.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(11,'This seemed to.56d002742438f','this-seemed-to56d002742438f',2,'Alice, \'because I\'m not Ada,\' she said, \'than waste it in the sea!\' cried the Gryphon. \'Of.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(12,'I\'m sure _I_.56d0027428360','im-sure-i-56d0027428360',2,'There was a large ring, with the end of his pocket, and pulled out a new kind of thing never.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(13,'Gryphon, \'you.56d002742c75b','gryphon-you56d002742c75b',2,'I\'m not Ada,\' she said, \'for her hair goes in such confusion that she had somehow fallen into the.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(14,'King eagerly, and.56d0027430e20','king-eagerly-and56d0027430e20',2,'Alice as she said to the little magic bottle had now had its full effect, and she heard it say to.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(15,'I say--that\'s the.56d0027435c6e','i-say-thats-the56d0027435c6e',2,'Alice loudly. \'The idea of having nothing to what I say,\' the Mock Turtle went on, \'and most of.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(16,'White Rabbit was.56d002743b27b','white-rabbit-was56d002743b27b',3,'And the Eaglet bent down its head to feel which way it was impossible to say it over) \'--yes,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(17,'Pigeon went on,.56d002743f3a4','pigeon-went-on56d002743f3a4',3,'There\'s no pleasing them!\' Alice was beginning to think to herself, \'because of his pocket, and.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(18,'EVEN finish, if he.56d0027443220','even-finish-if-he56d0027443220',3,'I think?\' he said to Alice, that she began again. \'I wonder how many miles I\'ve fallen by this.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(19,'Alice remarked..56d00274474f5','alice-remarked56d00274474f5',3,'Which shall sing?\' \'Oh, YOU sing,\' said the Hatter, \'I cut some more bread-and-butter--\' \'But what.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(20,'I can find out the.56d002744b4d7','i-can-find-out-the56d002744b4d7',3,'IN the well,\' Alice said very politely, feeling quite pleased to find herself talking familiarly.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(21,'She was a little.56d002744f910','she-was-a-little56d002744f910',3,'I\'m Mabel, I\'ll stay down here till I\'m somebody else\"--but, oh dear!\' cried Alice again, in a.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(22,'I get\" is the.56d0027453e77','i-get-is-the56d0027453e77',3,'William the Conqueror.\' (For, with all their simple sorrows, and find a pleasure in all my life,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(23,'And beat him when.56d0027458569','and-beat-him-when56d0027458569',3,'What would become of me? They\'re dreadfully fond of pretending to be listening, so she tried to.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(24,'March Hare. \'He.56d002745c9ee','march-hare-he56d002745c9ee',3,'The King\'s argument was, that her idea of having nothing to do: once or twice, half hoping she.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(25,'For this must be.56d0027460b39','for-this-must-be56d0027460b39',4,'I was going to shrink any further: she felt that she did not see anything that looked like the.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(26,'Said the mouse.56d0027464ba9','said-the-mouse56d0027464ba9',4,'March Hare. Alice sighed wearily. \'I think I can reach the key; and if I would talk on such a.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(27,'Majesty must.56d002746ae0e','majesty-must56d002746ae0e',4,'I\'ve tried banks, and I\'ve tried banks, and I\'ve tried banks, and I\'ve tried banks, and I\'ve tried.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(28,'I may as well to.56d002746ee68','i-may-as-well-to56d002746ee68',4,'The Hatter looked at it uneasily, shaking it every now and then, \'we went to school in the air..','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(29,'How I wonder if I.56d0027473200','how-i-wonder-if-i56d0027473200',4,'Alice, \'but I know who I WAS when I got up this morning? I almost wish I\'d gone to see it quite.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(30,'Alice considered a.56d0027477565','alice-considered-a56d0027477565',4,'Dormouse, not choosing to notice this question, but hurriedly went on, \'--likely to win, that it\'s.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(31,'Alice thought the.56d002747b79b','alice-thought-the56d002747b79b',4,'Fainting in Coils.\' \'What was THAT like?\' said Alice. \'Of course it was,\' the March Hare. Alice.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(32,'Either the well.56d002747fb43','either-the-well56d002747fb43',4,'Australia?\' (and she tried another question. \'What sort of meaning in it,\' but none of them.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(33,'I hate cats and.56d0027483a38','i-hate-cats-and56d0027483a38',4,'Which way?\', holding her hand on the ground near the King was the first to speak. \'What size do.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(34,'Alice very.56d0027487ba0','alice-very56d0027487ba0',5,'Mock Turtle. So she began thinking over all she could not possibly reach it: she could guess, she.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(35,'Cat, and vanished.56d002748bc91','cat-and-vanished56d002748bc91',5,'I shan\'t grow any more--As it is, I can\'t show it you myself,\' the Mock Turtle. \'Certainly not!\'.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(36,'First, she tried.56d0027490537','first-she-tried56d0027490537',5,'Let me see: I\'ll give them a new idea to Alice, flinging the baby at her side. She was a very.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(37,'Gryphon. \'They.56d002749479a','gryphon-they56d002749479a',5,'Presently she began again: \'Ou est ma chatte?\' which was a most extraordinary noise going on.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(38,'Alice said very.56d0027498bc6','alice-said-very56d0027498bc6',5,'And beat him when he pleases!\' CHORUS. \'Wow! wow! wow!\' \'Here! you may stand down,\' continued the.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(39,'And she squeezed.56d002749d07e','and-she-squeezed56d002749d07e',5,'I wonder if I chose,\' the Duchess by this time, and was immediately suppressed by the English, who.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(40,'Lory hastily. \'I.56d00274a1569','lory-hastily-i56d00274a1569',5,'PLEASE mind what you\'re talking about,\' said Alice. \'Well, then,\' the Cat in a minute or two..','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(41,'I am very tired of.56d00274a5b06','i-am-very-tired-of56d00274a5b06',5,'The great question certainly was, what? Alice looked very anxiously into its face to see it trying.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(42,'YOU are, first.\'.56d00274aa12f','you-are-first56d00274aa12f',6,'I know is, something comes at me like a serpent. She had not the smallest idea how to begin.\' He.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(43,'Hatter, and, just.56d00274ae7ae','hatter-and-just56d00274ae7ae',6,'QUITE as much as she spoke. (The unfortunate little Bill had left off quarrelling with the glass.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(44,'I only wish people.56d00274b33f7','i-only-wish-people56d00274b33f7',6,'Alice knew it was as steady as ever; Yet you balanced an eel on the whole thing very absurd, but.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(45,'King said, turning.56d00274b7da4','king-said-turning56d00274b7da4',6,'Alice, seriously, \'I\'ll have nothing more happened, she decided on going into the air. \'--as far.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(46,'Hatter replied..56d00274bc27a','hatter-replied56d00274bc27a',6,'Alice began in a whisper.) \'That would be only rustling in the other: the Duchess was sitting on a.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(47,'On which Seven.56d00274c06c8','on-which-seven56d00274c06c8',6,'Shakespeare, in the court!\' and the White Rabbit, trotting slowly back to them, and was just.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(48,'King. \'Nearly two.56d00274c4ad1','king-nearly-two56d00274c4ad1',6,'She was moving them about as curious as it can\'t possibly make me smaller, I suppose.\' So she.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(49,'I don\'t want YOU.56d00274c918d','i-dont-want-you56d00274c918d',6,'Alice. \'I wonder what I used to it in with the dream of Wonderland of long ago: and how she was.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(50,'And she tried.56d00274cdc75','and-she-tried56d00274cdc75',6,'The baby grunted again, and did not quite sure whether it was done. They had not long to doubt,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(51,'King repeated.56d00274d22a6','king-repeated56d00274d22a6',6,'I only wish they WOULD put their heads off?\' shouted the Queen. \'You make me giddy.\' And then,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(52,'Alice quite hungry.56d00274d6741','alice-quite-hungry56d00274d6741',6,'I\'ll have you executed, whether you\'re a little timidly, \'why you are very dull!\' \'You ought to be.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(53,'Duchess, \'chop off.56d00274da9e8','duchess-chop-off56d00274da9e8',6,'Mouse gave a look askance-- Said he thanked the whiting kindly, but he now hastily began again,.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(54,'LITTLE BUSY BEE,\".56d00274dede3','little-busy-bee56d00274dede3',6,'Hatter hurriedly left the court, arm-in-arm with the day of the house opened, and a great hurry to.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(55,'Lobster Quadrille.56d00274e322a','lobster-quadrille56d00274e322a',6,'No accounting for tastes! Sing her \"Turtle Soup,\" will you, won\'t you, will you, won\'t you join.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(56,'I used to queer.56d00274e7d4c','i-used-to-queer56d00274e7d4c',6,'Gryphon: and Alice was just in time to be true): If she should meet the real Mary Ann, and be.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(57,'Alice thought to.56d00274ec691','alice-thought-to56d00274ec691',6,'Hatter, with an M, such as mouse-traps, and the Dormouse again, so that it was the first really.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(58,'The question is,.56d00274f0f45','the-question-is56d00274f0f45',6,'Alice said very politely, \'if I had it written down: but I don\'t like the name: however, it only.','2016-02-26 07:44:52','2016-02-26 07:44:52'),
	(59,'I will tell you.56d0027501538','i-will-tell-you56d0027501538',6,'Queen to-day?\' \'I should like to be sure! However, everything is to-day! And yesterday things went.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(60,'Between yourself.56d0027505f4c','between-yourself56d0027505f4c',6,'Alice. \'I\'M not a mile high,\' said Alice. \'Of course not,\' Alice replied thoughtfully. \'They have.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(61,'I shall never get.56d002750a546','i-shall-never-get56d002750a546',6,'Oh, I shouldn\'t like THAT!\' \'Oh, you can\'t swim, can you?\' he added, turning to the baby, it was.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(62,'Alice: \'I don\'t.56d002750f2f1','alice-i-dont56d002750f2f1',6,'Queen\'s voice in the world go round!\"\' \'Somebody said,\' Alice whispered, \'that it\'s done by.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(63,'Rabbit in a.56d0027513ea9','rabbit-in-a56d0027513ea9',6,'I only knew the name of the song. \'What trial is it?\' The Gryphon sat up and leave the room, when.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(64,'Mouse. \'Of.56d0027518739','mouse-of56d0027518739',6,'The Duchess took no notice of her own courage. \'It\'s no use speaking to a mouse: she had nibbled.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(65,'Alice hastily.56d002751c901','alice-hastily56d002751c901',6,'Cat: \'we\'re all mad here. I\'m mad. You\'re mad.\' \'How do you mean \"purpose\"?\' said Alice. \'Come on,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(66,'The Queen turned.56d0027521025','the-queen-turned56d0027521025',6,'I\'m not looking for it, you know.\' He was an old crab, HE was.\' \'I never saw one, or heard of.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(67,'The table was a.56d00275252c0','the-table-was-a56d00275252c0',6,'Mock Turtle went on. \'Would you tell me,\' said Alice, \'because I\'m not the smallest notice of her.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(68,'YOUR shoes done.56d0027529c1e','your-shoes-done56d0027529c1e',6,'I beg your acceptance of this remark, and thought to herself. \'I dare say there may be ONE.\' \'One,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(69,'King, and the.56d002752e9d2','king-and-the56d002752e9d2',6,'And pour the waters of the court, without even looking round. \'I\'ll fetch the executioner myself,\'.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(70,'At this moment.56d0027532fd8','at-this-moment56d0027532fd8',6,'He looked anxiously round, to make out exactly what they said. The executioner\'s argument was,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(71,'What happened to.56d00275378ec','what-happened-to56d00275378ec',6,'Adventures of hers that you have of putting things!\' \'It\'s a friend of mine--a Cheshire Cat,\' said.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(72,'I know I do!\' said.56d002753cc1c','i-know-i-do-said56d002753cc1c',6,'Gryphon went on. Her listeners were perfectly quiet till she had asked it aloud; and in THAT.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(73,'I fell off the.56d0027541547','i-fell-off-the56d0027541547',6,'I to get to,\' said the Hatter. This piece of evidence we\'ve heard yet,\' said the Mock Turtle. \'No,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(74,'NEVER come to the.56d00275462b7','never-come-to-the56d00275462b7',6,'Prizes!\' Alice had no pictures or conversations in it, \'and what is the driest thing I ask! It\'s.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(75,'SHE, of course,\'.56d002754a8be','she-of-course56d002754a8be',6,'Queen in a hurried nervous manner, smiling at everything that was said, and went stamping about,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(76,'Hatter. \'Does YOUR.56d002754ef58','hatter-does-your56d002754ef58',6,'Alice, \'because I\'m not myself, you see.\' \'I don\'t see any wine,\' she remarked. \'It tells the day.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(77,'Caterpillar\'s.56d0027553849','caterpillars56d0027553849',6,'Alice in a soothing tone: \'don\'t be angry about it. And yet I don\'t know,\' he went on again:-- \'I.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(78,'Alice could think.56d00275580a1','alice-could-think56d00275580a1',6,'WHAT? The other guests had taken advantage of the jurymen. \'No, they\'re not,\' said Alice very.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(79,'MYSELF, I\'m.56d002755c9ef','myself-im56d002755c9ef',6,'Nobody moved. \'Who cares for fish, Game, or any other dish? Who would not stoop? Soup of the.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(80,'Alice had no.56d00275610e1','alice-had-no56d00275610e1',6,'I\'ve got to?\' (Alice had been found and handed back to the King, the Queen, pointing to Alice for.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(81,'After a while,.56d0027565945','after-a-while56d0027565945',6,'WHAT are you?\' said the White Rabbit: it was her turn or not. So she called softly after it, and.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(82,'Alice. \'Nothing.56d0027569d14','alice-nothing56d0027569d14',6,'Majesty must cross-examine THIS witness.\' \'Well, if I chose,\' the Duchess sneezed occasionally;.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(83,'Mouse was swimming.56d002756e55f','mouse-was-swimming56d002756e55f',6,'Cheshire Cat, she was always ready to sink into the Dormouse\'s place, and Alice thought to.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(84,'Then came a.56d0027572de6','then-came-a56d0027572de6',6,'Elsie, Lacie, and Tillie; and they lived at the house, \"Let us both go to law: I will tell you.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(85,'I shall be.56d00275778b7','i-shall-be56d00275778b7',6,'THEN--she found herself safe in a low voice, to the cur, \"Such a trial, dear Sir, With no jury or.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(86,'Between yourself.56d002757c385','between-yourself56d002757c385',6,'So she called softly after it, \'Mouse dear! Do come back and finish your story!\' Alice called.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(87,'It\'ll be no chance.56d0027580a15','itll-be-no-chance56d0027580a15',6,'I should have croqueted the Queen\'s voice in the last word with such sudden violence that Alice.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(88,'Rabbit coming to.56d00275852f3','rabbit-coming-to56d00275852f3',6,'Alice, who felt very glad to find that the hedgehog to, and, as there was no label this time it.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(89,'Presently she.56d0027589b06','presently-she56d0027589b06',6,'Alice heard the Rabbit began. Alice gave a little of her or of anything to say, she simply bowed,.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(90,'Alice went on,.56d002758ebee','alice-went-on56d002758ebee',6,'Dodo, pointing to the waving of the month, and doesn\'t tell what o\'clock it is!\' As she said to.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(91,'Gryphon. \'Well, I.56d0027593894','gryphon-well-i56d0027593894',6,'That your eye was as steady as ever; Yet you balanced an eel on the breeze that followed them, the.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(92,'Queen. \'Sentence.56d00275984c4','queen-sentence56d00275984c4',6,'Seven flung down his cheeks, he went on, looking anxiously about her. \'Oh, do let me hear the.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(93,'VERY good.56d002759cd82','very-good56d002759cd82',6,'I am very tired of being such a capital one for catching mice you can\'t take more.\' \'You mean you.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(94,'Alice guessed in a.56d00275a1e27','alice-guessed-in-a56d00275a1e27',6,'Soup does very well as she heard was a large arm-chair at one end of his Normans--\" How are you.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(95,'Her first idea was.56d00275a6754','her-first-idea-was56d00275a6754',6,'Gryphon repeated impatiently: \'it begins \"I passed by his garden, and marked, with one of them.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(96,'Duchess: you\'d.56d00275abac3','duchess-youd56d00275abac3',6,'Pray, what is the capital of Paris, and Paris is the same thing as a lark, And will talk in.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(97,'Allow me to.56d00275b04bb','allow-me-to56d00275b04bb',6,'I\'ll write one--but I\'m grown up now,\' she added in a louder tone. \'ARE you to get an opportunity.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(98,'All this time she.56d00275b4fd2','all-this-time-she56d00275b4fd2',6,'However, she did it so VERY nearly at the other, and growing sometimes taller and sometimes she.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(99,'I eat one of them.56d00275bab43','i-eat-one-of-them56d00275bab43',6,'Alice said very humbly; \'I won\'t interrupt again. I dare say there may be different,\' said Alice;.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(100,'Seaography: then.56d00275bf0da','seaography-then56d00275bf0da',6,'It did so indeed, and much sooner than she had never forgotten that, if you cut your finger VERY.','2016-02-26 07:44:53','2016-02-26 07:44:53'),
	(101,'Add Coach Coarse','add-coach-coasre',6,'allows user to add coach coarses','2016-02-28 11:02:25','2016-02-28 11:02:25'),
	(102,'see ibrahim','see-ibrahim',6,'allow me to see ibrahim','2016-03-22 11:00:32','2016-03-22 11:00:32'),
	(103,'Use global search','use-global-search',6,'use global search','2016-03-22 11:54:37','2016-03-22 11:54:37'),
	(104,'test Slug is HERE','test-slug-is-here',6,'sadasd','2016-03-22 12:54:58','2016-03-22 12:54:58'),
	(105,'Remove Me From here','remove-me-from-here',6,'Remove Me From here','2016-03-22 13:07:56','2016-03-22 13:07:56');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table press_files
# ------------------------------------------------------------

DROP TABLE IF EXISTS `press_files`;

CREATE TABLE `press_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table product_reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table quotes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quotes`;

CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quote` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table referral_commissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `referral_commissions`;

CREATE TABLE `referral_commissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referrer_id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commission` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `referral_commissions` WRITE;
/*!40000 ALTER TABLE `referral_commissions` DISABLE KEYS */;

INSERT INTO `referral_commissions` (`id`, `referrer_id`, `referral_id`, `order_id`, `commission`, `status`, `created_at`, `updated_at`)
VALUES
	(4,1,16,'29',4.77,0,'2017-04-20 15:31:20','2017-04-20 15:31:20'),
	(8,1,17,'30',5.31,0,'2017-04-20 17:44:13','2017-04-20 17:44:13'),
	(9,1,17,'30',5.31,0,'2017-04-20 17:44:21','2017-04-20 17:44:21'),
	(10,2,1,'33',1.65,0,'2017-05-18 15:17:29','2017-05-18 15:17:29'),
	(11,2,1,'45',3.69,0,'2017-07-12 20:12:28','2017-07-12 20:12:28'),
	(12,2,1,'48',2.80,0,'2017-07-14 13:34:30','2017-07-14 13:34:30');

/*!40000 ALTER TABLE `referral_commissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table referrers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `referrers`;

CREATE TABLE `referrers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `referrer_id` int(11) NOT NULL,
  `referral_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `referrers` WRITE;
/*!40000 ALTER TABLE `referrers` DISABLE KEYS */;

INSERT INTO `referrers` (`id`, `referrer_id`, `referral_id`, `created_at`, `updated_at`)
VALUES
	(1,1,6,'2017-04-17 14:51:17','2017-04-17 14:51:17'),
	(2,1,7,'2017-04-17 15:13:00','2017-04-17 15:13:00'),
	(3,1,8,'2017-04-17 15:13:14','2017-04-17 15:13:14'),
	(4,1,9,'2017-04-17 15:32:40','2017-04-17 15:32:40');

/*!40000 ALTER TABLE `referrers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table related_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `related_products`;

CREATE TABLE `related_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `related_product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `related_products` WRITE;
/*!40000 ALTER TABLE `related_products` DISABLE KEYS */;

INSERT INTO `related_products` (`id`, `product_id`, `related_product_id`)
VALUES
	(1,1,2),
	(2,1,3),
	(3,1,4),
	(4,1,7),
	(5,2,1),
	(6,2,3),
	(7,2,4),
	(8,2,6),
	(9,2,7),
	(10,3,1),
	(11,3,2),
	(12,3,4),
	(13,3,6),
	(14,3,7),
	(15,4,1),
	(16,4,2),
	(17,4,3),
	(18,4,7),
	(19,6,1),
	(20,6,2),
	(21,6,7),
	(22,7,1),
	(23,7,2),
	(24,7,4),
	(25,7,6),
	(26,7,3),
	(27,6,3);

/*!40000 ALTER TABLE `related_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table retailers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `retailers`;

CREATE TABLE `retailers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `region` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `head_office` text COLLATE utf8_unicode_ci NOT NULL,
  `delivery_address` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `displayed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table role_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`)
VALUES
	(2,1,3,NULL,NULL),
	(3,1,2,NULL,NULL),
	(4,2,4,NULL,NULL),
	(5,3,4,NULL,NULL),
	(6,10,4,NULL,NULL),
	(8,12,4,NULL,NULL),
	(9,13,4,NULL,NULL),
	(10,14,4,NULL,NULL),
	(11,15,4,NULL,NULL),
	(12,16,4,NULL,NULL),
	(13,17,4,NULL,NULL),
	(14,18,4,NULL,NULL);

/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','admin','Administrator of day to day tasks','2016-02-26 07:45:05','2016-06-10 12:14:37'),
	(2,'Main Admin','main-admin','Top level administrator, can access all area of the website','2016-02-26 13:43:28','2016-06-10 12:15:16'),
	(3,'Author','author','Contributes to writing website articles.','2016-02-26 07:45:05','2016-06-10 12:13:57'),
	(4,'User','user','General user. Users are automatically created with this role','2016-02-28 09:12:07','2016-06-10 12:16:27');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_discount_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_discount_codes`;

CREATE TABLE `shop_discount_codes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assigned_to_user` int(11) DEFAULT NULL,
  `multiple_use` tinyint(1) DEFAULT '0',
  `discount_amount` int(11) DEFAULT NULL,
  `discount_type` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `voucher_type` tinyint(4) DEFAULT '2',
  `status` tinyint(4) DEFAULT '2',
  `valid_from` datetime DEFAULT NULL,
  `valid_until` datetime DEFAULT NULL,
  `used_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `commissionable` tinyint(1) DEFAULT '0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_discount_codes` WRITE;
/*!40000 ALTER TABLE `shop_discount_codes` DISABLE KEYS */;

INSERT INTO `shop_discount_codes` (`id`, `code`, `assigned_to_user`, `multiple_use`, `discount_amount`, `discount_type`, `voucher_type`, `status`, `valid_from`, `valid_until`, `used_date`, `user_id`, `commissionable`, `created_by`, `created_at`, `updated_at`)
VALUES
	(1,'LAUNCH2016',NULL,1,20,'percent',1,1,'2016-11-01 00:00:00','2017-01-01 00:00:00',NULL,NULL,0,'1','2016-11-26 02:05:52','2016-11-26 02:05:52'),
	(2,'HEALTHFITNESS',NULL,1,15,'percent',1,1,'2017-01-17 00:00:00','2018-01-17 00:00:00',NULL,NULL,0,'1','2017-01-27 15:15:42','2017-01-27 15:16:45'),
	(16,'abulayla',NULL,1,10,'percent',3,1,NULL,NULL,NULL,NULL,1,'1','2017-01-27 15:15:42','2017-04-20 13:36:46'),
	(53,'LV1-22074529',NULL,2,5,'amount',2,1,'2017-05-22 07:45:29','2017-11-22 07:45:29',NULL,1,0,'1','2017-05-22 07:45:29','2017-05-22 07:45:29'),
	(54,'LV1-22075125',NULL,2,5,'amount',2,1,'2017-05-22 07:51:24','2017-11-22 07:51:24',NULL,1,0,'1','2017-05-22 07:51:25','2017-05-22 07:51:25'),
	(55,'LV1-22075132',NULL,2,5,'amount',2,1,'2017-05-22 07:51:32','2017-11-22 07:51:32',NULL,1,0,'1','2017-05-22 07:51:32','2017-05-22 07:51:32'),
	(65,'LV1-12050520',NULL,2,50,'amount',2,1,'2017-06-12 05:05:20','2017-12-12 05:05:20',NULL,1,0,'1','2017-06-12 17:05:20','2017-06-12 17:05:20'),
	(66,'LV1-12050533',NULL,2,100,'amount',2,1,'2017-06-12 05:05:33','2017-12-12 05:05:33',NULL,1,0,'1','2017-06-12 17:05:33','2017-06-12 17:05:33'),
	(67,'LV1-12050606',NULL,2,25,'amount',2,1,'2017-06-12 05:06:06','2017-12-12 05:06:06',NULL,1,0,'1','2017-06-12 17:06:06','2017-06-12 17:06:06'),
	(68,'LV1-12050613',NULL,2,5,'amount',2,1,'2017-06-12 05:06:13','2017-12-12 05:06:13',NULL,1,0,'1','2017-06-12 17:06:13','2017-06-12 17:06:13'),
	(69,'LV1-14114757',NULL,2,5,'amount',2,1,'2017-07-14 11:47:57','2018-01-14 11:47:57',NULL,1,0,'1','2017-07-14 11:47:57','2017-07-14 11:47:57'),
	(70,'LV1-14011009',NULL,2,5,'amount',2,1,'2017-07-14 01:10:09','2018-01-14 01:10:09',NULL,1,0,'1','2017-07-14 13:10:09','2017-07-14 13:10:09'),
	(71,'LV1-20023338',NULL,2,100,'amount',2,1,'2017-07-20 02:33:38','2018-01-20 02:33:38',NULL,1,0,'1','2017-07-20 14:33:38','2017-07-20 14:33:38'),
	(72,'LV1-20023640',NULL,2,50,'amount',2,1,'2017-07-20 02:36:40','2018-01-20 02:36:40',NULL,1,0,'1','2017-07-20 14:36:40','2017-07-20 14:36:40'),
	(73,'TESTING',NULL,2,30,'percent',1,1,'2016-12-01 00:00:00','2017-12-12 00:00:00',NULL,NULL,0,'1','2017-10-26 17:08:55','2017-10-26 17:08:55');

/*!40000 ALTER TABLE `shop_discount_codes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_favorites_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_favorites_products`;

CREATE TABLE `shop_favorites_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `shop_product_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table shop_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_orders`;

CREATE TABLE `shop_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_note` text COLLATE utf8_unicode_ci,
  `price` double(8,2) NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci,
  `points_earned` int(11) DEFAULT '0',
  `points_redeemed` int(11) DEFAULT NULL,
  `redeemed_value` double(8,2) DEFAULT NULL,
  `voucher` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `courier` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `shipping_method_id` int(10) unsigned NOT NULL,
  `shipping_method_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_fee` double(8,2) NOT NULL,
  `ship_date` date DEFAULT NULL,
  `taxt` double(8,2) NOT NULL,
  `payment_method` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `tracked` tinyint(4) DEFAULT NULL,
  `tracking_ref` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meta` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_shipped` tinyint(1) NOT NULL DEFAULT '0',
  `email_cancelled` tinyint(1) NOT NULL DEFAULT '0',
  `email_refunded` tinyint(1) NOT NULL DEFAULT '0',
  `redeem` tinyint(4) DEFAULT '0',
  `redeem_price` double(8,2) DEFAULT NULL,
  `redeem_point` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_orders_user_id_index` (`user_id`),
  KEY `shop_orders_shipping_method_id_index` (`shipping_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_orders` WRITE;
/*!40000 ALTER TABLE `shop_orders` DISABLE KEYS */;

INSERT INTO `shop_orders` (`id`, `token`, `order_number`, `user_id`, `customer_name`, `invoice_email`, `customer_phone`, `customer_address`, `customer_state`, `customer_city`, `zip_code`, `customer_country`, `customer_note`, `admin_note`, `price`, `discount`, `delivery`, `currency`, `items`, `points_earned`, `points_redeemed`, `redeemed_value`, `voucher`, `courier`, `shipping_method_id`, `shipping_method_name`, `ship_fee`, `ship_date`, `taxt`, `payment_method`, `status`, `tracked`, `tracking_ref`, `created_at`, `updated_at`, `meta`, `email_shipped`, `email_cancelled`, `email_refunded`, `redeem`, `redeem_price`, `redeem_point`)
VALUES
	(48,'598535968c833ea297','NFL-17000048',1,'Muhammad Angus','m@kedstudio.com','07933 018 324','37 Lynwood Road',NULL,'London','SW17 8SB','United Kingdom','',NULL,27.95,'0','3.99','GBP','[{\"id\":4,\"name\":\"Pink Himalayan Bath Salt 2kg \",\"quantity\":1,\"price\":\"8.99\",\"slug\":\"pink-himalayan-bath-salt-2kg\",\"points\":20},{\"id\":3,\"name\":\"Pink Himalayan Salt Coarse 1kg \",\"quantity\":1,\"price\":\"7.49\",\"slug\":\"pink-himalayan-salt-coarse1kg\",\"points\":14},{\"id\":1,\"name\":\"Pink Himalayan Salt Fine 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-fine-500g\",\"points\":8},{\"id\":7,\"name\":\"Pink Himalayan Salt Coarse 250g \",\"quantity\":1,\"price\":\"2.49\",\"slug\":\"pink-himalayan-salt-coarse-250g\",\"points\":4},{\"id\":2,\"name\":\"Pink Himalayan Salt Coarse 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-coarse-500g\",\"points\":8}]',54,NULL,NULL,NULL,'Royal Mail',17,'Standard',3.99,NULL,0.00,0,1,NULL,NULL,'2017-07-14 13:33:39','2017-07-14 13:34:35','{\"TOKEN\":\"EC-4H343368NR387625U\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2017-07-14T13:34:35Z\",\"CORRELATIONID\":\"59460feb3e0b7\",\"ACK\":\"SuccessWithWarning\",\"VERSION\":\"119.0\",\"BUILD\":\"36361320\",\"L_ERRORCODE0\":\"11607\",\"L_SHORTMESSAGE0\":\"Duplicate R',0,0,0,0,NULL,NULL),
	(52,'307265985bb5b2e8c6','NFL-17000052',1,'Muhammad Angus','m@kedstudio.com','07933 018 324','37 Lynwood Road',NULL,'London','SW17 8SB','United Kingdom','',NULL,6.49,'0','3.99','GBP','[{\"id\":3,\"name\":\"Pink Himalayan Salt Coarse 1kg \",\"quantity\":1,\"price\":\"6.49\",\"slug\":\"pink-himalayan-salt-coarse1kg\",\"points\":14},{\"id\":4,\"name\":\"Pink Himalayan Bath Salt 2kg \",\"quantity\":1,\"price\":\"7.99\",\"slug\":\"pink-himalayan-bath-salt-2kg\",\"points\":20},{\"id\":2,\"name\":\"Pink Himalayan Salt Coarse 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-coarse-500g\",\"points\":8},{\"id\":7,\"name\":\"Pink Himalayan Salt Coarse 250g \",\"quantity\":1,\"price\":\"2.49\",\"slug\":\"pink-himalayan-salt-coarse-250g\",\"points\":4},{\"id\":1,\"name\":\"Pink Himalayan Salt Fine 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-fine-500g\",\"points\":8}]',54,NULL,NULL,NULL,'Royal Mail',17,'Standard',3.99,NULL,0.00,0,1,NULL,NULL,'2017-08-05 12:34:35','2017-08-05 12:36:49','{\"TOKEN\":\"EC-6D752031SJ0329449\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2017-08-05T12:36:49Z\",\"CORRELATIONID\":\"24854a71aa0ec\",\"ACK\":\"SuccessWithWarning\",\"VERSION\":\"119.0\",\"BUILD\":\"000000\",\"L_ERRORCODE0\":\"11607\",\"L_SHORTMESSAGE0\":\"Duplicate Req',0,0,0,1,19.46,973),
	(53,'1694359ac3b20dac7f','NFL-17000053',1,'Micah Angus','m@kedstudio.com','07933 018 324','37 Lynwood Road',NULL,'London','SW17 8SB','United Kingdom','',NULL,13.47,'0','3.99','GBP','[{\"id\":3,\"name\":\"Pink Himalayan Salt Coarse 1kg \",\"quantity\":1,\"price\":\"6.49\",\"slug\":\"pink-himalayan-salt-coarse1kg\",\"points\":14},{\"id\":1,\"name\":\"Pink Himalayan Salt Fine 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-fine-500g\",\"points\":8},{\"id\":7,\"name\":\"Pink Himalayan Salt Coarse 250g \",\"quantity\":1,\"price\":\"2.49\",\"slug\":\"pink-himalayan-salt-coarse-250g\",\"points\":4}]',26,NULL,NULL,NULL,'Royal Mail',17,'Standard',3.99,NULL,0.00,0,1,NULL,NULL,'2017-09-03 17:25:52','2017-09-03 17:27:13','{\"TOKEN\":\"EC-91Y64436WT631620C\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2017-09-03T17:27:12Z\",\"CORRELATIONID\":\"43d3a208e9ac5\",\"ACK\":\"SuccessWithWarning\",\"VERSION\":\"119.0\",\"BUILD\":\"38450994\",\"L_ERRORCODE0\":\"11607\",\"L_SHORTMESSAGE0\":\"Duplicate R',0,0,0,0,0.00,0),
	(54,'5301359ac3d1b66f96','NFL-17000054',1,'Muhammad Angus','m@kedstudio.com','07933 018 324','37 Lynwood Road',NULL,'London','SW17 8SB','United Kingdom','',NULL,25.95,'0','3.99','GBP','[{\"id\":1,\"name\":\"Pink Himalayan Salt Fine 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-fine-500g\",\"points\":8},{\"id\":7,\"name\":\"Pink Himalayan Salt Coarse 250g \",\"quantity\":1,\"price\":\"2.49\",\"slug\":\"pink-himalayan-salt-coarse-250g\",\"points\":4},{\"id\":2,\"name\":\"Pink Himalayan Salt Coarse 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-coarse-500g\",\"points\":8},{\"id\":4,\"name\":\"Pink Himalayan Bath Salt 2kg \",\"quantity\":1,\"price\":\"7.99\",\"slug\":\"pink-himalayan-bath-salt-2kg\",\"points\":20},{\"id\":3,\"name\":\"Pink Himalayan Salt Coarse 1kg \",\"quantity\":1,\"price\":\"6.49\",\"slug\":\"pink-himalayan-salt-coarse1kg\",\"points\":14}]',54,NULL,NULL,NULL,'Royal Mail',17,'Standard',3.99,NULL,0.00,0,1,NULL,NULL,'2017-09-03 17:34:19','2017-09-03 17:35:28','{\"TOKEN\":\"EC-19566120GJ287674D\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2017-09-03T17:35:27Z\",\"CORRELATIONID\":\"b81253729745\",\"ACK\":\"SuccessWithWarning\",\"VERSION\":\"119.0\",\"BUILD\":\"38450994\",\"L_ERRORCODE0\":\"11607\",\"L_SHORTMESSAGE0\":\"Duplicate Re',0,0,0,0,0.00,0),
	(55,'1982659ac4380026d9','NFL-17000055',1,'Muhammad Angus','m@kedstudio.com','07933 018 324','37 Lynwood Road',NULL,'London','SW17 8SB','United Kingdom','',NULL,0.00,'0','3.99','GBP','[{\"id\":4,\"name\":\"Pink Himalayan Bath Salt 2kg \",\"quantity\":1,\"price\":\"7.99\",\"slug\":\"pink-himalayan-bath-salt-2kg\",\"points\":20},{\"id\":3,\"name\":\"Pink Himalayan Salt Coarse 1kg \",\"quantity\":1,\"price\":\"6.49\",\"slug\":\"pink-himalayan-salt-coarse1kg\",\"points\":14},{\"id\":1,\"name\":\"Pink Himalayan Salt Fine 500g \",\"quantity\":1,\"price\":\"4.49\",\"slug\":\"pink-himalayan-salt-fine-500g\",\"points\":8},{\"id\":7,\"name\":\"Pink Himalayan Salt Coarse 250g \",\"quantity\":1,\"price\":\"2.49\",\"slug\":\"pink-himalayan-salt-coarse-250g\",\"points\":4}]',0,NULL,NULL,NULL,'Royal Mail',17,'Standard',3.99,NULL,0.00,0,1,NULL,NULL,'2017-09-03 18:01:36','2017-09-03 18:02:39','{\"TOKEN\":\"EC-0JP49399RU468750X\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"TIMESTAMP\":\"2017-09-03T18:08:10Z\",\"CORRELATIONID\":\"542e6ff47936d\",\"ACK\":\"SuccessWithWarning\",\"VERSION\":\"119.0\",\"BUILD\":\"38450994\",\"L_ERRORCODE0\":\"11607\",\"L_SHORTMESSAGE0\":\"Duplicate R',0,0,0,1,21.46,1073);

/*!40000 ALTER TABLE `shop_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_product_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_categories`;

CREATE TABLE `shop_product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `list_text` text COLLATE utf8_unicode_ci,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `meta_description` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_in_menu` tinyint(1) DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_product_categories` WRITE;
/*!40000 ALTER TABLE `shop_product_categories` DISABLE KEYS */;

INSERT INTO `shop_product_categories` (`id`, `name`, `slug`, `list_image`, `list_text`, `parent_id`, `meta_keywords`, `meta_description`, `status`, `show_in_menu`, `created_at`, `updated_at`)
VALUES
	(1,'Food','food','modules/shop/demo/himalayan-salt.jpg','',0,'Food and diet, weight loss','Food and diet, weight loss',1,2,'2016-04-20 18:08:04','2016-09-02 15:31:32'),
	(2,'Pink Himalayan Salt','pink-himalayan-salt','uploads/products/categories/himalayan-salt.jpg','<p>We are specialist suppliers in Himalayan Pink Salt, which we take directly from the source to ensure its purity. To guarantee our high quality and food grades are consistently maintained and upheld, both the NHI (National Health Institute Islamabad) and the PCSIR (Pakistan Council of Scientific and Industrial Research) have tested and certified our products for their levels of naturalness and quality.</p>',1,'Fine Pink Himalayan Salt, Pink Himalayan Crystal Salt, Raw Pink Himalayan Salt, Unrefined','Nurtured for livings range of Premium raw pink himalayan salt',1,1,'2016-03-31 09:27:45','2016-09-02 11:37:56'),
	(3,'Kitchen Utensils','kitchen-utensils','modules/shop/demo/s2.jpg',NULL,0,'',NULL,1,2,'2016-04-23 08:05:40','2016-04-23 08:05:40'),
	(4,'Salt & Pepper Grinders','salt-and-pepper-grinders','uploads/products/categories/grinders.jpg',NULL,3,'',NULL,1,1,'2016-04-23 08:07:54','2016-08-31 06:53:57');

/*!40000 ALTER TABLE `shop_product_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_product_certificates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_certificates`;

CREATE TABLE `shop_product_certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table shop_product_product_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_product_product_category`;

CREATE TABLE `shop_product_product_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `product_category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_product_product_category` WRITE;
/*!40000 ALTER TABLE `shop_product_product_category` DISABLE KEYS */;

INSERT INTO `shop_product_product_category` (`id`, `product_id`, `product_category_id`, `created_at`, `updated_at`)
VALUES
	(1,1,2,NULL,NULL),
	(2,2,2,NULL,NULL),
	(3,3,2,NULL,NULL),
	(4,4,2,NULL,NULL),
	(5,6,4,NULL,NULL),
	(6,8,4,NULL,NULL),
	(7,7,2,NULL,NULL);

/*!40000 ALTER TABLE `shop_product_product_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_products`;

CREATE TABLE `shop_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` tinyint(3) NOT NULL DEFAULT '0',
  `order` int(4) DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `product_type` tinyint(4) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ean` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `inventory` int(11) NOT NULL DEFAULT '0',
  `images` text COLLATE utf8_unicode_ci,
  `list_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latest_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ingredience` text COLLATE utf8_unicode_ci NOT NULL,
  `product_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video_placeholder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `list_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci,
  `extra_content` text COLLATE utf8_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `regular_price` double(8,2) NOT NULL,
  `sale_price` double(8,2) NOT NULL DEFAULT '0.00',
  `sale_expired_at` datetime DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `displayed_weight` varchar(10) COLLATE utf8_unicode_ci DEFAULT '',
  `size_uk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size_us` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dimentions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `taxt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ship_fee` double(8,2) NOT NULL DEFAULT '0.00',
  `meta` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `restock_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_products_name_index` (`name`),
  KEY `shop_products_slug_index` (`slug`),
  KEY `shop_products_is_featured_index` (`is_featured`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_products` WRITE;
/*!40000 ALTER TABLE `shop_products` DISABLE KEYS */;

INSERT INTO `shop_products` (`id`, `name`, `points`, `order`, `meta_keywords`, `meta_description`, `product_type`, `slug`, `ean`, `inventory`, `images`, `list_image`, `share_image`, `latest_image`, `description`, `ingredience`, `product_video`, `video_placeholder`, `video_title`, `list_description`, `content`, `extra_content`, `is_featured`, `regular_price`, `sale_price`, `sale_expired_at`, `weight`, `displayed_weight`, `size_uk`, `size_us`, `dimentions`, `taxt`, `ship_fee`, `meta`, `status`, `restock_date`, `created_at`, `updated_at`)
VALUES
	(1,'Pink Himalayan Salt Fine 500g ',8,1,'Coarse Pink Himalayan Salt, Pink Himalayan Crystal Salt, Raw Pink Himalayan Salt, Unrefined, Natural Himalayan Salt','Raw Fine Pink Himalayan Salt from Nurtured for Living - 500g',1,'pink-himalayan-salt-fine-500g','0603803827609',42,'[\"\\/uploads\\/products\\/himalayan-salt\\/nfl500gfinefront.jpg\",\"\\/uploads\\/products\\/himalayan-salt\\/nfl500gfineback.jpg\"]','/uploads/products/himalayan-salt/nfl500gfinefront.jpg','/uploads/products/shareimages/nfl500gfinefront-share.jpg',NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','','',NULL,NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','<p>Our salt is hand harvested from pure salt reserves that were formed more than 250 million years ago. This authentic Pink Himalayan Salt is unrefined and unpolluted by environmental impurities, chemicals, or additives.</p>\r\n\r\n<p>With more than 84 naturally occurring trace elements that help the body detox and find equilibrium, this is the salt of choice for meat, fish, pasta, vegetables and more. Use Nurtured For Living’s Fine Pink Himalayan salt in everyday cooking and seasoning to complement your favorite herbs and spices for a perfect flavoursome base.</p>\r\n\r\n<p>Discover the inherent nutrients, delicious taste, and therapeutic properties of our fine raw Pink Himalayan Crystal Salt. No outlandish claims, just incredibly great salt!</p>\r\n\r\n<p><i>Grain size is 0.3 mm and will pass through any standard salt shaker</i></p>','',1,0.00,0.00,'0000-00-00 00:00:00',512,'500g','SP','SP','L15 x H20 x W4 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"4.49\",\"regular_price\":\"4.99\"}}',1,NULL,'2016-03-27 09:27:54','2016-12-23 00:42:38'),
	(2,'Pink Himalayan Salt Coarse 500g ',8,3,'Coarse Pink Himalayan Salt, Pink Himalayan Crystal Salt, Raw Pink Himalayan Salt, Unrefined, Natural Himalayan Salt','100% Raw Coarse Pink Himalayan Salt from Nurtured for Living - 500g',1,'pink-himalayan-salt-coarse-500g','0603803827579',34,'[\"\\/uploads\\/products\\/himalayan-salt\\/nfl500gcoarsefront.jpg\",\"\\/uploads\\/products\\/himalayan-salt\\/nfl500gcoarseback.jpg\"]','/uploads/products/himalayan-salt/nfl500gcoarsefront.jpg','/uploads/products/shareimages/nfl500gcoarsefront-share.jpg',NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','','',NULL,NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','<p>Our salt is hand harvested from pure salt reserves that were formed more than 250 million years ago. This authentic Pink Himalayan Salt is unrefined and unpolluted by environmental impurities, chemicals, or additives.</p>\r\n\r\n<p>With more than 84 naturally occurring trace elements that help the body detox and find equilibrium, this is the salt of choice for meat, fish, pasta, vegetables and more. Use Nurtured For Living’s Coarse Pink Himalayan salt in everyday cooking and seasoning to complement your favorite herbs and spices for a perfect flavoursome base.</p>\r\n\r\n<p>Discover the inherent nutrients, delicious taste, and therapeutic properties of our coarse raw Pink Himalayan Crystal Salt. No outlandish claims, just incredibly great salt!</p>\r\n\r\n<p>Ideal for use in our quality <a href=\"/shop/product/salt-and-pepper-mill-set\">spice grinders</a>.</p>','',1,0.00,0.00,'0000-00-00 00:00:00',509,'500g','SP','SP','L15 x H20 x W4 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"4.49\",\"regular_price\":\"4.99\"}}',1,NULL,'2016-03-28 09:27:54','2017-01-05 22:13:13'),
	(3,'Pink Himalayan Salt Coarse 1kg ',14,4,'Coarse Pink Himalayan Salt, Pink Himalayan Crystal Salt, Raw Pink Himalayan Salt, Unrefined, Natural Himalayan Salt','100% Raw Coarse Pink Himalayan Salt from Nurtured for Living - 1kg',1,'pink-himalayan-salt-coarse1kg','0603803827562',15,'[\"\\/uploads\\/products\\/himalayan-salt\\/nfl1kgcoarsefront.jpg\",\"\\/uploads\\/products\\/himalayan-salt\\/nfl1kgcoarseback.jpg\"]','/uploads/products/himalayan-salt/nfl1kgcoarsefront.jpg','/uploads/products/shareimages/nfl1kgcoarsefront-share.jpg',NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','','',NULL,NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','<p>Our salt is hand harvested from pure salt reserves that were formed more than 250 million years ago. This authentic Pink Himalayan Salt is unrefined and unpolluted by environmental impurities, chemicals, or additives.</p>\r\n\r\n<p>With more than 84 naturally occurring trace elements that help the body detox and find equilibrium, this is the salt of choice for meat, fish, pasta, vegetables and more. Use Nurtured For Living’s Coarse Pink Himalayan salt in everyday cooking and seasoning to complement your favorite herbs and spices for a perfect flavoursome base.</p>\r\n\r\n<p>Discover the inherent nutrients, delicious taste, and therapeutic properties of our coarse raw Pink Himalayan Crystal Salt. No outlandish claims, just incredibly great salt!</p>\r\n\r\n<p>Ideal for use in our quality <a href=\"/shop/product/salt-and-pepper-mill-set\">spice grinders</a>.</p>','',1,0.00,0.00,'0000-00-00 00:00:00',1020,'1kg','SP','SP','L20 x H30 x W7 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"6.49\",\"regular_price\":\"8.99\"}}',1,NULL,'2016-03-29 09:27:54','2017-08-01 14:13:06'),
	(4,'Pink Himalayan Bath Salt 2kg ',20,5,'Coarse Pink Himalayan Salt, Pink Himalayan Crystal Bath Salt, Raw Pink Himalayan Salt, Unrefined, Natural Himalayan Bath Salt','100% Raw Coarse Pink Himalayan Bath Salt from Nurtured for Living - 2kg',1,'pink-himalayan-bath-salt-2kg','0603803827531',36,'[\"\\/uploads\\/products\\/himalayan-salt\\/nfl2kg_bath_front.jpg\",\"\\/uploads\\/products\\/himalayan-salt\\/nfl2kg_bath_back.jpg\"]','/uploads/products/himalayan-salt/nfl2kg_bath_front.jpg','/uploads/products/shareimages/nfl2kg_bath_front-share.jpg',NULL,'<p>Unlock the detoxifying power of Nurtured For Living’s Pink Himalayan Crystal Bath Salt with a tub of warm bath water and 30 minutes of relaxation and soaking.</p>\r\n','','',NULL,NULL,'<p>Unlock the detoxifying power of Nurtured For Living’s Pink Himalayan Crystal Bath Salt with a tub of warm bath water and 30 minutes of relaxation and soaking.</p>\r\n','<p>The extra coarse crystals, mined from 250-million-year-old unpolluted Himalayan salt mine reserves, deliver purity and potency for your health with a stunning natural pink colour. Pink Himalayan Crystal Salt is a natural source of more than 84 trace elements, including calcium, magnesium, potassium, copper, and iron. </p>\r\n\r\n<p>Mix the required amount of raw pink crystal salts into three inches of steaming bath water until the crystals dissolve to create a luxurious brine bath. Continue filling your tub and settle in for a comfortable, steamy soak. During your 20-30 minute immersion, treat yourself to a powerful detox that helps your body find balance and keeps your skin smooth, radiant, and healthy.\r\n</p>\r\n\r\n\r\n<ul>\r\n<li><b>Natural</b>: Free of artificial additives and only uses a single pure, all-natural ingredient.</li>\r\n\r\n<li><b>Healthy</b>: Treat your skin to a detoxifying, mineral-rich bath that delivers more than 84 trace element minerals, which help keep your skin healthy and shiny.</li>\r\n\r\n<li><b>Unrefined</b>: The rough rock crystals drop into your bath in the same form that they were extracted.</span></li>\r\n\r\n<li><b>Unpolluted</b>: Purity is key for potency, and the all-natural crystals come from unpolluted mines.</li>\r\n\r\n<li><b>Edible</b>: Our food grade bath salt is suitable for both internal and external use.</li>\r\n</ul>','',1,0.00,0.00,'0000-00-00 00:00:00',2020,'2kg','SP','SP','L20 x H30 x W8 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"7.99\",\"regular_price\":\"10.99\"}}',1,NULL,'2016-03-30 09:27:54','2017-08-01 14:12:18'),
	(6,'Salt & Pepper Mills with FREE Pink Himalayan Salt',48,1,'salt and pepper mills,spice mill,spice grinder,peppercorn Mills,rock salt,crystal salt,himalayan salt,gift set,gift box,ceramic,stainless steel, variable coarseness','Our salt and pepper grinders bridge the gap between durability, functionality and stunning design. \r\nThey come with all the features and elegance your kitchen deserves, including quality construction material and timeless aesthetics, they\'re perfect for a',1,'salt-and-pepper-mill-set','0603803827630',19,'[\"\\/uploads\\/products\\/grinders\\/2grinders-and-box.jpg\",\"\\/uploads\\/products\\/grinders\\/grinders-front.jpg\",\"\\/uploads\\/products\\/grinders\\/grinder-and-salt.jpg\",\"\\/uploads\\/products\\/grinders\\/adjuster.jpg\",\"\\/uploads\\/products\\/grinders\\/grinder-box-front.jpg\",\"\\/uploads\\/products\\/grinders\\/open-box.jpg\",\"\\/uploads\\/products\\/grinders\\/grinders-situ.jpg\"]','/uploads/products/grinders/2grinders-and-box.jpg','/uploads/products/shareimages/grinders-front-share.jpg','/uploads/products/grinders/grinder-homepage-image.jpg','<p>Our salt and pepper grinders bridge the gap between durability, functionality and stunning design. They come in with all the features and elegance your kitchen deserve, including quality construction material and timeless aesthetics, they’re perfect for any kitchen.</p>\r\n','','',NULL,NULL,'<p>Our salt and pepper grinders bridge the gap between durability, functionality and stunning design. \r\nThey come with all the features and elegance your kitchen deserves, including quality construction material and timeless aesthetics, they\'re perfect for any kitchen.</p>','<p>These remarkable units ensure ease of use and style, so you can easily spice up all of your favourite recipes with a few ergonomically smart flicks of your wrist!  </p>\r\n\r\n<p>Packed in a classy gift box, they are the ideal gift for any occasion! You’ll also receive 250g of our pure coarse Pink Himalayan Crystal Salt to help you get off to a good start! </p>\r\n\r\n<p>\r\n<b>Key Benefits:</b><br>\r\n✔ Modern &amp; stylish upright design ensures your table and kitchen are kept clean.<br>\r\n✔ Variable coarseness adjuster gives you full control of the spice grain size.<br>\r\n✔ Stainless steel, ceramic &amp; glass construction for durability.<br>\r\n✔ Generous storage unit with easily removable grinder head. <br>\r\n✔ Versatile grinders for use with a range of spices. <br>\r\n✔ Quick to refill with our FREE salt. <br>\r\n✔ 100% satisfaction guarantee. \r\n</p>\r\n\r\n<p>\r\n<b>Grinder Dimensions:</b><br> \r\nHeight : 13.5 cm<br>\r\nDiameter : 6.7cm<br>\r\nWeight : 230g\r\n</p> ','',1,0.00,0.00,'0000-00-00 00:00:00',772,'','SP','SP','H13.5 x W6.7 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"24.99\",\"regular_price\":\"35\"}}',1,'2017-01-08','2016-03-31 09:27:54','2017-01-05 20:28:32'),
	(7,'Pink Himalayan Salt Coarse 250g ',4,2,'Coarse Pink Himalayan Salt, Pink Himalayan Crystal Salt, Raw Pink Himalayan Salt, Unrefined, Natural Himalayan Salt','100% Raw Coarse Pink Himalayan Salt from Nurtured for Living - 250g',1,'pink-himalayan-salt-coarse-250g','0603803827586',6,'[\"\\/uploads\\/products\\/himalayan-salt\\/nfl250gcoarsefront.jpg\",\"\\/uploads\\/products\\/himalayan-salt\\/nfl250gcoarseback.jpg\"]','/uploads/products/himalayan-salt/nfl250gcoarsefront.jpg','/uploads/products/shareimages/nfl250gcoarsefront-share.jpg',NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','','',NULL,NULL,'<p>Nurtured for Living delivers the delicious flavour and powerful therapeutic properties of Pink Himalayan Crystal Salt to your kitchen.</p>\r\n','<p>Our salt is hand harvested from pure salt reserves that were formed more than 250 million years ago. This authentic Pink Himalayan Salt is unrefined and unpolluted by environmental impurities, chemicals, or additives.</p>\r\n\r\n<p>With more than 84 naturally occurring trace elements that help the body detox and find equilibrium, this is the salt of choice for meat, fish, pasta, vegetables and more. Use Nurtured For Living’s Coarse Pink Himalayan salt in everyday cooking and seasoning to complement your favorite herbs and spices for a perfect flavoursome base.</p>\r\n\r\n<p>Discover the inherent nutrients, delicious taste, and therapeutic properties of our coarse raw Pink Himalayan Crystal Salt. No outlandish claims, just incredibly great salt!</p>\r\n\r\n<p>Ideal for use in our quality <a href=\"/shop/product/salt-and-pepper-mill-set\">spice grinders</a>.</p>','',1,0.00,0.00,'0000-00-00 00:00:00',262,'250g','LL','SP','L12 x H18 x W3 CM',NULL,0.00,'{\"GBP\":{\"sale_price\":\"2.49\",\"regular_price\":\"2.99\"}}',1,NULL,'2016-03-28 09:27:54','2017-07-13 17:17:17');

/*!40000 ALTER TABLE `shop_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_settings`;

CREATE TABLE `shop_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_settings` WRITE;
/*!40000 ALTER TABLE `shop_settings` DISABLE KEYS */;

INSERT INTO `shop_settings` (`id`, `key`, `name`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'uk_free_shipping','UK Free Shipping','30',NULL,NULL),
	(2,'low_inventory_amount','Low Inventory Warning Amount','10',NULL,NULL),
	(3,'loyalty_points_ratio','Loyalty Points Ratio','50',NULL,NULL),
	(4,'minimum_point_conversion','Minimum Point Conversion','5.00',NULL,NULL);

/*!40000 ALTER TABLE `shop_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_shipping_methods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_shipping_methods`;

CREATE TABLE `shop_shipping_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courier_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `min_weight` int(11) NOT NULL,
  `max_weight` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `fee` double(8,2) NOT NULL,
  `service` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta` text COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_shipping_methods` WRITE;
/*!40000 ALTER TABLE `shop_shipping_methods` DISABLE KEYS */;

INSERT INTO `shop_shipping_methods` (`id`, `courier_id`, `name`, `origin`, `destination`, `min_weight`, `max_weight`, `size`, `duration`, `type`, `fee`, `service`, `meta`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,'Royal Mail 1st Class','UK','UK',101,250,'LL','1-2 Days',2,1.27,'RMFC',NULL,1,'2016-04-09 07:02:49','2016-10-23 21:08:08'),
	(2,1,'Royal Mail 1st Class','UK','UK',251,500,'LL','1-2 Days',2,1.71,'RMFC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(3,1,'Royal Mail 2nd Class','UK','UK',251,500,'LL','2-3 Days',2,1.54,'RMSC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(4,1,'Royal Mail 1st Class','UK','UK',501,750,'LL','1-2 Days',2,2.46,'RMFC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(5,1,'Royal Mail 2nd Class','UK','UK',501,750,'LL','2-3 Days',2,2.09,'RMSC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(7,1,'Royal Mail 1st Class','UK','UK',0,1000,'SP','1-2 Days',2,3.30,'RMFC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(9,1,'Royal Mail 1st Class','UK','UK',1001,2000,'SP','1-2 Days',2,5.45,'RMFC',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(11,1,'UPS NEXT DAY BY 12','UK','UK',0,10000,'SP','1 Day - before 12',2,12.60,'UPSBY12',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(12,1,'UPS NEXT DAY','UK','UK',0,10000,'SP','1 Day',2,6.00,'UPS',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(13,1,'UPS NEXT DAY BY 12','UK','UK',10000,20000,'SP','1 Day - before 12',2,10.20,'UPSBY12',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(14,1,'UPS NEXT DAY','UK','UK',10000,20000,'SP','1 Day',2,8.40,'UPS',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(15,1,'UPS NEXT DAY','UK','UK',20001,32000,'SP','1 Day',2,15.00,'UPS',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(16,1,'Standard','UK','UK',1,1750,'SP','3-5 Days',2,1.99,'STND',NULL,1,'2016-04-09 07:02:49','2016-10-23 21:08:08'),
	(17,1,'Standard','UK','UK',1751,10000,'SP','1-2 Days',2,3.99,'STND',NULL,1,'2016-04-09 07:02:49','2016-10-23 21:08:08'),
	(18,1,'Standard','UK','UK',10001,20000,'SP','1-2 Days',2,5.99,'STND',NULL,1,'2016-04-09 07:02:49','2016-10-23 21:08:08'),
	(19,1,'Standard','UK','UK',20001,32000,'SP','1-2 Days',2,7.99,'STND',NULL,1,'2016-04-09 07:02:49','2016-10-23 21:08:08'),
	(20,1,'UPS INT STND','UK','RW',0,10000,'SP','3-5 Days',2,18.00,'UPSINTSTND',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42'),
	(21,1,'UPS NEXT DAY','UK','RW',10000,20000,'SP','3-5 Days',2,34.00,'UPSINTSTND',NULL,1,'2016-04-09 07:02:49','2016-04-25 07:48:42');

/*!40000 ALTER TABLE `shop_shipping_methods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_stock_notification
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_stock_notification`;

CREATE TABLE `shop_stock_notification` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_sent` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `shop_stock_notification` WRITE;
/*!40000 ALTER TABLE `shop_stock_notification` DISABLE KEYS */;

INSERT INTO `shop_stock_notification` (`id`, `user_id`, `product_id`, `email`, `email_sent`, `status`, `created_at`, `updated_at`)
VALUES
	(2,1,1,'m@kedstudio.com',1,1,NULL,NULL);

/*!40000 ALTER TABLE `shop_stock_notification` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_wholesale_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop_wholesale_orders`;

CREATE TABLE `shop_wholesale_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `retailer_id` int(11) NOT NULL,
  `invoice_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `order_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `delivery_status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table site_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `site_settings`;

CREATE TABLE `site_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_socials` tinyint(4) DEFAULT '2',
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `us_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uk_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `is_multiple_shop_locations` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;

INSERT INTO `site_settings` (`id`, `facebook`, `youtube`, `twitter`, `pinterest`, `instagram`, `google`, `show_socials`, `copyright`, `us_number`, `uk_number`, `address`, `meta_keywords`, `meta_description`, `is_multiple_shop_locations`, `created_at`, `updated_at`)
VALUES
	(1,'nurturedforliving','','','nurtured4living','nurturedforliving','',1,'all rights reserved Nurtured For Living LTD | Company No 9966047','','+44(0)207 993 6881','<p>PO box 69041<br />\r\nLondon, SW17 1FU</p>\r\n','Natural, Organic, health products, Pink Himalayan Salt, Argan Oil, Raw Shea Butter, Organic Coconut Oil, Organic Honey','Nurtured For Living LTD; manufactures of natural and organic products',0,NULL,'2016-12-10 00:34:44');

/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table slides
# ------------------------------------------------------------

DROP TABLE IF EXISTS `slides`;

CREATE TABLE `slides` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `caption_colour` varchar(10) DEFAULT NULL,
  `caption_position` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `bg_colour` varchar(8) DEFAULT NULL,
  `bg_tile` varchar(255) DEFAULT NULL,
  `slide_link` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;

INSERT INTO `slides` (`id`, `image`, `caption`, `caption_colour`, `caption_position`, `bg_colour`, `bg_tile`, `slide_link`, `order`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'uploads/slides/grinders-xl.jpg',NULL,'#3D3D3D','bottom_center',NULL,'uploads/slides/grinders-xl.jpg','shop/product/salt-and-pepper-mill-set',2,1,NULL,NULL),
	(2,'uploads/slides/culinary-slide-xl.jpg',NULL,'#000000','bottom_center','#000000','uploads/slides/culinary-slide-xl.jpg','shop/category/pink-himalayan-salt',1,1,NULL,NULL),
	(3,'uploads/slides/detox-slider.png',NULL,'#3D3D3D','bottom_center','#F1F1F1',NULL,NULL,3,2,NULL,NULL);

/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;

INSERT INTO `tags` (`id`, `name`, `list_image`, `slug`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Pink Himalayan Crystal Salt','uploads/articles/81/things-to-do-with-himalayan-salt.jpg','pink-himalayan-crystal-salt',1,'2016-07-26 17:00:38','2016-07-26 17:00:38'),
	(2,'Hair Care','uploads/articles/81/things-to-do-with-himalayan-salt.jpg','hair-care',1,'2016-07-26 17:01:12','2016-07-26 17:01:12'),
	(3,'Beard Care','uploads/articles/81/things-to-do-with-himalayan-salt.jpg','beard-care',1,'2016-07-26 17:02:17','2016-07-26 17:02:17');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_favorites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_favorites`;

CREATE TABLE `user_favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `f_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `l_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_login2` datetime DEFAULT NULL,
  `remember_me` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `signup_date` datetime NOT NULL,
  `wholesaler` tinyint(1) NOT NULL DEFAULT '0',
  `advocate` tinyint(1) DEFAULT '0',
  `points` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cart_session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `company`, `f_name`, `l_name`, `username`, `address`, `city`, `town`, `zip_code`, `country`, `gender`, `email`, `mobile`, `avatar`, `password`, `ip`, `last_login`, `last_login2`, `remember_me`, `remember_token`, `status`, `signup_date`, `wholesaler`, `advocate`, `points`, `created_at`, `updated_at`, `cart_session_id`)
VALUES
	(1,'','Muhammad','Angus','abulayla','37 Lynwood Road','London','Tooting Bec','SW17 8SB','United Kingdom','male','m@kedstudio.com','07933 018 324','users/1/avatar/avatar.jpg','$2y$10$V9gmQzIVas7iKmVw/LNuPO5kZiSN8sEbICLseibgpjUl01IbL/4Te','46.52.86.10','2016-07-31 08:51:38','2016-07-30 21:21:25',NULL,'ogvcbhzXzbaOEkzSYwxKQO7GsgJnr4bsbXM49hr0qSJcNcMN4GoclLdAXkHh',1,'0000-00-00 00:00:00',0,1,961,'2016-02-25 00:00:00','2017-09-03 18:02:28',''),
	(2,'','Micah','Angus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'micah@nurtu333redforliving.com','7933018324',NULL,'$2y$10$V9gmQzIVas7iKmVw/LNuPO5kZiSN8sEbICLseibgpjUl01IbL/4Te','192.168.10.1','2016-12-25 02:46:45',NULL,NULL,'MAaKa9rWkPlRDmiTZ3J8v6gosMyN1UZ5bRWzyJG0qxWYY4kcz9Hj6yEJdt81',1,'0000-00-00 00:00:00',0,0,0,'2016-12-25 02:46:45','2017-04-19 18:31:09',''),
	(3,'','IsaacPouff','IsaacPouff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'owen@1milliondollars.xyz',NULL,NULL,'$2y$10$j15o8sAbGLrtS6hnvv862u7Bnll0cC3jXL.bzscrRMapFIpSBynlC','93.170.130.95','2017-02-13 15:13:54',NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-02-13 15:13:54','2017-02-13 15:13:54',''),
	(6,'','test','user','atW4?h*dn',NULL,NULL,NULL,NULL,NULL,NULL,'testuser@email.com','',NULL,'$2y$10$QBAcieMHMbX0hk2YXHaJPeRKCEwRTEwMoLu7Y.UdGdisz5xI4VbRG',NULL,NULL,NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-04-17 14:51:17','2017-04-17 14:51:17',''),
	(7,'','karen','drakes','f*vwSuq9Q',NULL,NULL,NULL,NULL,NULL,NULL,'kd@email.com','',NULL,'$2y$10$aMghL5QCpG2c6AGzlHhqVuedZScg/yokNphwOtyD3y0AEH9Ts2KVW',NULL,NULL,NULL,NULL,'1wKuBDLSnzoo5GT95qguL45K7M2MB3wtyWEF6BBcuhFoJvmQznTMbqxRteFS',1,'0000-00-00 00:00:00',0,0,0,'2017-04-17 15:13:00','2017-04-20 11:38:32',''),
	(8,'','Bev ','Drakes','wPWu*ey68',NULL,NULL,NULL,NULL,NULL,NULL,'bev@emnail.com','',NULL,'$2y$10$tWsszlU2alrMQRS4iMSIGeG6TSez/ly82hNCtJs1FVei3lpp6NsBm',NULL,NULL,NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-04-17 15:13:14','2017-04-17 15:13:14',''),
	(9,'','David','Daly','d&zw3J9@G',NULL,NULL,NULL,NULL,NULL,NULL,'Daviddcdd1@googlemail.com','',NULL,'$2y$10$sTKsmjFXpP4pnwMJdV5hSuHPsbf6.xQw1721PNbdY3wwgJ2CXa9sC',NULL,NULL,NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-04-17 15:32:40','2017-04-17 15:32:40',''),
	(10,'','New','User',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'micah@ambient-group.com','07933018324',NULL,'$2y$10$yFVl6R7eGSnyBVG4CYEmWeWHGg15BGJmsYJHHk56BfP.Hr.c3uKCm','192.168.10.1','2017-04-18 11:53:38',NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,6,'2017-04-18 23:53:38','2017-04-18 23:53:38',''),
	(12,'','Micah','Angus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'tom@email.com','07933018324',NULL,'$2y$10$IDNPJjdrjcrZ9xdykifF0.yEuC3ef.zoLR8Tm6g.5j/yHqfZJehm2','192.168.10.1','2017-04-19 11:05:38',NULL,NULL,'utm0zVYLBuXYxiRS1207bDDeZFaSCz8aEUs2ss3dlDPSnRa9MuC9Pz3mYtY1',1,'0000-00-00 00:00:00',0,0,54,'2017-04-19 23:05:38','2017-04-19 23:07:28',''),
	(13,'','David','Daly',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Dave@email.com','23423444',NULL,'$2y$10$OFGkrCV1Xx99IrwGmuvuG.z8K.nkr.Tj09E12aoSlYFFuorSSfEnu','192.168.10.1','2017-04-19 11:10:01',NULL,NULL,'pJas6RCzoUsNecj5qk1dh1zuRla2OwiPgJ9iak05NC4UkXrF0K4uStasIzoo',1,'0000-00-00 00:00:00',0,0,64,'2017-04-19 23:10:01','2017-04-19 23:11:50',''),
	(14,'','Micah','Angus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'john@email.com','7933018324',NULL,'$2y$10$BXuRmvxhIwxzDggJNRqVSe89qm5fz039ddaeYSCil50pcPjodE2FK','192.168.10.1','2017-04-19 11:15:46',NULL,NULL,'mBvhznpXfLLv4U8kzAKLDW8XywKlK2QEEH77MUjwotdhEoRxrLQ8FD6cUrJG',1,'0000-00-00 00:00:00',0,0,74,'2017-04-19 23:15:46','2017-04-19 23:16:51',''),
	(15,'','Chris','Smith',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'chris@email.com','07933018324',NULL,'$2y$10$zTy7S2hzO3CdpZ/j1jlHVuGJuIvKKGDhtwIhtjg9oZ6tlxB4KpE6q','192.168.10.1','2017-04-20 10:57:21',NULL,NULL,'5Qxtfn7ERN4iZuDn51UZW3lRxjgOwdMOOqPHRoSEWdlzoiGL1efHeOu1SZKM',1,'0000-00-00 00:00:00',0,0,125,'2017-04-20 10:57:21','2017-04-20 11:32:15',''),
	(16,'','James','Bond',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'james@email.com','0007',NULL,'$2y$10$Pe8qCovTEErKdynnd5KDwuSJBXcziR8o85/YZZesKjgL3M6wPEPpK','192.168.10.1','2017-04-20 03:27:18',NULL,NULL,'36qtrxCpm64llhJ6gaQnnl1A44BtZp75sQfzDv0t9ZGIibuGaxAyPLsfjkRW',1,'0000-00-00 00:00:00',0,0,96,'2017-04-20 15:27:18','2017-04-20 15:40:27',''),
	(17,'','micalyah','angus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fefe.mcqueen.ig@gmail.com','07535397069',NULL,'$2y$10$V9gmQzIVas7iKmVw/LNuPO5kZiSN8sEbICLseibgpjUl01IbL/4Te','192.168.10.1','2017-04-20 05:43:09',NULL,NULL,'1dtL4CzmiCxyDOyyywct5f3G6WQvCLnvnOdWzmnBICg1NAOXLG6g9F2uWohB',1,'0000-00-00 00:00:00',0,0,265,'2017-04-20 17:43:09','2017-05-04 23:26:44',''),
	(18,'','Micah','Abulayla','',NULL,NULL,NULL,NULL,NULL,NULL,'micah@nurturedforliving.com','7933018324',NULL,'$2y$10$1tJECIfqkqLewo25yPhhT.J70vkxeQA7XZIJh5zouubOEJIvqY7VK','192.168.10.1','2017-05-18 06:16:56',NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-05-18 18:16:56','2017-05-18 18:18:37',''),
	(19,'','Salma','Umm Layla','ummlayla',NULL,NULL,NULL,NULL,NULL,NULL,'salma@ummlayla.com','07933018324',NULL,'$2y$10$1tJECIfqkqLewo25yPhhT.J70vkxeQA7XZIJh5zouubOEJIvqY7VK','192.168.10.1','2017-05-18 06:16:56',NULL,NULL,NULL,1,'0000-00-00 00:00:00',0,0,0,'2017-05-18 18:16:56','2017-05-18 18:18:37','');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

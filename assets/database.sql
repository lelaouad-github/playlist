--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist` (
  `uuid` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `published_at` datetime NOT NULL,
  PRIMARY KEY (`uuid`),
  KEY `playlist_name_IDX` (`name`) USING BTREE,
  KEY `playlist_created_at_IDX` (`created_at`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES ('3756f3c1-c1db-4e8a-a25a-e8744bbae699','CNOSF','2018-10-09 10:10:10','2018-10-09 10:10:10'),('575623cd-1f0b-492b-9e8f-7c2db16c3dfc','Sans langue de bois...','2018-10-09 10:10:10','2018-10-09 10:10:10'),('9b308232-a90b-47c9-84ef-d69a1c2f36a4','Foot','2018-10-09 10:10:10','2018-10-09 10:10:10'),('9b7c2339-73f6-4756-a8b5-a24f7cbef504','Dac\' ou pas dac\'','2018-10-09 10:10:10','2018-10-09 10:10:10'),('c3fa8826-7614-4eef-8124-beae68e46321','Cyclisme','2018-10-09 10:10:10','2018-10-09 10:10:10'),('cd3998ac-f352-4750-a8e3-67e700e99ce4','JO 2018 Pyeongchang','2018-10-09 10:10:10','2018-10-09 10:10:10'),('dbc2cbec-17f5-478b-9ae7-8dc4f771d38d','Tous sports','2018-10-09 10:10:10','2018-10-09 10:10:10');
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `uuid` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `published_at` datetime NOT NULL,
  `duration` varchar(20) NOT NULL,
  `view_count` int(10) unsigned NOT NULL,
  `playlist_uuid` varchar(36) NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`uuid`),
  KEY `video_playlist_FK` (`playlist_uuid`),
  CONSTRAINT `video_playlist_FK` FOREIGN KEY (`playlist_uuid`) REFERENCES `playlist` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES ('1c9c8a6c-9646-4607-9691-778fe28e9f97','lorem','https://www.dailymotion.com/video/x6uoju5?playlist=x5mbb0','2018-10-25 00:12:23','2018-10-25 00:12:23','00:15:53',100,'9b7c2339-73f6-4756-a8b5-a24f7cbef504',1),('43d11179-0afa-496d-a211-c36a962a3362','lorem','https://www.dailymotion.com/video/x6uoju5?playlist=x5mbb0','2018-10-25 00:12:23','2018-10-25 00:12:23','00:15:53',100,'9b7c2339-73f6-4756-a8b5-a24f7cbef504',2),('53b3b4b2-3fb1-4ad3-bed5-03984495c19b','Gaspacho','https://www.dailymotion.com/video/x6uoq03?playlist=x5mbb0','2018-10-08 00:38:12','2018-10-15 01:02:50','00:45:38',356,'c3fa8826-7614-4eef-8124-beae68e46321',2),('7f7a35d9-7fda-4fe9-8e5d-d2ca04c47076','Gateau spectaculaire','https://www.dailymotion.com/video/x6uoq03?playlist=x5mbb0','2018-10-08 00:06:52','2018-10-15 01:02:50','00:45:38',15789,'c3fa8826-7614-4eef-8124-beae68e46321',1),('d39e016a-0ba9-4eb2-aea8-bb7534613fec','lorem','https://www.dailymotion.com/video/x6uoju5?playlist=x5mbb0','2018-10-25 00:12:23','2018-10-25 00:12:23','00:15:53',100,'9b7c2339-73f6-4756-a8b5-a24f7cbef504',3),('da6d1480-f435-47f3-a6c2-b76049e8d7c4','lorem','https://www.dailymotion.com/video/x6uoju5?playlist=x5mbb0','2018-10-25 00:12:23','2018-10-25 00:12:23','00:15:53',100,'9b7c2339-73f6-4756-a8b5-a24f7cbef504',4);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

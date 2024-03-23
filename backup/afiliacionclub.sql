SET FOREIGN_KEY_CHECKS=0;


USE database_dataskt;

DROP TABLE IF EXISTS afiliacionclub;

CREATE TABLE `afiliacionclub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipoafiliacion` varchar(100) COLLATE utf8_bin NOT NULL,
  `dnialta` bigint(20) DEFAULT NULL,
  `nombrealta` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `apellidoalta` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cuitalta` bigint(20) DEFAULT NULL,
  `institucionalta` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fechaalta` date DEFAULT NULL,
  `dnimod` bigint(20) DEFAULT NULL,
  `nombremod` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `apellidomod` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `cuitmod` bigint(20) DEFAULT NULL,
  `institucionmod` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `fechamod` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO afiliacionclub VALUES("1","RUD Y PROMOCION","23660292","Sandra","Barzola","11111111111","LEPAA","2023-03-18","23660292","Sandra","Barzola","99999","DATA SKATE","2024-02-03");
INSERT INTO afiliacionclub VALUES("2","AFILIADO","23660292","Sandra","Barzola","11111111111","LEPAA","2023-03-18","23660292","Sandra","Barzola","99999","DATA SKATE","2024-02-03");
INSERT INTO afiliacionclub VALUES("3","INVITADO","23660292","Sandra","Barzola","11111111111","LEPAA","2023-03-18","0","","","0","","0000-00-00");
INSERT INTO afiliacionclub VALUES("4","FEDERADO","23660292","Sandra","Barzola","11111111111","LEPAA","2023-03-18","23660292","Sandra","Barzola","99999","DATA SKATE","2024-02-03");



SET FOREIGN_KEY_CHECKS=1;
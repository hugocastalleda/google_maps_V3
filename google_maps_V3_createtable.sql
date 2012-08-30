CREATE TABLE `markers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`pais` VARCHAR( 60 ) NOT NULL ,
`departamento` VARCHAR( 80 ) NOT NULL ,
`municipio` VARCHAR( 80 ) NOT NULL ,
`barrio` VARCHAR( 80 ) NOT NULL ,
`direccion` VARCHAR( 80 ) NOT NULL ,
`type` VARCHAR( 30 ) NOT NULL,
`lat` FLOAT( 10, 6 ) NOT NULL ,
`lng` FLOAT( 10, 6 ) NOT NULL 
) ENGINE = MYISAM ;
# FOR OLD VERSION

ALTER TABLE `impostazioni` ADD `background_transition` TEXT NULL;
UPDATE `impostazioni` SET `background_transition` = 'false' WHERE `impostazioni`.`id` = 1;
ALTER TABLE `impostazioni` ADD `timezone` TEXT NULL ;
ALTER TABLE `oggetti` CHANGE `Prezzo` `Prezzo` DECIMAL(5) NOT NULL;

ALTER TABLE `oggetti` CHANGE `Anticipo` `Anticipo` DECIMAL(10,2) NOT NULL;
ALTER TABLE `oggetti` CHANGE `Prezzo` `Prezzo` DECIMAL(10,2) NOT NULL;

#FO THIS UPDATE
# NULL
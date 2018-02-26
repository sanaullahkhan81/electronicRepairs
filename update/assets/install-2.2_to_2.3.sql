ALTER TABLE impostazioni CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE oggetti CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
ALTER TABLE clienti CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;

ALTER TABLE `impostazioni` ADD `numc` INT NOT NULL;
ALTER TABLE `impostazioni` ADD `currency_symbol` mediumtext NOT NULL;
ALTER TABLE `impostazioni` ADD `currency_text` mediumtext NOT NULL;
ALTER TABLE `impostazioni` ADD `currency_position` mediumtext NOT NULL;
ALTER TABLE `impostazioni` ADD `printinonepage` INT NOT NULL;
ALTER TABLE `impostazioni` ADD `rtl_support` INT NOT NULL;

ALTER TABLE `impostazioni` ADD `email_sender` TEXT NOT NULL , ADD `email_subject` TEXT NOT NULL , ADD `email_use_smtp` INT NOT NULL , ADD `email_smtp_host` TEXT NOT NULL , ADD `email_smtp_user` TEXT NOT NULL , ADD `email_smtp_pass` TEXT NOT NULL , ADD `email_smtp_port` TEXT NOT NULL , ADD `email_smtp_open_text` LONGTEXT NOT NULL , ADD `email_smtp_closed_text` LONGTEXT NOT NULL ;

ALTER TABLE `oggetti` ADD `send_email` INT NOT NULL , ADD `email` TEXT NOT NULL;

UPDATE `impostazioni` SET `email_smtp_open_text` = 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%.Status code: (%statuscode%)' WHERE `impostazioni`.`id` = 1;
UPDATE `impostazioni` SET `email_smtp_closed_text` = 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.' WHERE `impostazioni`.`id` = 1;

ALTER TABLE `clienti` CHANGE `nome` `nome` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `cognome` `cognome` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `telefono` `telefono` VARCHAR(28) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `indirizzo` `indirizzo` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `email` `email` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `vat` `vat` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL, CHANGE `cf` `cf` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
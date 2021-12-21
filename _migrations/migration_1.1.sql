ALTER TABLE `categoria`
	CHANGE COLUMN `categoriaPai` `categoriaPai` INT(11) NULL AFTER `id`;

ALTER TABLE `cliente`
	CHANGE COLUMN `telefone` `telefone` VARCHAR(14) NULL DEFAULT NULL COLLATE 'utf8_general_ci' AFTER `cpf`;

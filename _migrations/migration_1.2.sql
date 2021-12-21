ALTER TABLE `situacao`
	ADD COLUMN `diasAtraso` INT NULL AFTER `descricao`,
	CHANGE COLUMN `situacaocol` `dataFinalBloqueio` DATE NULL DEFAULT NULL COLLATE 'utf8_general_ci' AFTER `diasAtraso`;

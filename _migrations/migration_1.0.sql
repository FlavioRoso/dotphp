-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema heroku_0b13a89d723160a
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema heroku_0b13a89d723160a
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `heroku_0b13a89d723160a` DEFAULT CHARACTER SET utf8 ;
USE `heroku_0b13a89d723160a` ;

-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoriaPai` INT NOT NULL,
  `nome` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categoria_categoria_idx` (`categoriaPai` ASC) ,
  CONSTRAINT `fk_categoria_categoria`
    FOREIGN KEY (`categoriaPai`)
    REFERENCES `heroku_0b13a89d723160a`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`editora` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`autor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `historia` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`livro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `editora_id` INT NOT NULL,
  `nome` VARCHAR(200) NULL,
  `dataPublicacao` DATE NULL,
  `dataCadastro` DATE NULL,
  `imgCapa` VARCHAR(200) NULL,
  `sinopse` TEXT NULL,
  `quantidadeDiasEmprestimo` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livro_editora1_idx` (`editora_id` ASC) ,
  CONSTRAINT `fk_livro_editora1`
    FOREIGN KEY (`editora_id`)
    REFERENCES `heroku_0b13a89d723160a`.`editora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`categorias_livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`categorias_livros` (
  `categoria_id` INT NOT NULL,
  `livro_id` INT NOT NULL,
  PRIMARY KEY (`categoria_id`, `livro_id`),
  INDEX `fk_categoria_has_livro_livro1_idx` (`livro_id` ASC) ,
  INDEX `fk_categoria_has_livro_categoria1_idx` (`categoria_id` ASC) ,
  CONSTRAINT `fk_categoria_has_livro_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `heroku_0b13a89d723160a`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categoria_has_livro_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `heroku_0b13a89d723160a`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`autores_livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`autores_livros` (
  `livro_id` INT NOT NULL,
  `autor_id` INT NOT NULL,
  `autorPrincipal` TINYINT(1) NOT NULL,
  PRIMARY KEY (`livro_id`, `autor_id`),
  INDEX `fk_livro_has_autor_autor1_idx` (`autor_id` ASC) ,
  INDEX `fk_livro_has_autor_livro1_idx` (`livro_id` ASC) ,
  CONSTRAINT `fk_livro_has_autor_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `heroku_0b13a89d723160a`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_has_autor_autor1`
    FOREIGN KEY (`autor_id`)
    REFERENCES `heroku_0b13a89d723160a`.`autor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NULL,
  `cpf` VARCHAR(14) NULL,
  `telefone` VARCHAR(9) NULL,
  `celular` VARCHAR(15) NULL,
  `email` VARCHAR(200) NULL,
  `cep` VARCHAR(9) NULL,
  `logradouro` VARCHAR(200) NULL,
  `uf` VARCHAR(2) NULL,
  `cidade` VARCHAR(200) NULL,
  `bairro` VARCHAR(200) NULL,
  `numero` VARCHAR(10) NULL,
  `complemento` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`doacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`doacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NULL,
  `descricao` TEXT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_doacao_cliente1_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_doacao_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `heroku_0b13a89d723160a`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`exemplar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `livro_id` INT NOT NULL,
  `doacao_id` INT NULL,
  `isbn` VARCHAR(11) NULL,
  `localizacao` VARCHAR(20) NULL,
  `dataCadastro` DATE NULL,
  `status` VARCHAR(40) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_exemplar_livro1_idx` (`livro_id` ASC) ,
  INDEX `fk_exemplar_doacao1_idx` (`doacao_id` ASC) ,
  CONSTRAINT `fk_exemplar_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `heroku_0b13a89d723160a`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exemplar_doacao1`
    FOREIGN KEY (`doacao_id`)
    REFERENCES `heroku_0b13a89d723160a`.`doacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`baixa_exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`baixa_exemplar` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `exemplar_id` INT NOT NULL,
  `motivo` TEXT NULL,
  `data` DATE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_baixa_exemplar_exemplar1_idx` (`exemplar_id` ASC) ,
  CONSTRAINT `fk_baixa_exemplar_exemplar1`
    FOREIGN KEY (`exemplar_id`)
    REFERENCES `heroku_0b13a89d723160a`.`exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`funcionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(60) NULL,
  `login` VARCHAR(200) NULL,
  `senha` TEXT NULL,
  `papel` INT NULL,
  `cep` VARCHAR(9) NULL,
  `numero` INT NULL,
  `logradouro` VARCHAR(200) NULL,
  `cidade` VARCHAR(200) NULL,
  `uf` VARCHAR(2) NULL,
  `complemento` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`reserva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `funcionario_id` INT NOT NULL,
  `livro_id` INT NOT NULL,
  `dataLimite` DATETIME NULL,
  `dataCadastro` DATETIME NULL,
  `reservacol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reserva_cliente1_idx` (`cliente_id` ASC) ,
  INDEX `fk_reserva_livro1_idx` (`livro_id` ASC) ,
  INDEX `fk_reserva_funcionario1_idx` (`funcionario_id` ASC) ,
  CONSTRAINT `fk_reserva_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `heroku_0b13a89d723160a`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `heroku_0b13a89d723160a`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_funcionario1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `heroku_0b13a89d723160a`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`emprestimo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `funcionario_id` INT NOT NULL,
  `exemplar_id` INT NOT NULL,
  `dataLimite` DATETIME NULL,
  `dataCadastro` DATETIME NULL,
  `ativo` INT(1) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_emprestimo_cliente1_idx` (`cliente_id` ASC) ,
  INDEX `fk_emprestimo_funcionario1_idx` (`funcionario_id` ASC) ,
  INDEX `fk_emprestimo_exemplar1_idx` (`exemplar_id` ASC) ,
  CONSTRAINT `fk_emprestimo_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `heroku_0b13a89d723160a`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_funcionario1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `heroku_0b13a89d723160a`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_exemplar1`
    FOREIGN KEY (`exemplar_id`)
    REFERENCES `heroku_0b13a89d723160a`.`exemplar` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`situacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`situacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `emprestimo_id` INT NOT NULL,
  `funcionario_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  `tipo` ENUM('M', 'D') NULL,
  `descricao` TEXT NULL,
  `situacaocol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_situacao_emprestimo1_idx` (`emprestimo_id` ASC) ,
  INDEX `fk_situacao_funcionario1_idx` (`funcionario_id` ASC) ,
  INDEX `fk_situacao_cliente1_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_situacao_emprestimo1`
    FOREIGN KEY (`emprestimo_id`)
    REFERENCES `heroku_0b13a89d723160a`.`emprestimo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_situacao_funcionario1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `heroku_0b13a89d723160a`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_situacao_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `heroku_0b13a89d723160a`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heroku_0b13a89d723160a`.`parametrizacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heroku_0b13a89d723160a`.`parametrizacao` (
  `id` INT NOT NULL,
  `multaDiaAtraso` FLOAT NULL,
  `limiteEmprestimoSimultaneos` INT NULL,
  `razaoSocial` VARCHAR(200)  NULL,
  `logo` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

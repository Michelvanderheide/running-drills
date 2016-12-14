
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- account
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account`
(
    `account_pk` INTEGER NOT NULL AUTO_INCREMENT,
    `guid` VARCHAR(255),
    `name` VARCHAR(255),
    `email` VARCHAR(255),
    `password` VARCHAR(255),
    `removed` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`account_pk`),
    UNIQUE INDEX `idx_account_email` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

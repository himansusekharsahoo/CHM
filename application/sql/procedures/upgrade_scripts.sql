/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Shivaraj
 * Created: 14 Apr, 2019
 */

ALTER TABLE `book_assigns` CHANGE `return_date` `return_date` DATETIME NULL DEFAULT NULL;
UPDATE rbac_menu SET url='create-book-assign' WHERE menu_id=21;
ALTER TABLE `book_assigns` ADD `is_book_lost` INT(1) NULL DEFAULT NULL AFTER `book_return_condition`;
ALTER TABLE `book_ledgers` ADD `no_of_books` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `edition`;
ALTER TABLE `book_ledgers` ADD COLUMN `total_copies` INTEGER DEFAULT 0 AFTER `midified_by`,
 ADD COLUMN `lost_copies` INTEGER DEFAULT 0 AFTER `total_copies`,
 ADD COLUMN `copies_instock` INTEGER DEFAULT 0 AFTER `lost_copies`;

CREATE TABLE `book_copies_info` (
  `book_copies_id` INTEGER NOT NULL AUTO_INCREMENT,
  `bledger_id` INTEGER NOT NULL,
  `book_barcode_info` VARCHAR(250),
  `book_copy_count` INTEGER,
  PRIMARY KEY (`book_copies_id`)
)
ENGINE = InnoDB;

ALTER TABLE `book_copies_info` ADD COLUMN `book_availability` VARCHAR(5) NOT NULL DEFAULT 'A' AFTER `book_copy_count`;
ALTER TABLE `books` ADD `language` VARCHAR(100) NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `book_assigns` ADD `book_copy_id` INT NOT NULL AFTER `member_id`, ADD INDEX (`book_copy_id`);
ALTER TABLE `book_assigns` ADD CONSTRAINT `FK_BOOK_COPY_ID` FOREIGN KEY (`book_copy_id`) REFERENCES `book_copies_info`(`book_copies_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
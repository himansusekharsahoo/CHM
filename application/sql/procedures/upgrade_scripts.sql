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

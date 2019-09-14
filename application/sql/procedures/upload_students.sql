-- course academic master upload utility
delimiter //
CREATE OR REPLACE PROCEDURE upload_student (IN table_name varchar(70),IN user_id int)
BEGIN

-- insert new students
SET @QRY="INSERT INTO rbac_users (first_name,last_name,email,mobile,status,user_type,password,login_id,created_by)";
SET @QRY=CONCAT(@QRY," select distinct first_name,last_name,email_id,mobile_no,status,'student','ZGE4N2NuZmZqYmVxNTIwOQ##',registration_no,",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND lower(email_id) NOT ");
SET @QRY=CONCAT(@QRY," IN(SELECT distinct lower(email) FROM rbac_users)");
SET @QRY=CONCAT(@QRY," AND lower(registration_no) NOT ");
SET @QRY=CONCAT(@QRY," IN(SELECT distinct lower(login_id) FROM rbac_users where login_id is not null)");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert student profiles

DEALLOCATE PREPARE stmt;

END//
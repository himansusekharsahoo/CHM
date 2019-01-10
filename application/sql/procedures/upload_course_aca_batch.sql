-- course academic master upload utility
delimiter //
CREATE OR REPLACE PROCEDURE upload_course_aca_batch (IN table_name varchar(70),IN user_id int)
BEGIN

-- insert new course category
SET @QRY="INSERT INTO course_category_masters (name,code,description,created_by)";
SET @QRY=CONCAT(@QRY," select distinct category_name,category_code,category_desc,",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND trim(category_code)<>'' AND lower(category_code) NOT ");
SET @QRY=CONCAT(@QRY," IN(SELECT distinct lower(code) FROM course_category_masters)");
SET @QRY=CONCAT(@QRY,"GROUP BY category_code");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- update course category
SET @QRY="UPDATE course_category_masters ccm";
SET @QRY=CONCAT(@QRY," LEFT JOIN ",table_name," tmp on tmp.category_code=ccm.code");
SET @QRY=CONCAT(@QRY," SET ccm.name=tmp.category_name,ccm.description=tmp.category_desc");
SET @QRY=CONCAT(@QRY," WHERE ccm.code=tmp.category_code");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert course_department_masters
SET @QRY="INSERT INTO course_department_masters (name,code,created_by,course_category_id)";
SET @QRY=CONCAT(@QRY," SELECT distinct department_name,department_code,",user_id,",course_category_id");
SET @QRY=CONCAT(@QRY," FROM ",table_name," tmp");
SET @QRY=CONCAT(@QRY," RIGHT JOIN course_category_masters ccm on tmp.category_code=ccm.code");
SET @QRY=CONCAT(@QRY," WHERE (tmp.remarks is null OR tmp.remarks='')");
SET @QRY=CONCAT(@QRY," AND (trim(tmp.department_code)<>'')");
SET @QRY=CONCAT(@QRY," AND lower(tmp.department_code) NOT IN(SELECT distinct lower(code) FROM course_department_masters)");

PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- update course_department_masters
SET @QRY="UPDATE course_department_masters cdm";
SET @QRY=CONCAT(@QRY," LEFT JOIN ",table_name," tmp on tmp.department_code=cdm.code");
SET @QRY=CONCAT(@QRY," LEFT JOIN course_category_masters ccm on tmp.category_code=ccm.code");
SET @QRY=CONCAT(@QRY," SET cdm.name=tmp.department_name,cdm.created_by=",user_id);
SET @QRY=CONCAT(@QRY," WHERE cdm.code=tmp.department_code AND ccm.code=tmp.category_code");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert course_aca_batch_masters
SET @QRY="INSERT INTO course_aca_batch_masters (name,description,start_year,end_year,terms,course_dept_id,created_by)";
SET @QRY=CONCAT(@QRY," SELECT distinct batch_name,batch_desc,start_year,end_year,no_of_semister,cdm.course_dept_id,",user_id); 
SET @QRY=CONCAT(@QRY," FROM ",table_name," tmp"); 
SET @QRY=CONCAT(@QRY," RIGHT JOIN course_department_masters cdm on tmp.department_code=cdm.code"); 
SET @QRY=CONCAT(@QRY," WHERE (tmp.remarks is null OR tmp.remarks='')"); 
SET @QRY=CONCAT(@QRY," AND (trim(tmp.batch_name)<>'')"); 
SET @QRY=CONCAT(@QRY," AND lower(tmp.batch_name) NOT IN(SELECT distinct lower(name) FROM course_aca_batch_masters)"); 

PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- update course_aca_batch_masters
SET @QRY="UPDATE course_aca_batch_masters cabm";
SET @QRY=CONCAT(@QRY," LEFT JOIN ",table_name," tmp on tmp.batch_name=cabm.name");
SET @QRY=CONCAT(@QRY," SET cabm.description=tmp.batch_desc");
SET @QRY=CONCAT(@QRY," WHERE (tmp.remarks is null OR tmp.remarks='')"); 
SET @QRY=CONCAT(@QRY," AND trim(tmp.batch_name)<>''");
SET @QRY=CONCAT(@QRY," AND cabm.name=tmp.batch_name");

PREPARE stmt FROM @QRY;
EXECUTE stmt;

DEALLOCATE PREPARE stmt;

END//
-- To debug the procedure
delimiter //
CREATE OR REPLACE PROCEDURE query_log(IN query text)
BEGIN

SET @QRY=CONCAT("INSERT INTO query_log(query) values(\"",query,"\")");
PREPARE qstmt FROM @QRY;
EXECUTE qstmt;
DEALLOCATE PREPARE qstmt;

END//


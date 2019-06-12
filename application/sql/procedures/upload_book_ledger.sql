-- course academic master upload utility
delimiter //
CREATE OR REPLACE PROCEDURE upload_book_ledger (IN table_name varchar(70),IN user_id int)
BEGIN

-- insert new books
SET @QRY="INSERT INTO books (name,code,status,created_by)";
SET @QRY=CONCAT(@QRY," select book_name,upper(book_name) book_code,'active',",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND replace(lower(book_name),' ','') not in(select replace(lower(name),' ','') from books)");
SET @QRY=CONCAT(@QRY," GROUP BY book_name");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert new book category
SET @QRY="INSERT INTO book_category_masters (name,code,status,parent_id,created_by)";
SET @QRY=CONCAT(@QRY," select book_category_name,upper(book_category_name) book_category_code,'active',0,",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND replace(lower(book_category_name),' ','') not in(select replace(lower(name),' ','') from book_category_masters)");
SET @QRY=CONCAT(@QRY," GROUP BY book_category_name");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert new book publication
SET @QRY="INSERT INTO book_publication_masters (name,code,status,created_by)";
SET @QRY=CONCAT(@QRY," select book_publication,upper(book_publication) book_publication_code,'active',",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND replace(lower(book_publication),' ','') not in(select replace(lower(name),' ','') from book_publication_masters)");
SET @QRY=CONCAT(@QRY," GROUP BY book_publication");
PREPARE stmt FROM @QRY;
EXECUTE stmt;

-- insert new book author
SET @QRY="INSERT INTO book_author_masters (author_name,status,created_by)";
SET @QRY=CONCAT(@QRY," select author_name,'active',",user_id);
SET @QRY=CONCAT(@QRY," from ",table_name," WHERE (remarks is null OR remarks='')");
SET @QRY=CONCAT(@QRY," AND replace(lower(author_name),' ','') not in(select replace(lower(author_name),' ','') from book_author_masters)");
SET @QRY=CONCAT(@QRY," GROUP BY author_name");
PREPARE stmt FROM @QRY;
EXECUTE stmt;
-- update book details in ledger
SET @QRY="UPDATE book_ledgers BLEDG 
RIGHT JOIN (
	SELECT
	T.book_name,T.book_category_name,T.book_publication,T.author_name,T.isbn,T.pages,T.mrp,T.edition,
	B.book_id,BC.bcategory_id,BA.bauthor_id,BP.publication_id,BL.location_id";
        SET @QRY=CONCAT(@QRY," FROM ",table_name," T");
        SET @QRY=CONCAT(@QRY," LEFT JOIN books B ON replace(lower(B.name),' ','')=replace(lower(T.book_name),' ','')
	LEFT JOIN book_category_masters BC ON replace(lower(BC.name),' ','')=replace(lower(T.book_category_name),' ','')
	LEFT JOIN book_author_masters BA ON replace(lower(BA.author_name),' ','')=replace(lower(T.author_name),' ','')
	LEFT JOIN book_publication_masters BP ON replace(lower(BP.name),' ','')=replace(lower(T.book_publication),' ','')
	LEFT JOIN (
	  SELECT CONCAT(floor,'-',block,'-',rack_no,'-',self_no) location,blocation_id location_id from book_location_masters
	) BL ON replace(lower(BL.location),' ','')=replace(lower(T.book_location),' ','')
        WHERE (T.REMARKS IS NULL OR T.REMARKS='')
)TMP ON TMP.book_id=BLEDG.book_id
and TMP.bcategory_id=BLEDG.bcategory_id
and TMP.publication_id=BLEDG.bpublication_id
and TMP.bauthor_id=BLEDG.bauthor_id
and TMP.location_id=BLEDG.blocation_id
SET BLEDG.page=TMP.pages
,BLEDG.mrp=TMP.mrp
,BLEDG.edition=TMP.edition
,BLEDG.isbn_no=TMP.isbn
,BLEDG.midified_by=",user_id,
",BLEDG.modified=CURRENT_TIMESTAMP,BLEDG.no_of_books=T.number_of_books" 	
);
PREPARE stmt FROM @QRY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Insert new ledger
SET @QRY="INSERT INTO book_ledgers (book_id,bcategory_id,bpublication_id,bauthor_id,blocation_id,page,mrp,isbn_no,edition,no_of_books,created_by)
SELECT DISTINCT
book_id,bcategory_id,publication_id,bauthor_id,location_id,pages,mrp,isbn,edition,number_of_books,";
SET @QRY=CONCAT(@QRY,user_id);
SET @QRY=CONCAT(@QRY,"
FROM(
    SELECT DISTINCT	
    B.book_id,BC.bcategory_id,BA.bauthor_id,BP.publication_id,BL.location_id,T.pages,T.mrp,T.isbn,T.edition,T.number_of_books,
    T.record_no
    FROM ",table_name," T
    LEFT JOIN books B ON replace(lower(B.name),' ','')=replace(lower(T.book_name),' ','')
    LEFT JOIN book_category_masters BC ON replace(lower(BC.name),' ','')=replace(lower(T.book_category_name),' ','')
    LEFT JOIN book_author_masters BA ON replace(lower(BA.author_name),' ','')=replace(lower(T.author_name),' ','')
    LEFT JOIN book_publication_masters BP ON replace(lower(BP.name),' ','')=replace(lower(T.book_publication),' ','')
    LEFT JOIN (
      SELECT CONCAT(floor,'-',block,'-',rack_no,'-',self_no) location,blocation_id location_id from book_location_masters
    ) BL ON replace(lower(BL.location),' ','')=replace(lower(T.book_location),' ','')
    WHERE (T.REMARKS IS NULL OR T.REMARKS='')
    AND T.record_no NOT IN(
        SELECT DISTINCT record_no
        FROM book_ledgers BLEDG 
        LEFT JOIN (
            SELECT	
            T.record_no,B.book_id,BC.bcategory_id,BA.bauthor_id,BP.publication_id,BL.location_id
            FROM temp_book_ledger_1 T
            LEFT JOIN books B ON replace(lower(B.name),' ','')=replace(lower(T.book_name),' ','')
            LEFT JOIN book_category_masters BC ON replace(lower(BC.name),' ','')=replace(lower(T.book_category_name),' ','')
            LEFT JOIN book_author_masters BA ON replace(lower(BA.author_name),' ','')=replace(lower(T.author_name),' ','')
            LEFT JOIN book_publication_masters BP ON replace(lower(BP.name),' ','')=replace(lower(T.book_publication),' ','')
            LEFT JOIN (
              SELECT CONCAT(floor,'-',block,'-',rack_no,'-',self_no) location,blocation_id location_id from book_location_masters
            ) BL ON replace(lower(BL.location),' ','')=replace(lower(T.book_location),' ','')
            WHERE T.REMARKS IS NULL OR T.REMARKS=''
        )TMP ON TMP.book_id=BLEDG.book_id
        and TMP.bcategory_id=BLEDG.bcategory_id
        and TMP.publication_id=BLEDG.bpublication_id
        and TMP.bauthor_id=BLEDG.bauthor_id
        and TMP.location_id=BLEDG.blocation_id
        WHERE record_no is not null
    )
) TMP");
PREPARE stmt FROM @QRY;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

END//
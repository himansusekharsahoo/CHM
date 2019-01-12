create or replace view book_ledger_list_view as
SELECT DISTINCT bledger_id,t2.name as book_name,t3.name as bcategory_name,t4.name as publicatoin_name
,author_name,concat(floor," ",block," ",rack_no) as location,page,mrp,isbn_no,edition,bar_code
,qr_code,t1.created,concat(u.first_name,' ',u.last_name) created_by
,t1.modified,concat(u2.first_name,' ',u2.last_name) midified_by
,t1.book_id,t1.bcategory_id,t1.bpublication_id,t1.bauthor_id,t1.blocation_id
FROM book_ledgers t1
LEFT JOIN books t2 ON t1.book_id=t2.book_id
LEFT JOIN book_category_masters t3 ON t3.bcategory_id=t1.bcategory_id
LEFT JOIN book_publication_masters t4 ON t4.publication_id=t1.bpublication_id
LEFT JOIN book_author_masters t5 ON t5.bauthor_id=t1.bauthor_id
LEFT JOIN book_location_masters t6 ON t6.blocation_id=t1.blocation_id
LEFT JOIN rbac_users u ON u.user_id=t1.created_by
LEFT JOIN rbac_users u2 ON u2.user_id=t1.midified_by;
create or replace view book_publication_list_view as
SELECT DISTINCT t1.publication_id,t1.name,t1.code,t1.status,t1.remarks,DATE_FORMAT(t1.created, "%d-%m-%Y %l:%i %p") created,concat(u.first_name," ",u.last_name) created_by_name
FROM book_publication_masters t1
LEFT JOIN rbac_users u ON u.user_id=t1.created_by;
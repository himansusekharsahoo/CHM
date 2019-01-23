create or replace view book_category_list_view as
SELECT DISTINCT t1.bcategory_id,t1.name,t1.code,t1.status,t1.created,concat(u.first_name," ",u.last_name) created_by_name
FROM book_category_masters t1
LEFT JOIN rbac_users u ON u.user_id=t1.created_by;
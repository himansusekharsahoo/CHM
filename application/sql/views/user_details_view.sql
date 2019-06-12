create or replace view user_details_view as
SELECT DISTINCT 
ru.user_id,ru.first_name,ru.last_name,
case when ru.login_id is null or ru.login_id='' then ru.email else ru.login_id end,ru.email,ru.mobile,ru.user_type,ru.login_status,
DATE_FORMAT(ru.created, "%d-%m-%Y %l:%i %p") user_created,ru.created_by user_created_by,DATE_FORMAT(ru.modified, "%d-%m-%Y %l:%i %p") user_modified,ru.modified_by user_modified_by
,ru.status user_status
,lm.member_id,lm.card_no,lm.date_issue,lm.expiry_date,DATE_FORMAT(lm.created, "%d-%m-%Y %l:%i %p") lm_created,lm.created_by lm_creeated_by
,lm.status lm_status
,sp.photo student_photo,sp.sign student_sign
FROM rbac_users ru
LEFT JOIN library_members lm ON lm.user_id=ru.user_id
LEFT JOIN student_profiles sp ON sp.user_id=ru.user_id;
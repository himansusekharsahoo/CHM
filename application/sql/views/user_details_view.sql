create or replace view user_details_view as
SELECT DISTINCT 
ru.user_id,ru.first_name,ru.last_name,ru.login_id,ru.email,ru.mobile,ru.user_type,ru.login_status,
ru.created user_created,ru.created_by user_created_by,ru.modified user_modified,ru.modified_by user_modified_by
,ru.status user_status
,lm.member_id,lm.card_no,lm.date_issue,lm.expiry_date,lm.created lm_created,lm.created_by lm_creeated_by
,lm.status lm_status
,sp.photo student_photo,sp.sign student_sign
FROM rbac_users ru
LEFT JOIN library_members lm ON lm.user_id=ru.user_id
LEFT JOIN student_profiles sp ON sp.user_id=ru.user_id;
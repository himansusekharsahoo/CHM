create or replace view library_members_view as
select distinct 
u.member_id,u.card_no,u.date_issue,u.expiry_date,u.user_id,u.user_role_id,DATE_FORMAT(u.created, "%d-%m-%Y %l:%i %p") created,u.created_by,u.status
,u.first_name,u.last_name,concat(u.first_name,' ',u.last_name) user_name,u.email,u.mobile,u.user_type
,GROUP_CONCAT(trim(code), ', ') code_list,concat(ru.first_name,' ',ru.last_name) created_by_name
from user_details_view1 u
left join rbac_users ru on ru.user_id=u.created_by
group by member_id;
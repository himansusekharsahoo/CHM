create or replace view library_members_view1 as
select 
lm.member_id,lm.card_no,lm.date_issue,lm.expiry_date,lm.user_id,lm.user_role_id,lm.created,lm.created_by,lm.status
,ru.first_name,ru.last_name,ru.email,ru.mobile,ru.user_type
,rr.name,rr.code
from library_members lm
left join rbac_users ru on ru.user_id=lm.user_id
left join rbac_roles rr on rr.role_id=lm.user_role_id
union all
select 
lm.member_id,lm.card_no,lm.date_issue,lm.expiry_date,lm.user_id,lm.user_role_id,lm.created,lm.created_by,lm.status
,ru.first_name,ru.last_name,ru.email,ru.mobile,ru.user_type
,rr.name,rr.code
from library_members lm
right join rbac_users ru on ru.user_id=lm.user_id
right join rbac_user_roles rur on rur.user_id=lm.user_id
right join rbac_roles rr on rr.role_id=rur.role_id
where lm.member_id is not null;
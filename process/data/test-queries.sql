use clientprocess;

select corpclient.cid,cfn,cln,cstreet,ccity,cst,czip,soft_name, comments, dept_name, department.dept_id
from corpclient, address, software, clientsoftware, clientcomments, department
where corpclient.cid=address.cid 
and corpclient.cid=clientsoftware.cid 
and software.soft_id=clientsoftware.soft_id 
and corpclient.cid = clientcomments.cid
and corpclient.dept_id = department.dept_id
# corpclient.cid=address.cid

# corpclient.cid=clientsoftware.cid and
# software.soft_id=clientsoftware.soft_id

# corpclient.cid = clientcomments.cid

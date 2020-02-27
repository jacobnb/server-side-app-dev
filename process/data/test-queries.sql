use clientprocess;
select corpclient.cid,cfn,cln,cstreet,ccity,cst,czip,soft_name,dept_name, department.dept_id
from corpclient, address, software, clientsoftware, department#, clientcomments
where corpclient.cid=address.cid 
and corpclient.cid=clientsoftware.cid 
and software.soft_id=clientsoftware.soft_id 
# software has name and type (os, or other)
#client software just has soft_id
and software.soft_type !=1 # ignore OS.
# and software.soft_id = 7 #1-4 OS, 5-7 software.
#and corpclient.cid = clientcomments.cid
and corpclient.dept_id = department.dept_id
order by cid
# corpclient.cid=address.cid

# corpclient.cid=clientsoftware.cid and
# software.soft_id=clientsoftware.soft_id

# corpclient.cid = clientcomments.cid

use clients;

select * from corpclient;
select * from address;
select * from clientcomments;
select * from clientsoftware;
select * from department;
select * from software;

select corpclient.cem,cfn,cln,cstreet,ccity,cst,czip
from corpclient, address
where corpclient.cem=address.cem
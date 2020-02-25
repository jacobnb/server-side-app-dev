use clients;

delete from software where soft_id>0;

insert into department values(1, "Marketing");
insert into department values(2, "Accounting");
insert into department values(3, "Operations");
insert into department values(4, "IT");

insert into software values(1,"Windows 10");
insert into software values(2,"Windows 8");
insert into software values(3,"Windows 7");
insert into software values(4,"MAC");
insert into software values(5,"Word");
insert into software values(6,"Excel");
insert into software values(7,"PowerPoint");

select * from software;
select * from department

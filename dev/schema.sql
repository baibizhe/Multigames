drop table appuser cascade;

create table appuser (
	userid varchar(50) primary key,
	password varchar(50),
	gender varchar(50),
	color varchar(50),
	for_fun varchar(50),
	for_chan varchar(50),
	CSC409 varchar(50)
);

insert into appuser values('auser', 'apassword');


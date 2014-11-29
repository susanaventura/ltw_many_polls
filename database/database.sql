
drop table if exists User;
drop table if exists Poll;
drop table if exists PossibleAnswer;
drop table if exists Question;
drop table if exists UsersPoll;
drop table if exists UserAnswerPoll;


create table User(
	id integer PRIMARY KEY AUTOINCREMENT,
	username varchar NOT NULL,	
	birthDate date NOT NULL,
	firstName varchar NOT NULL,
	lastName varchar NOT NULL,
	mail varchar,
	password varchar NOT NULL,
	UNIQUE(username, mail)
);

create table Poll(
	id integer PRIMARY KEY AUTOINCREMENT,
	title varchar,
	image varchar,
	isPrivate integer NOT NULL CHECK(isPrivate = 0 or isPrivate = 1 or isPrivate = 2), --0 public, 1 private, 2 shared with friends
	owner varchar REFERENCES User(username)
);

create table Question(
	id integer PRIMARY KEY AUTOINCREMENT,
	question varchar NOT NULL,
	poll integer REFERENCES Poll(id),
	UNIQUE(poll, question)
);

create table PossibleAnswer(
	id integer PRIMARY KEY AUTOINCREMENT,
	answer varchar NOT NULL,
	question integer REFERENCES Question(id),
	UNIQUE(answer, question)
);
	
create table UserAnswerPoll(
	user varchar REFERENCES User(username),
	answer integer REFERENCES PossibleAnswer(id)
);

create table UsersPoll(
	user varchar REFERENCES User(username),
	poll integer REFERENCES Poll(id)
);


insert into User values(NULL, 'teste', '5-05-1994', 'susana', 'ventura', 'teste@mail.pt', '123');

insert into Poll values(NULL, 'Loret', 'http://www.jornalglobal.com/wp-content/uploads/2014/10/chocolate.jpg', 0, 'teste');
insert into Poll values(NULL, 'Ipsum', 'http://placehold.it/200&text=Many%20Polls', 0, 'teste');

insert into Question values(NULL, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae?', 1);
insert into Question values(NULL, 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae?', 2);

insert into PossibleAnswer values(NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1);
insert into PossibleAnswer values(NULL, 'Integer a lorem ac ex tristique consectetur eget at metus.', 1);
insert into PossibleAnswer values(NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 2);
insert into PossibleAnswer values(NULL, 'Integer a lorem ac ex tristique consectetur eget at metus.', 2);

insert into UserAnswerPoll values('teste', 1);

insert into UsersPoll values('teste', 1);
insert into UsersPoll values('teste', 2);





/*insert into users values('teste', '123');*/
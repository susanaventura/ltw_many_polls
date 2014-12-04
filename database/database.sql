
drop table if exists UsersPoll;
drop table if exists UserAnswerPoll;
drop table if exists PossibleAnswer;
drop table if exists Question;
drop table if exists Poll;
drop table if exists User;


pragma foreign_keys = ON;

create table User(
	username varchar PRIMARY KEY,	
	birthDate date NOT NULL,
	firstName varchar NOT NULL,
	lastName varchar NOT NULL,
	mail varchar NOT NULL UNIQUE,
	password varchar NOT NULL
);

create table Poll(
	id integer PRIMARY KEY AUTOINCREMENT,
	title varchar,
	image varchar,
	isPrivate integer NOT NULL CHECK(isPrivate = 0 or isPrivate = 1 or isPrivate = 2), --0 public, 1 private, 2 shared with friends
	owner varchar REFERENCES User(username) ON DELETE CASCADE,
	voteLabel varchar DEFAULT 'Vote',
	resultsLabel varchar DEFAULT 'Submit'
);

create table Question(
	id integer PRIMARY KEY AUTOINCREMENT,
	question varchar NOT NULL,
	poll integer REFERENCES Poll(id) ON DELETE CASCADE,
	multipleAnswers integer CHECK(multipleAnswers = 0 OR multipleAnswers = 1),
	UNIQUE(poll, question)
);

create table PossibleAnswer(
	id integer PRIMARY KEY AUTOINCREMENT,
	answer varchar NOT NULL,
	question integer REFERENCES Question(id) ON DELETE CASCADE,
	UNIQUE(answer, question)
);
	
create table UserAnswerPoll(
	user varchar REFERENCES User(username),
	answer integer REFERENCES PossibleAnswer(id) ON DELETE CASCADE
);

create table UsersPoll(
	user varchar REFERENCES User(username),
	poll integer REFERENCES Poll(id) ON DELETE CASCADE
);


insert into User values('admin', '5-05-1994', 'admin', 'admin', 'admin@mail.pt', '$2y$12$ybiyTiXsC/3bDnFLVTGXWebhKpVn7CqXRQKhBRZw2c.3qc/lFPiNy');

insert into Poll values(NULL, 'Loret', 'http://www.jornalglobal.com/wp-content/uploads/2014/10/chocolate.jpg', 0, 'admin', 'Coiso', 'See Results');
insert into Poll values(NULL, 'Ipsum', 'http://placehold.it/200&text=Many%20Polls', 0, 'admin', 'Vote', 'See Results');

insert into Question values(NULL, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae?', 1, 0);
insert into Question values(NULL, 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae?', 2, 1);

insert into PossibleAnswer values(NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1);
insert into PossibleAnswer values(NULL, 'Integer a lorem ac ex tristique consectetur eget at metus.', 1);
insert into PossibleAnswer values(NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 2);
insert into PossibleAnswer values(NULL, 'Integer a lorem ac ex tristique consectetur eget at metus.', 2);

insert into UserAnswerPoll values('admin', 1);

insert into UsersPoll values('admin', 1);
insert into UsersPoll values('admin', 2);


.mode columns
.headers on
.nullvalue NULL

PRAGMA foreign_keys = OFF;

drop table if exists User;
drop table if exists Poll;
drop table if exists PossibleAnswer;
drop table if exists PossibleAnswerPoll;
drop table if exists UserAnswerPoll;
drop table if exists Question;
drop table if exists QuestionPoll;
drop table if exists UsersPoll;


create table User(
	id integer PRIMARY KEY AUTOINCREMENT,
	userName nvarchar(10),
	birthDate date NOT NULL,
	firstName varchar NOT NULL,
	lastName varchar NOT NULL,
	mail nvarchar,
	password varchar NOT NULL,
	UNIQUE(userName, mail)
);
	
create table Poll(
	id integer PRIMARY KEY AUTOINCREMENT,
	image varbinary,
	isPrivate integer NOT NULL CHECK(isPrivate = 0 or isPrivate = 1),
	owner integer REFERENCES User(id)
);

create table PossibleAnswer(
	id integer PRIMARY KEY AUTOINCREMENT,
	answer nvarchar(50) NOT NULL
);

create table PossibleAnswerPoll(
	poll integer REFERENCES Poll(id),
	possibleAnswer nvarchar(50) REFERENCES PossibleAnswer(id),
	PRIMARY KEY(poll, possibleAnswer)
);
	
create table UserAnswerPoll(
	user integer REFERENCES User(id),
	poll integer, answer nvarchar(50),
	FOREIGN KEY(poll, answer) REFERENCES PossibleAnswerPoll(poll, possibleAnswer)
);
	
create table Question(
	id integer PRIMARY KEY AUTOINCREMENT,
	question nvarchar(50) NOT NULL
);

create table QuestionPoll(
	question integer REFERENCES Question(id),
	poll integer REFERENCES Poll(id),
	PRIMARY KEY(question, poll)
);

create table UsersPoll(
	poll integer REFERENCES Poll(id),
	user integer REFERENCES User(id),
	PRIMARY KEY(poll, user)
);
	
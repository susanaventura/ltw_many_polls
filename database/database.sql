
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
	resultsLabel varchar DEFAULT 'See Results'
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
	user varchar REFERENCES User(username) ON DELETE CASCADE,
	answer integer REFERENCES PossibleAnswer(id) ON DELETE CASCADE
);

create table UsersPoll(
	user varchar REFERENCES User(username) ON DELETE CASCADE,
	poll integer REFERENCES Poll(id) ON DELETE CASCADE
);

--------------------------------------------- user ---------------------------------------------------
insert into User values('admin', '1994-05-05', 'Susana', 'Ventura', 'admin@mail.pt', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('teste', '1994-05-15', 'Susana', 'Ventura', 'teste@mail.pt', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('CASW134', '1990-12-02', 'Carlos', 'Almeida', 'CASW134@mail.pt', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('AS32_Sil', '1960-02-25', 'Alberto', 'Silva', 'AS32_Sil@mail.pt', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('NL3236_lar', '1991-04-12', 'Nuno', 'Laranja', 'NL3236_lar@mail.pt', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('X_T2313', '1994-05-05', 'Xavier', 'Torrié', 'X_T2313@mail.com.br', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');
insert into User values('And_stro_1213', '1996-06-07', 'Andresson', 'Strong', 'And_stro_1213@mail.com', '$2y$12$QJWQmalLT66Z6Qt5MCXU8uDtOmkOcYLE45c5QdVCvdnLwKNvAE7bS');

--------------------------------------------- poll------------------------------------------------------------
insert into Poll values(NULL, 'Loret', 'http://www.jornalglobal.com/wp-content/uploads/2014/10/chocolate.jpg', 0, 'teste', 'Coiso', 'See Results');
insert into Poll values(NULL, 'Coca-cola', '../images/upload/cocacola.jpg', 0, 'teste', 'Vote', 'See Results');
insert into Poll values(NULL, 'wine', '../images/upload/portowine.jpg', 1, 'CASW134', 'Vote', 'See Results');
insert into Poll values(NULL, 'Fanta', '../images/upload/fanta.png', 0, 'CASW134', 'Vote', 'See Results');
insert into Poll values(NULL, 'security', '../images/upload/security.jpg', 0, 'AS32_Sil', 'Vote', 'See Results');
insert into Poll values(NULL, 'cooking', '../images/upload/cooking.jpg', 0, 'AS32_Sil', 'Vote', 'See Results');
insert into Poll values(NULL, 'Coffee', '../images/upload/coffe.jpg', 0, 'NL3236_lar', 'Vote', 'See Results');

-------------------------------------------Question--------------------------------------------------
insert into Question values(NULL, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae?', 1, 0);
insert into Question values(NULL, 'Is coca-cola bad to the human body?', 2, 0);
insert into Question values(NULL, 'Is Porto wine the best wine in the world?', 3, 0);
insert into Question values(NULL, 'Witch fanta is the best fanta?', 4, 1);
insert into Question values(NULL, 'What is the level of security you feel in Portugal? 1 = bad and 5 = very good', 5, 0);
insert into Question values(NULL, 'Do you like cooking?', 6, 1);
insert into Question values(NULL, 'Do you think about coffee?', 7, 0);
------------------------------------------PossibleAnswer--------------------------------------------------------
insert into PossibleAnswer values(NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1);
insert into PossibleAnswer values(NULL, 'Integer a lorem ac ex tristique consectetur eget at metus.', 1);
insert into PossibleAnswer values(NULL, 'Yes.', 2);
insert into PossibleAnswer values(NULL, 'No.', 2);
insert into PossibleAnswer values(NULL, 'Yes.', 3);
insert into PossibleAnswer values(NULL, 'No.', 3);
insert into PossibleAnswer values(NULL, 'Orange.', 4);
insert into PossibleAnswer values(NULL, 'Lemon.', 4);
insert into PossibleAnswer values(NULL, 'Strawberry.', 4);
insert into PossibleAnswer values(NULL, 'Pineapple.', 4);
insert into PossibleAnswer values(NULL, '1.', 5);
insert into PossibleAnswer values(NULL, '2.', 5);
insert into PossibleAnswer values(NULL, '3.', 5);
insert into PossibleAnswer values(NULL, '4.', 5);
insert into PossibleAnswer values(NULL, '5.', 5);
insert into PossibleAnswer values(NULL, 'Yes.', 6);
insert into PossibleAnswer values(NULL, 'No.', 6);
insert into PossibleAnswer values(NULL, 'Yes.', 7);
insert into PossibleAnswer values(NULL, 'No.', 7);

---------------------------------------UserAnswerPoll-------------------------------------------------------------
insert into UserAnswerPoll values('teste', 1);
insert into UserAnswerPoll values('CASW134', 2);
insert into UserAnswerPoll values('AS32_Sil', 3);
insert into UserAnswerPoll values('AS32_Sil', 1);
insert into UserAnswerPoll values('NL3236_lar', 1);
insert into UserAnswerPoll values('NL3236_lar', 2);
insert into UserAnswerPoll values('NL3236_lar', 3);
insert into UserAnswerPoll values('X_T2313', 1);
insert into UserAnswerPoll values('X_T2313', 2);
insert into UserAnswerPoll values('X_T2313', 3);
insert into UserAnswerPoll values('X_T2313', 4);
insert into UserAnswerPoll values('teste', 5);


-------------------------------------------UsersPoll-------------------------------------------------------------
insert into UsersPoll values('teste', 1);
insert into UsersPoll values('teste', 2);
insert into UsersPoll values('CASW134', 3);
insert into UsersPoll values('teste', 4);
insert into UsersPoll values('teste', 5);
insert into UsersPoll values('AS32_Sil', 6);
insert into UsersPoll values('AS32_Sil', 7);


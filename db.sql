
CREATE TABLE questions (question_id integer not null PRIMARY KEY, question_answer float(1), question_scale float(1));
INSERT INTO questions (question_id,question_answer,question_scale) VALUES (1,-4.6,.1), (2,-3.5,.1), (3,-200,25), (4,-140,20), (5,-4,2), (6,-7,1), (7,-300,25), (8,1869,1), (9, 1969, 1);

CREATE TABLE useradmin (user_id serial PRIMARY KEY, u VARCHAR (355) NOT NULL,p VARCHAR (355) NOT NULL);

CREATE TABLE users (
 user_id serial PRIMARY KEY,
 fn VARCHAR (355),
 ln VARCHAR (355),
 email VARCHAR (355),
 address VARCHAR (355),
 city VARCHAR (355),
 state VARCHAR (355),
 zip VARCHAR (355),
 opt_in VARCHAR (355),
 utmSource VARCHAR (355),
 utmMedium VARCHAR (355),
 utmCampaign VARCHAR (355),
 utmTerm VARCHAR (355),
 utmContent VARCHAR (355),
 q1 float(1),
 q2 float(1),
 q3 float(1),
 q4 float(1),
 q5 float(1),
 q6 float(1),
 q7 float(1),
 q8 float(1),
 q9 float(1),
 q10 float(1),
 created_on TIMESTAMP
);


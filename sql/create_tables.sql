CREATE TABLE Usr (
    id SERIAL PRIMARY KEY,
    name varchar(12) NOT NULL,
    password varchar(20) NOT NULL,
    admin boolean DEFAULT FALSE
);

CREATE TABLE Category (
    id SERIAL PRIMARY KEY,
    name varchar(120) NOT NULL,
    Usr_id INTEGER REFERENCES Usr(id), 
    added DATE
);

CREATE TABLE Topic (
    id SERIAL PRIMARY KEY,
    name varchar(120),
    Usr_id INTEGER REFERENCES Usr(id),
    Category_id INTEGER REFERENCES Category(id),
    content varchar(1000),
    added DATE
);

CREATE TABLE Reply (
    id SERIAL PRIMARY KEY,
    Usr_id INTEGER REFERENCES Usr(id),
    added DATE,
    Topic_id INTEGER REFERENCES Topic(id),
    content varchar(1000)
);

CREATE TABLE UsrSeenTopic (
    Usr_id INTEGER REFERENCES Usr(id),
    Topic_id INTEGER REFERENCES Topic(id)
);

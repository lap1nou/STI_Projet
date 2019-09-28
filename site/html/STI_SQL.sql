CREATE TABLE IF NOT EXISTS 'user' (
    'id_user' INTEGER UNIQUE,
    'username' VARCHAR(45) UNIQUE NOT NULL,
    'password' VARCHAR(255) NOT NULL,
    'role' INTEGER NOT NULL DEFAULT 0,
    'enabled' BOOLEAN NOT NULL DEFAULT 1,
    PRIMARY KEY ('id_user'));

CREATE TABLE IF NOT EXISTS 'message' (
    'id_message' INTEGER UNIQUE,
    'id_sender' INTEGER NOT NULL,
    'id_receiver' INTEGER NOT NULL,
    'subject' VARCHAR NOT NULL,
    'text' VARCHAR NOT NULL,
    'date' DATETIME DEFAULT (datetime('now','localtime')),
    FOREIGN KEY ('id_sender') REFERENCES 'user' ('id_user'),
    FOREIGN KEY ('id_receiver') REFERENCES 'user' ('id_user'),
    PRIMARY KEY ('id_message'));
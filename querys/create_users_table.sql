CREATE TABLE test.users(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(200),
    birthdate DATE,
    photo VARCHAR(300),
    description TEXT DEFAULT 'Eu estou no AskForMe',
    lastconnection DATETIME,
    token TEXT,
    created_at DATETIME
)
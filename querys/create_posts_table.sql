CREATE TABLE test.posts(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_from INT(11),
    user_to INT(11),
    body TEXT,
    sended_date DATETIME
)
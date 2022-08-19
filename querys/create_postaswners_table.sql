CREATE TABLE askforme.postaswners(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id int(11) NOT NULL,
    user_from int(11) NOT NULL,
    body TEXT NOT NULL,
    sended_date DATETIME NOT NULL
)
CREATE TABLE askforme.notifications(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_from INT(11) NOT NULL,
    user_to INT(11) NOT NULL,
    body TEXT NOT NULL,
    created_at DATETIME NOT NULL
)
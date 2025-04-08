CREATE TABLE IF NOT EXISTS comments (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT 'User',
    content TEXT,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    image_name VARCHAR(255) NOT NULL DEFAULT 'defphotocomment.png',
    post_id INT NOT NULL,

    FOREIGN KEY (post_id) REFERENCES posts(id),
    PRIMARY KEY (id)
);

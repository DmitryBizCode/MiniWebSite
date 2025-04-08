CREATE TABLE IF NOT EXISTS posts (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    category_id INT,
    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_edited TINYINT(1) DEFAULT 0,
    image_name VARCHAR(255),

    FOREIGN KEY (category_id) REFERENCES categories(id),
    PRIMARY KEY (id)
);

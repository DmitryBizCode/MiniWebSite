CREATE TABLE IF NOT EXISTS categories(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE,

    PRIMARY KEY (id)
);
INSERT INTO categories (name) VALUES
('News'),
('Tech'),
('Education'),
('Food'),
('Animal'),
('Lifestyle'),
('Entertainment'),
('ETC');

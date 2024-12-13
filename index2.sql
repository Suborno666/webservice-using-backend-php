-- AN INTROUCTION TO INDEXES


CREATE DATABASE IF NOT EXISTS `test`;
use `test`;

DROP TABLE IF EXISTS `users`;
-- Create a sample table for users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50),
    email VARCHAR(100),
    registration_date DATE,
    last_login DATETIME
);

-- Insert some sample data
INSERT INTO users (username, email, registration_date, last_login)
VALUES 
    ('Loras_Tyrell', 'tyrellhandoftheking@example.com', '2023-01-15', '2024-02-20 14:30:00'),
    ('Jamie_Lannister', 'cerseilannistersbetterhalf@example.com', '2023-03-22', '2024-03-15 10:45:00')
;
    -- ... more users ...

-- Create an index on the email column
CREATE INDEX idx_email ON users (email);

-- Create a composite index on username and registration_date
CREATE INDEX idx_username_reg_date ON users (username, registration_date);

-- -- Example query that will benefit from the email index
EXPLAIN 
SELECT * FROM users WHERE email = 'tyrellhandoftheking@example.com';

-- -- Example query that will benefit from the composite index
EXPLAIN SELECT * FROM users 
WHERE username LIKE 'john%' AND registration_date > '2023-01-01';

-- -- You can also create a unique index
CREATE UNIQUE INDEX idx_unique_email ON users (email);

-- -- Drop an index if no longer needed
-- DROP INDEX idx_email ON users;
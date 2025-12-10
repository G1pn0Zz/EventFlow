CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    date_start DATE,
    date_end DATE,
    price INT DEFAULT 0,
    status ENUM('active','past') DEFAULT 'active',
    participants INT DEFAULT 0,
    participant_limit INT DEFAULT NULL
);

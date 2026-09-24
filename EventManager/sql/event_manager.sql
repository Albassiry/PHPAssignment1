CREATE DATABASE IF NOT EXISTS event_manager;
USE event_manager;

DROP TABLE IF EXISTS events;

CREATE TABLE events (
    eventId INT NOT NULL AUTO_INCREMENT,
    eventName VARCHAR(100) NOT NULL,
    organizer VARCHAR(100) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR(50) NOT NULL,
    eventDate DATE NOT NULL,
    PRIMARY KEY (eventId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO events (eventName, organizer, emailAddress, phoneNumber, eventDate) VALUES
('Community Technology Workshop', 'Alex Morgan', 'alex@example.com', '555-555-1001', '2026-10-10'),
('Web Development Seminar', 'Jamie Lee', 'jamie@example.com', '555-555-1002', '2026-10-18');

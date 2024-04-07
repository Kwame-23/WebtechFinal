DROP DATABASE IF EXISTS dogmarket;
CREATE DATABASE dogmarket;
USE dogmarket;

CREATE TABLE AvailabilityStatuses (
    StatusID INT PRIMARY KEY,
    StatusName VARCHAR(20)
);

CREATE TABLE Roles(
    role_id INT PRIMARY KEY,
    role_name VARCHAR(20) NOT NULL
);

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role_id INT NOT NULL,
    contact VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE Dogs (
    DogID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    DogName VARCHAR(255),
    Breed VARCHAR(255),
    Price DECIMAL(10, 2),
    Description TEXT,
    StatusID INT,
    ImageURL VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(user_id),
    FOREIGN KEY (StatusID) REFERENCES AvailabilityStatuses(StatusID)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    DogID INT,
    Rating DECIMAL(2, 1), 
    ReviewText TEXT,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(user_id),
    FOREIGN KEY (DogID) REFERENCES Dogs(DogID),
    CHECK (Rating >= 0 AND Rating <= 10) 
);

CREATE TABLE Items (
    ItemID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    ItemName VARCHAR(255),
    Category VARCHAR(255),
    Price DECIMAL(10, 2),
    Description TEXT,
    StatusID INT,
    ImageURL VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES Users(user_id),
    FOREIGN KEY (StatusID) REFERENCES AvailabilityStatuses(StatusID)
);

CREATE TABLE Messages (
    MessageID INT AUTO_INCREMENT PRIMARY KEY,
    SenderID INT,
    ReceiverID INT,
    MessageText TEXT,
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (SenderID) REFERENCES Users(user_id),
    FOREIGN KEY (ReceiverID) REFERENCES Users(user_id)
);

INSERT INTO AvailabilityStatuses (StatusID, StatusName) VALUES
(1, 'Available'),
(2, 'Sold'),
(3, 'Reserved');

INSERT INTO Roles(role_id, role_name) VALUES 
(1, 'Seller'),
(2, 'Buyer');

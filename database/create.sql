DROP DATABASE IF EXISTS REJUVENCE;

CREATE DATABASE REJUVENCE;

USE REJUVENCE;


CREATE TABLE user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email    VARCHAR(100) NOT NULL UNIQUE,
    fullname VARCHAR(50) NOT NULL ,
    hashed_password varchar(100),
    categories varchar(250)
);
ALTER TABLE user AUTO_INCREMENT=1;




CREATE TABLE itineraries (
    id INT NOT NULL ,
    itinerary_name VARCHAR (100) NOT NULL,
    itinerary_id INT NOT NULL,
    CONSTRAINT PK_itineraries PRIMARY KEY (itinerary_id,id),
    CONSTRAINT FK_useritinerary FOREIGN KEY (id)  REFERENCES user(id) 
    ON DELETE CASCADE
);



DELIMITER $$

CREATE TRIGGER insertItineraryKey BEFORE INSERT ON itineraries
FOR EACH ROW BEGIN
    SET NEW.itinerary_id = (
       SELECT IFNULL(MAX(itinerary_id), 0) + 1
       FROM itineraries
    );
END $$

DELIMITER ;


CREATE TABLE itinerary_details(
       itinerary_id INT NOT NULL,
       uuid VARCHAR(100) NOT NULL,
       attraction_name VARCHAR(100) NOT NULL,
       attraction_category VARCHAR(100) NOT NULL,
       itinerary_date DATE NOT NULL,
       START_TIME TIME  NOT NULL,
       END_TIME TIME  NOT NULL,
       CONSTRAINT PK_itineraries PRIMARY KEY (START_TIME,itinerary_id,itinerary_date),
       CONSTRAINT FK_itinerary_details FOREIGN KEY (itinerary_id) REFERENCES itineraries(itinerary_id)
       ON DELETE CASCADE
);

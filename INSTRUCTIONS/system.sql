/*DOCUMENTATION AND THE STRUCTURE OF THE TIME TABLE  MANAGEMENT SYSTEM DATABASE*/

/*Create new user and grant privilages*/
/*CREATE USER 'local_user'@'localhost' IDENTIFIED BY 'knkcsnjbsajns55214654s';
GRANT ALL PRIVILEGES ON unidb.* TO 'local_user'@'localhost'; 

----NO NEED-------
--------------------------------------------------------------
*/

CREATE TABLE schedule (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Day VARCHAR(10),
    Time VARCHAR(15),
    Year_of_study INT,
    Course VARCHAR(50),
    Semester VARCHAR(20),
    Subject VARCHAR(100),
    Venue VARCHAR(100)
);

CREATE TABLE user (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);


ALTER TABLE user
ADD COLUMN Name VARCHAR(100) NOT NULL;


CREATE TABLE userloginfo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50),
    Name VARCHAR(100),
    time VARCHAR(20),
    date VARCHAR(20),
    ipaddress VARCHAR(50)
);

/*ALTER TABLE userloginfo
MODIFY COLUMN macaddress VARCHAR(255);


ALTER TABLE userloginfo DROP COLUMN macaddress;*/








CREATE TABLE admin(
    A_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    password VARCHAR(20)
);
INSERT INTO admin VALUES (100,'admin','admin');

CREATE TABLE student(
    S_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    USN VARCHAR(20) UNIQUE,
    name VARCHAR(20),
    age VARCHAR(20),
    gender VARCHAR(20),
    address VARCHAR(100),
    phone VARCHAR(10),
    password VARCHAR(20)
);
INSERT INTO student VALUES (200,'4SF19IS021','Chirag','20','Male',
    'BC Road','9765447528','chirag');

CREATE TABLE room(
    R_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    room_no INT NOT NULL UNIQUE,
    price VARCHAR(20),
    block_no INT,
    status VARCHAR(20),
    S_id INT,
    FOREIGN KEY (S_id) REFERENCES student(S_id) ON DELETE CASCADE
    
);
INSERT INTO room VALUES (300,22,'30000',7,'Sold',NULL);



CREATE TABLE transaction(
    T_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    paid VARCHAR(20),
    remain VARCHAR(20),
    S_id INT NOT NULL,
    FOREIGN KEY (S_id) REFERENCES room(S_id) ON DELETE CASCADE
);


CREATE TABLE feedback(
    F_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    feedback VARCHAR(100),
    date DATE,
    S_id INT NOT NULL,
    FOREIGN KEY (S_id) REFERENCES student(S_id) ON DELETE CASCADE
);
INSERT INTO feedback VALUES (600,'Room is Good',200);
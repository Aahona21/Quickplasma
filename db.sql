CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    mob VARCHAR(10) NOT NULL,
    location VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    referral VARCHAR(10)
    
);

CREATE TABLE blood_bank (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Blood_Bank_id VARCHAR(255) NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Email VARCHAR(255),
    Address VARCHAR(255),
    Contact_No VARCHAR(10) NOT NULL,
    SMCOM_Approved ENUM('Yes', 'No') NOT NULL,
    Vehicle_Available ENUM('Yes', 'No') NOT NULL,
    Password VARCHAR(255) NOT NULL,
    BMC_Certificate VARCHAR(255) NOT NULL
    
);

CREATE TABLE hospitals (
    Hospital_id INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Address VARCHAR(255) NOT NULL,
    Incharge_Name VARCHAR(100) NOT NULL,
    Incharge_Contact VARCHAR(15) NOT NULL,
    Nationality_of_incharge VARCHAR(50) NOT NULL,
    No_of_beds INT NOT NULL,
    No_of_wards INT NOT NULL,
    ICU_Units INT NOT NULL,
    Approved_by_SMCOM ENUM('Yes', 'No') NOT NULL,
    Password VARCHAR(255) NOT NULL
);

CREATE TABLE donors(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    donations INT DEFAULT 1
);

CREATE TABLE donations (
    donor_id INT NOT NULL,
    donation_date DATE NOT NULL,
    PRIMARY KEY (donor_id, donation_date)
);

CREATE TABLE recipients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);




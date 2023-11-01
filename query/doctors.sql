use dental_clinic;
CREATE TABLE doctors (
    doctor_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(127) NOT NULL,
    phone_number VARCHAR(8) NOT NULL
);




use dental_clinic;
CREATE TABLE appointments (
    app_id INT AUTO_INCREMENT PRIMARY KEY,
    app_date DATE NOT NULL,
    app_time TIME NOT NULL,
    doctor_name VARCHAR(50) NOT NULL,
    patientID INT NOT NULL,
    patient_name VARCHAR(50) NOT NULL,
    note VARCHAR(255),
    registered_datetime DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patientID) REFERENCES patients(patient_id)
);




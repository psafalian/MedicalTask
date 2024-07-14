CREATE TABLE patient (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         name VARCHAR(255) NOT NULL,
                         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         deleted_at TIMESTAMP NULL
);

CREATE TABLE doctor (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        deleted_at TIMESTAMP NULL
);

CREATE TABLE medication (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(255) NOT NULL,
                            dose VARCHAR(255) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            deleted_at TIMESTAMP NULL
);

CREATE TABLE patient_medication (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    patient_id INT,
                                    doctor_id INT,
                                    medication_id INT,
                                    quantity INT,
                                    frequency VARCHAR(255),
                                    start_date DATE,
                                    end_date DATE,
                                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                    deleted_at TIMESTAMP NULL,
                                    FOREIGN KEY (patient_id) REFERENCES patient(id),
                                    FOREIGN KEY (doctor_id) REFERENCES doctor(id),
                                    FOREIGN KEY (medication_id) REFERENCES medication(id)
);

-- Insert dummy data
INSERT INTO patient (name) VALUES ('Peto Sefilian'), ('Will Smith');
INSERT INTO doctor (name) VALUES ('Dr. Watson'), ('Dr. Parker');
INSERT INTO medication (name, dose) VALUES ('Panadol', '1000mg'), ('Tylenol', '500mg');

-- Insert dummy patient_medication data
INSERT INTO patient_medication (patient_id, doctor_id, medication_id, quantity, frequency, start_date, end_date)
VALUES
    (1, 1, 1, 500, 'Once a week', '2024-05-01', '2024-05-30'),
    (2, 2, 2, 120, 'Twice a day', '2023-06-01', '2024-06-01');

-- Create indexes
CREATE INDEX idx_patient_name ON patient(name);
CREATE INDEX idx_doctor_name ON doctor(name);
CREATE INDEX idx_medication_name ON medication(name);
CREATE INDEX idx_patient_medication_patient_id ON patient_medication(patient_id);
CREATE INDEX idx_patient_medication_doctor_id ON patient_medication(doctor_id);
CREATE INDEX idx_patient_medication_medication_id ON patient_medication(medication_id);

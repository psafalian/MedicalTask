<?php
    class PrescriptionDatabase extends Database
    {
        public function getPatientsByMedication($medicationId)
        {
            $sql = "SELECT p.* FROM patient p
                JOIN patient_medication pm ON p.id = pm.patient_id
                WHERE pm.medication_id = :medicationId";
            return $this->select($sql, ['medicationId' => $medicationId]);
        }

        public function getPatientsAndPrescriptionCountForCurrentYear()
        {
            $sql = "SELECT p.name, COUNT(pm.id) as prescription_count FROM patient p
                JOIN patient_medication pm ON p.id = pm.patient_id
                WHERE YEAR(pm.start_date) = YEAR(CURRENT_DATE)
                GROUP BY p.id
                ORDER BY prescription_count DESC";
            return $this->select($sql);
        }

        public function getMedicationsByPatient($patientId)
        {
            $sql = "SELECT p.name as patient_name, d.name as doctor_name, m.name as medication_name, pm.*
                FROM patient_medication pm
                JOIN patient p ON pm.patient_id = p.id
                JOIN doctor d ON pm.doctor_id = d.id
                JOIN medication m ON pm.medication_id = m.id
                WHERE pm.patient_id = :patientId";
            return $this->select($sql, ['patientId' => $patientId]);
        }

        public function getPatientsWithMultipleMedications()
        {
            $sql = "SELECT p.name, COUNT(DISTINCT pm.medication_id) as medication_count
                FROM patient p
                JOIN patient_medication pm ON p.id = pm.patient_id
                WHERE YEAR(pm.start_date) IN (YEAR(CURRENT_DATE), YEAR(CURRENT_DATE) - 1)
                GROUP BY p.id
                HAVING medication_count > 1";
            return $this->select($sql);
        }
    }

# Database
DROP DATABASE IF EXISTS hospital;
CREATE DATABASE IF NOT EXISTS hospital;
USE hospital;
--
# DROP TABLES
--
DROP TABLE IF EXISTS communication;
DROP TABLE IF EXISTS clinic;
DROP TABLE IF EXISTS room;
DROP TABLE IF EXISTS patient;
DROP TABLE IF EXISTS doctor;
DROP TABLE IF EXISTS specialty;
DROP TABLE IF EXISTS provider;
DROP TABLE IF EXISTS medicine;
DROP TABLE IF EXISTS illness;

DROP TABLE IF EXISTS doctorRelatesToSpecialty;
DROP TABLE IF EXISTS patientRelatesToDoctor;
DROP TABLE IF EXISTS doctorRelatesToMedicine;
DROP TABLE IF EXISTS patientRelatesToIllness;
DROP TABLE IF EXISTS patientRelatesToMedicine;

--
# CREATE TABLES
--
CREATE TABLE IF NOT EXISTS communication ( 
	communicationId CHAR(7) PRIMARY KEY,
    phoneNumber1 CHAR(10),
    phoneNumber2 CHAR(10),
    email VARCHAR(320),
    fax CHAR(10)
);

CREATE TABLE IF NOT EXISTS clinic (
	clinicName VARCHAR(30) PRIMARY KEY,
    areaSize FLOAT NOT NULL, 
    manager VARCHAR(50) NOT NULL, 
    communicationId CHAR(7) UNIQUE, 
    CONSTRAINT cl_fk1 FOREIGN KEY(communicationId) REFERENCES communication(communicationId) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS room (
	roomName VARCHAR(30) PRIMARY KEY, 
    equipment TEXT, 
    availability BOOL NOT NULL, 
    clinicName VARCHAR(30) NOT NULL, 
    CONSTRAINT ro_fk1 FOREIGN KEY(clinicName) REFERENCES clinic(clinicName) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS patient (
	patientId CHAR(7) PRIMARY KEY,
	lastName VARCHAR(30) NOT NULL,
	firstName VARCHAR(20) NOT NULL,
	dateOfBirth DATE NOT NULL,
	availability BOOL NOT NULL,
    communicationId CHAR(7) UNIQUE,
    roomName VARCHAR(30),
    CONSTRAINT pCom_fk FOREIGN KEY(communicationId) REFERENCES communication(communicationId) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT p_fk FOREIGN KEY(roomName) REFERENCES room(roomName) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS doctor (
	AM CHAR(5) PRIMARY KEY,
    lastName VARCHAR(30) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    availability BOOL NOT NULL,
    communicationId CHAR(7) UNIQUE,
    CONSTRAINT dCom_fk FOREIGN KEY(communicationId) REFERENCES communication(communicationId) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS specialty (
	specialtyName VARCHAR(30) PRIMARY KEY,
    specialtyDescription TEXT,
    education TEXT
);

CREATE TABLE IF NOT EXISTS provider (
	AFM CHAR(10) PRIMARY KEY,
    fullName VARCHAR(50),
	city VARCHAR(30),
    street VARCHAR(30),
    streetNumber VARCHAR(3),
    postCode CHAR(5)
);

CREATE TABLE IF NOT EXISTS medicine (
	medicineName VARCHAR(30) PRIMARY KEY,
	medicineDescription TEXT,
	strength DECIMAL(2),
	providerAFM CHAR(10),
	CONSTRAINT pr_fk FOREIGN KEY (providerAFM) REFERENCES provider(AFM) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS illness (
	illnessName VARCHAR(30) PRIMARY KEY,
	symptoms TEXT,
	treatable BOOL NOT NULL
);

--
# N-M Tables:
--
CREATE TABLE IF NOT EXISTS doctorRelatesToSpecialty (
    doctorId CHAR(5),
    specialtyName VARCHAR(30),
    dateOfService DATE NOT NULL,
    PRIMARY KEY(doctorId, specialtyName),
    CONSTRAINT drtsD_fk FOREIGN KEY(doctorId) REFERENCES doctor(AM) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT drtsS_fk FOREIGN KEY(specialtyName) REFERENCES specialty(specialtyName) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS patientRelatesToDoctor (
	patientId CHAR(7),
    doctorId CHAR(5),
    dateOfSupervision DATE NOT NULL,
    PRIMARY KEY(patientId, doctorId),
    CONSTRAINT prtdP_fk FOREIGN KEY(patientId) REFERENCES patient(patientId) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT prtdD_fk FOREIGN KEY(doctorId) REFERENCES doctor(AM) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS doctorRelatesToMedicine (
	doctorId CHAR(5),
    medicineName VARCHAR(30),
    PRIMARY KEY(doctorId, medicineName),
    CONSTRAINT drtmD_fk FOREIGN KEY(doctorId) REFERENCES doctor(AM) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT drtmM_fk FOREIGN KEY(medicineName) REFERENCES medicine(medicineName) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS patientRelatesToIllness (
	patientId CHAR(7),
    illnessName VARCHAR(30),
    dateOfIllness DATE NOT NULL,
    PRIMARY KEY(patientId, illnessName),
    CONSTRAINT prtiP_fk FOREIGN KEY(patientId) REFERENCES patient(patientId) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT prtiI_fk FOREIGN KEY(illnessName) REFERENCES illness(illnessName) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS patientRelatesToMedicine (
	patientId CHAR(7),
    medicineName VARCHAR(30),
    dose DECIMAL(2) NOT NULL,
    dateOfMedicine DATE NOT NULL,
    PRIMARY KEY(patientId, medicineName),
    CONSTRAINT prtmP_fk FOREIGN KEY(patientId) REFERENCES patient(patientId) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT prtmM_fk FOREIGN KEY(medicineName) REFERENCES medicine(medicineName) ON UPDATE CASCADE ON DELETE CASCADE
);

--
# INSERTS:
--
# Insert into "communication" table
INSERT INTO communication (communicationId, phoneNumber1, phoneNumber2, email, fax) VALUES
	
    ("1000001", "6954321098", "2510997654", "geopap@gmail.com", "2019876543"), 
    ("1000002", "6976543210", "2510123456", "markar@yahoo.com", "2021234567"), 
    ("1000003", "6901234567", "2510789012", "john.levedovich@hotmail.com", "2054567890"), 
    ("1000004", "6945678901", "2510567890", "alex.papandreou@yahoo.com", "2022233445"), 
    ("1000005", "6945678901", "2510345678", "mark.black@outlook.com", "2032345678"), 
	("1000006", "6987654321", "2510789012", "mary.niko@gmail.com", "2033344556"), 
	("1000007", "6987654321", "2510567890", "p.eleuthiou@gmail.com", "2043456789"), 
    ("1000008", "6978123456", "2510901234", "helen.mitsop@gmail.com", "2011122334"), 
	("1000009", "6978123456", "2510901234", "dimitra.antoniou@gmail.com", "2055566778"), 
	("1000010", "6901234567", "2510901234", "george.xenakis@hotmail.com", "2044455667"), 
    
    ("2000001", "6945123456", "2510234567", "nicnik@hospital.gr", "2011456789"), 
    ("2000002", "6976234567", "2510345678", "geogeo@hospital.gr", "2022567890"), 
    ("2000003", "6957345678", "2510456789", "chrichr@hospital.gr", "2033678901"), 
    ("2000004", "6938456789", "2510567890", "hellot@hospital.gr", "2044789012"), 
    ("2000005", "6989567890", "2510678901", "sofkou@hospital.gr", "2055890123"), 
    
    ("3000001", "6954321098", "2510997654", "cardiac.center@hospital.gr", "2019876543"), 
    ("3000002", "6976543210", "2510123456", "dermatology.clinic@hospital.gr", "2021234567"), 
    ("3000003", "6945678901", "2510345678", "neurology.brain@hospital.gr", "2032345678"), 
    ("3000004", "6987654321", "2510567890", "orthopedic.institute@hospital.gr", "2043456789"), 
    ("3000005", "6998765432", "2510123456", "pediatric.center@hospital.gr", "2510654321");
    
    
    
# Insert into "clinic" table
INSERT INTO clinic (clinicName, areaSize, manager, communicationId) VALUES

	("Cardiac Wellness Center", 89.30, "Panagiotis-Konstantinos Papalas", "3000001"), 

    ("Dermatology Skin Health Clinic", 34.25, "George Ntolias", "3000002"), 

    ("Neurology Brain Health Clinic", 22.50, "Aggelos Panini", "3000003"), 

    ("Orthopedic Care Institute", 100.00, "Nick Arabidis", "3000004"), 

    ("Pediatric Care Center", 45.75, "Eleni Papadopoulou", "3000005");
    
# Insert into "room" table
INSERT INTO room (roomName, equipment, availability, clinicName) VALUES

    ("Cardiac Surgery Room 1", "Advanced Surgical Instruments", TRUE, "Cardiac Wellness Center"), 
	("Cardiac Surgery Room 2", "Operating Knife", FALSE, "Cardiac Wellness Center"), 

    ("Skin Care Room 1", "Nail Stove", FALSE, "Dermatology Skin Health Clinic"), 

    ("Tumor Surgery Room 1", "Brain Scanner", TRUE, "Neurology Brain Health Clinic"), 

    ("Orthopedic Check-Up Room 1", "X-ray machine", FALSE, "Orthopedic Care Institute"), 

    ("Pediatric Surgery Room 1", "Child-Friendly Tools", TRUE, "Pediatric Care Center"), 
    ("Playroom 1", "Toys and Games", TRUE, "Pediatric Care Center");

# Insert into "patient" table
INSERT INTO patient (patientId, lastName, firstName, dateOfBirth, availability, communicationId, roomName) VALUES

	("1234567", "Papadopoulos", "George", "1997-08-09", FALSE, "1000001", "Cardiac Surgery Room 1"), 
    ("2348928", "Karkalidou", "Mary", "1999-06-25", TRUE, "1000002", "Cardiac Surgery Room 2"), 
	("5937592", "Levedovich", "John", "2002-10-26", TRUE, "1000003", "Cardiac Surgery Room 2"),
    ("7890123", "Papandreou", "Alexandros", "2000-11-30", FALSE, "1000004", "Cardiac Surgery Room 2"),

    ("9584833", "Eleuthiou", "Penelope", "2002-12-31", FALSE, "1000007", "Skin Care Room 1"), 

    ("4832984", "Black", "Mark", "1961-10-10", TRUE, "1000005", "Tumor Surgery Room 1"), 
	("8901234", "Nikolopoulou", "Maria", "1950-04-03", TRUE, "1000006", "Tumor Surgery Room 1"),

    ("6789012", "Mitsopoulou", "Helen", "1995-06-18", TRUE, "1000008", "Orthopedic Check-Up Room 1"),

    ("0123456", "Antoniou", "Dimitra", "2013-01-15", TRUE, "1000009", "Playroom 1"), 
    ("9012345", "Xenakis", "George", "2007-08-22", FALSE, "1000010", "Pediatric Surgery Room 1");

# Insert into "doctor" table
INSERT INTO doctor (AM, lastName, firstName, availability, communicationId) VALUES

	("98765", "Nikolahdhs", "Nick", FALSE, "2000001"),

    ("98766", "Georgiadhs", "George", FALSE, "2000002"),

    ("98767", "Sotiriou", "Helen", TRUE, "2000004"), 

    ("98768", "Panagiotou", "Chris", TRUE, "2000003"), 

    ("98769", "Koutsoukou", "Sofia", FALSE, "2000005");

# Insert into "specialty" table
INSERT INTO specialty (specialtyName, specialtyDescription, education) VALUES

	("Cardiologist", "Specializing in heart health.", "Medical degree, Residency in Internal Medicine, Fellowship in Cardiology"), 

    ("Dermatologist", "Specializing in skin care.", "Medical degree, Residency in Dermatology"), 

    ("Neurologist", "Specializing in brain health and neurology.", "Medical degree, Residency in Neurology"), 

    ("Orthopedic", "Specializing in orthopedic surgery and musculoskeletal health.", "Medical degree, Residency in Orthopedic Surgery"), 

    ("Pediatrician", "Specializing in child health.", "Medical degree, Residency in Pediatrics");

# Insert into "provider" table
INSERT INTO provider (AFM, fullName, city, street, streetNumber, postCode) VALUES
	("0983876253", "HealthCare Solutions", "Athens", "Hippocrates Street", "24", "11527"),
    ("0987654321", "MediCare Services", "Thessaloniki", "Aristotle Street", "105", "54639"),
    ("0987612345", "Wellness Clinic", "Heraklion", "Asklepios Street", "1", "71409"),
	("0987654322", "Illness Cure", "Thessaloniki", "Omonias Street", "2", "54639"),
    ("0987612346", "Curable", "Rhodes", "Eleutheriou Street", "42", "64106");

# Insert into "medicine" table
INSERT INTO medicine (medicineName, medicineDescription, strength, providerAFM) VALUES

	("AspQuick", "Pain reliever and anti-inflammatory drug", 5, "0983876253"), 

    ("DoxyOral", "Oral antibiotic", 15, "0987612345"), 

    ("SumatripPLUS", "Serotonin receptor agonist", 37, "0987654321"), 

    ("ArthroCare", "Provides relief from arthritis pain and inflammation", 8, "0983876253"), 

    ("Algofren", "Relieves cough symptoms and pain", 3, "0987612345");

# Insert into "illness" table
INSERT INTO illness (illnessName, symptoms, treatable) VALUES

	("Coronary Artery Disease", "Chest pain, shortness of breath", TRUE), 

	("Acne", "Pimples, blackheads, whiteheads", TRUE), 

    ("Alzheimer's Disease", "Memory loss, cognitive decline", FALSE), 

    ("Tendinitis", "Pain and inflammation in tendons", TRUE),

	("Throat Pain", "Discomfort, coughing, shortness of breath", TRUE);

--
#INSERTS N-M:
--
    
# Insert into doctorRelatesToSpecialty table
INSERT INTO doctorRelatesToSpecialty (doctorId, specialtyName, dateOfService) VALUES
	("98765", "Cardiologist", "2000-01-15"), 
    ("98766", "Dermatologist", "2021-03-04"), 
    ("98767", "Neurologist", "2008-09-29"), 
    ("98768", "Orthopedic", "2011-11-13"), 
    ("98769", "Pediatrician", "2013-12-17"),
    ("98765", "Pediatrician", "2022-11-18"),
    ("98769", "Orthopedic", "2023-05-26");

# Insert into "patientRelatesToDoctor" table
INSERT INTO patientRelatesToDoctor (patientId, doctorId, dateOfSupervision) VALUES
	("1234567", "98765", "2023-11-13"), 
	("2348928", "98767", "2023-09-13"), 

	("5937592", "98767", "2023-10-25"), 
    ("5937592", "98768", "2023-10-25"), 
	("7890123", "98767", "2023-10-25"), 
	("9584833", "98766", "2023-08-10"), 

	("4832984", "98769", "2023-07-01"), 
	("8901234", "98769", "2023-07-01"), 
	("0123456", "98769", "2023-12-05"), 
	("6789012", "98768", "2023-12-05"), 
	("9012345", "98769", "2023-12-05");


# Insert into "doctorRelatesToMedicine" table
INSERT INTO doctorRelatesToMedicine (doctorId, medicineName) VALUES

	("98765", "AspQuick"), 
    ("98765", "Algofren"),

    ("98766", "DoxyOral"), 

    ("98767", "SumatripPLUS"), 

    ("98768", "ArthroCare"), 

    ("98769", "Algofren"),
    ("98769", "ArthroCare");
    
# Insert into "patientRelatesToIllness" table
INSERT INTO patientRelatesToIllness (patientId, illnessName, dateOfIllness) VALUES

	("1234567", "Coronary Artery Disease", "2023-11-13"), 
    ("2348928", "Coronary Artery Disease", "2023-09-13"), 
    ("5937592", "Coronary Artery Disease", "2023-10-25"), 
    ("7890123", "Coronary Artery Disease", "2023-10-25"), 

    ("9584833", "Acne", "2023-08-10"), 
    ("0123456", "Acne", "2023-12-05"), 
    
    ("4832984", "Alzheimer's Disease", "2023-07-01"), 
    ("8901234", "Alzheimer's Disease", "2023-07-01"), 
  
    ("6789012", "Tendinitis", "2023-12-05"), 

    ("0123456", "Throat Pain", "2023-12-04"), 
    ("9012345", "Throat Pain", "2023-12-05");

# Insert into "patientRelatesToMedicine" table
INSERT INTO patientRelatesToMedicine (patientId, medicineName, dose, dateOfMedicine) VALUES

    ("5937592", "AspQuick", 5, "2023-10-25"),
    ("2348928", "AspQuick", 2, "2023-09-13"),
	("7890123", "AspQuick", 3, "2023-10-25"), 

    ("9584833", "DoxyOral", 1, "2023-08-10"), 
	("0123456", "DoxyOral", 2, "2023-12-05"), 

    ("4832984", "SumatripPLUS", 1, "2023-07-01"), 
    ("8901234", "SumatripPLUS", 2, "2023-07-01"), 

    ("6789012", "ArthroCare", 2, "2023-12-05"), 

    ("0123456", "Algofren", 1, "2023-12-04"),
	("9012345", "Algofren", 3, "2023-12-05");
    
--
# DESCRIBES
--
DESCRIBE communication;
DESCRIBE clinic;
DESCRIBE room;
DESCRIBE patient;
DESCRIBE doctor;
DESCRIBE specialty;
DESCRIBE provider;
DESCRIBE medicine;
DESCRIBE illness;

DESCRIBE doctorRelatesToSpecialty;
DESCRIBE patientRelatesToDoctor;
DESCRIBE doctorRelatesToMedicine;
DESCRIBE patientRelatesToIllness;
DESCRIBE patientRelatesToMedicine;

--
# SELECTS
--
SELECT * FROM communication;
SELECT * FROM clinic;
SELECT * FROM room;
SELECT * FROM patient;
SELECT * FROM doctor;
SELECT * FROM specialty;
SELECT * FROM provider;
SELECT * FROM medicine;
SELECT * FROM illness;

SELECT * FROM doctorRelatesToSpecialty;
SELECT * FROM patientRelatesToDoctor;
SELECT * FROM doctorRelatesToMedicine;
SELECT * FROM patientRelatesToIllness;
SELECT * FROM patientRelatesToMedicine;

--
# Advanced SELECTS
--
SELECT * 
FROM communication, doctor
WHERE doctor.communicationId = communication.communicationId;

SELECT *
FROM patientRelatesToDoctor
WHERE patientRelatesToDoctor.patientId = "1234567";

SELECT * 
FROM doctor
WHERE doctor.AM IN (SELECT doctorId 
					FROM patientRelatesToDoctor
					WHERE patientRelatesToDoctor.patientId = "1234567");

SELECT lastName 
FROM patient
WHERE firstName OR lastName LIKE "%is";

SELECT firstName, medicineName, dose
FROM patient
INNER JOIN patientRelatesToMedicine WHERE patientRelatesToMedicine.patientId = patient.patientId;

SELECT firstName FROM patient WHERE patient.roomName = ("Cardiac Surgery Room 1");

SELECT firstName, lastName
FROM doctor
WHERE doctor.communicationId BETWEEN "2000001" AND "2000009" ORDER BY firstName ASC LIMIT 3;

SELECT DISTINCT room.roomName
FROM room, patient
WHERE patient.roomName = room.roomName;

--
# SELECTS 2nd Part
--

#4a
SELECT lastName 
FROM patient
WHERE lastName LIKE "%is";

#4b
SELECT firstName, lastName, roomName
FROM patient
WHERE roomName = "Cardiac Surgery Room 2"
ORDER BY lastName;

#4c
SELECT firstName, lastName, dateOfBirth
FROM patient
WHERE dateOfBirth BETWEEN "1990-01-01" AND "2000-01-01";
SELECT firstName, lastName
FROM patient
WHERE firstName = "Maria" OR firstName = "Mary";

#5
# Select AM, firstName, lastName and Count the patients of each doctor
SELECT AM, firstName, lastName, COUNT(*) AS "Number Of Patients"
FROM patientRelatesToDoctor, doctor
WHERE AM = doctorId AND AM IN (SELECT doctorId FROM patientRelatesToDoctor)
GROUP BY AM;

# Select patientId, firstName, lastName, dateOfBirth of the youngest patient
SELECT patientId, firstName, lastName, dateOfBirth
FROM patient
WHERE dateOfBirth = (SELECT MAX(dateOfBirth) FROM patient);

# Select patientId, firstName, lastName, dateOfBirth of the oldest patient
SELECT patientId, firstName, lastName, dateOfBirth
FROM patient
WHERE dateOfBirth = (SELECT MIN(dateOfBirth) FROM patient);

#6
#INNER JOIN
SELECT patient.patientId, firstName, lastName, illnessName, dateOfIllness
FROM patient
INNER JOIN patientRelatesToIllness ON patientRelatesToIllness.patientId = patient.patientId;
#LEFT JOIN
SELECT medicineName, AFM, fullName
FROM provider
LEFT JOIN medicine ON provider.AFM = medicine.providerAFM;

#7 
#CREAT VIEW
CREATE VIEW patientRoomClinic AS (SELECT patientId, firstName, lastName, room.roomName, clinic.clinicName
FROM patient, room, clinic
WHERE patient.roomName = room.roomName AND room.clinicName = clinic.clinicName);
SELECT * FROM patientRoomClinic;

#8
#PROCEDURE
DELIMITER //
CREATE PROCEDURE InsertCommunication(
    IN c_communicationId INT,
    IN c_phoneNumber1 VARCHAR(255),
    IN c_phoneNumber2 VARCHAR(255),
    IN c_email VARCHAR(255),
    IN c_fax VARCHAR(255)
)
BEGIN

    INSERT INTO communication (communicationId, phoneNumber1, phoneNumber2, email, fax)
    VALUES (c_communicationId, c_phoneNumber1, c_phoneNumber2, c_email, c_fax);

END //
DELIMITER ;

CALL InsertCommunication(
	"1000011", "6901234568", "2510901235", "nick@hotmail.com", "2044455668"
);
SELECT * FROM communication;



#9 TRIGGER
DELIMITER //
CREATE TRIGGER equipmentDefault BEFORE INSERT 
ON room FOR EACH ROW
BEGIN
    IF NEW.equipment IS NULL OR NEW.equipment = "" THEN
        SET NEW.equipment = "No equipment";
    END IF;
END;//
DELIMITER ;

INSERT INTO room (roomName, equipment, availability, clinicName) VALUES (
	"Test Room", NULL, TRUE, "Cardiac Wellness Center"
);

SELECT * FROM room WHERE equipment = "No equipment";

DELIMITER //
CREATE TRIGGER formalNames BEFORE INSERT 
ON patient FOR EACH ROW
BEGIN
    IF NEW.firstName = "Nik" OR NEW.firstName = "Nick" THEN
        SET NEW.firstName = "Nicolas";
	ELSEIF NEW.firstName = "Panos" THEN
		SET NEW.firstName = "Panagiotis";
	ELSEIF NEW.firstName = "Giorgos" THEN
		SET NEW.firstName = "George";
    END IF;
END;//
DELIMITER ;

INSERT INTO communication (communicationId, phoneNumber1, phoneNumber2, email, fax) VALUES (
	"1000012", "6955852078", NULL, "nikpapadop@gmail.com", NULL
);
INSERT INTO patient (patientId, lastName, firstName, dateOfBirth, availability, communicationId, roomName) VALUES (
	"9018348", "Papadop", "Nik", "2002-10-12", TRUE, "1000012", "Test Room"
);

SELECT * FROM patient WHERE firstName = "Nicolas";
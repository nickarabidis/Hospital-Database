<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'formType' is set in the $_POST array
    if (isset($_POST['formType'])) {
        $formType = $_POST['formType'];
        switch ($formType) {
            case 'clinic':
                // Handle clinic form submission
                // Check if 'clinicName' is set and not empty
                if (isset($_POST['clinicName']) && $_POST['clinicName'] != '') {

                    // Retrieve 'clinicName' value
                    $clinicName = $_POST['clinicName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['areaSize']) &&
                        isset($_POST['manager']) &&
                        isset($_POST['communicationId'])
                    ) {
                        // Retrieve values for other columns
                        $areaSize = $_POST['areaSize'];
                        $manager = $_POST['manager'];
                        $communicationId = $_POST['communicationId'];

                        $selectKey = mysqli_query($conn, "SELECT clinicName FROM clinic WHERE clinicName = '$clinicName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE clinic SET areaSize = ?, manager = ?, communicationId = ? WHERE clinicName = ?");

                            // Bind parameters
                            $stmt->bind_param("ssss", $areaSize, $manager, $communicationId, $clinicName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Clinic updated successfully.';
                            } else {
                                echo 'Error: Unable to update Clinic.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO clinic (clinicName, areaSize, manager, communicationId) VALUES (?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssss", $clinicName, $areaSize, $manager, $communicationId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Clinic inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Clinic.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Clinic name is required
                    echo 'Error: Clinic name is required.';
                }
                break;
            case 'room':

                // Check if 'roomName' is set and not empty
                if (isset($_POST['roomName']) && $_POST['roomName'] != '') {

                    // Retrieve 'roomName' value
                    $roomName = $_POST['roomName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['equipment']) &&
                        isset($_POST['availability']) &&
                        isset($_POST['clinicName'])
                    ) {
                        // Retrieve values for other columns
                        $equipment = $_POST['equipment'];
                        $availability = $_POST['availability'];
                        $clinicName = $_POST['clinicName'];

                        $selectKey = mysqli_query($conn, "SELECT roomName FROM room WHERE roomName = '$roomName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE room SET equipment = ?, availability = ?, clinicName = ? WHERE roomName = ?");

                            // Bind parameters
                            $stmt->bind_param("ssss", $equipment, $availability, $clinicName, $roomName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Room updated successfully.';
                            } else {
                                echo 'Error: Unable to update Room.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO room (roomName, equipment, availability, clinicName) VALUES (?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssss", $roomName, $equipment, $availability, $clinicName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Room inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Room.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Room name is required
                    echo 'Error: Room name is required.';
                }
                break;

            case 'doctor':

                // Check if 'AM' is set and not empty
                if (isset($_POST['AM']) && $_POST['AM'] != '') {

                    // Retrieve 'AM' value
                    $AM = $_POST['AM'];

                    // Check if other required values are set
                    if (
                        isset($_POST['lastName']) &&
                        isset($_POST['firstName']) &&
                        isset($_POST['availability']) &&
                        isset($_POST['communicationId'])
                    ) {
                        // Retrieve values for other columns
                        $lastName = $_POST['lastName'];
                        $firstName = $_POST['firstName'];
                        $availability = $_POST['availability'];
                        $communicationId = $_POST['communicationId'];

                        $selectKey = mysqli_query($conn, "SELECT AM FROM doctor WHERE AM = '$AM'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE doctor SET lastName = ?, firstName = ?, availability = ?, communicationId = ? WHERE AM = ?");

                            // Bind parameters
                            $stmt->bind_param("sssss", $lastName, $firstName, $availability, $communicationId, $AM);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Doctor updated successfully.';
                            } else {
                                echo 'Error: Unable to update Doctor.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO doctor (AM, lastName, firstName, availability, communicationId) VALUES (?, ?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sssss", $AM, $lastName, $firstName, $availability, $communicationId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Doctor inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Doctor.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Doctor AM is required
                    echo 'Error: Doctor AM is required.';
                }
                break;

            case 'specialty':

                // Check if 'specialtyName' is set and not empty
                if (isset($_POST['specialtyName']) && $_POST['specialtyName'] != '') {

                    // Retrieve 'specialtyName' value
                    $specialtyName = $_POST['specialtyName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['yearsOfService']) &&
                        isset($_POST['specialtyDescription'])
                    ) {
                        // Retrieve values for other columns
                        $yearsOfService = $_POST['yearsOfService'];
                        $specialtyDescription = $_POST['specialtyDescription'];

                        $selectKey = mysqli_query($conn, "SELECT specialtyName FROM specialty WHERE specialtyName = '$specialtyName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE specialty SET yearsOfService = ?, specialtyDescription = ? WHERE specialtyName = ?");

                            // Bind parameters
                            $stmt->bind_param("sss", $yearsOfService, $specialtyDescription, $specialtyName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Specialty updated successfully.';
                            } else {
                                echo 'Error: Unable to update Specialty.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO specialty (specialtyName, yearsOfService, specialtyDescription) VALUES (?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sss", $specialtyName, $yearsOfService, $specialtyDescription);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Specialty inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Specialty.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Specialty name is required
                    echo 'Error: Specialty name is required.';
                }
                break;

            case 'patient':

                // Check if 'patientId' is set and not empty
                if (isset($_POST['patientId']) && $_POST['patientId'] != '') {

                    // Retrieve 'patientId' value
                    $patientId = $_POST['patientId'];

                    // Check if other required values are set
                    if (
                        isset($_POST['lastName']) &&
                        isset($_POST['firstName']) &&
                        isset($_POST['dateOfBirth']) &&
                        isset($_POST['availability']) &&
                        isset($_POST['communicationId'])
                    ) {
                        // Retrieve values for other columns
                        $lastName = $_POST['lastName'];
                        $firstName = $_POST['firstName'];
                        $dateOfBirth = $_POST['dateOfBirth'];
                        $availability = $_POST['availability'];
                        $communicationId = $_POST['communicationId'];

                        $selectKey = mysqli_query($conn, "SELECT patientId FROM patient WHERE patientId = '$patientId'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE patient SET lastName = ?, firstName = ?, dateOfBirth = ?, availability = ?, communicationId = ? WHERE patientId = ?");

                            // Bind parameters
                            $stmt->bind_param("ssssss", $lastName, $firstName, $dateOfBirth, $availability, $communicationId, $patientId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient updated successfully.';
                            } else {
                                echo 'Error: Unable to update Patient.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO patient (patientId, lastName, firstName, dateOfBirth, availability, communicationId) VALUES (?, ?, ?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssssss", $patientId, $lastName, $firstName, $dateOfBirth, $availability, $communicationId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Patient.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Patient Id is required
                    echo 'Error: Patient Id is required.';
                }
                break;

            case 'illness':

                // Check if 'illnessName' is set and not empty
                if (isset($_POST['illnessName']) && $_POST['illnessName'] != '') {

                    // Retrieve 'illnessName' value
                    $illnessName = $_POST['illnessName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['symptoms']) &&
                        isset($_POST['treatable'])
                    ) {
                        // Retrieve values for other columns
                        $symptoms = $_POST['symptoms'];
                        $treatable = $_POST['treatable'];

                        $selectKey = mysqli_query($conn, "SELECT illnessName FROM illness WHERE illnessName = '$illnessName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE illness SET symptoms = ?, treatable = ? WHERE illnessName = ?");

                            // Bind parameters
                            $stmt->bind_param("sss", $symptoms, $treatable, $illnessName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Illness updated successfully.';
                            } else {
                                echo 'Error: Unable to update Illness.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO illness (illnessName, symptoms, treatable) VALUES (?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sss", $illnessName, $symptoms, $treatable);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Illness inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Illness.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Illness name is required
                    echo 'Error: Illness name is required.';
                }
                break;

            case 'medicine':

                // Check if 'medicineName' is set and not empty
                if (isset($_POST['medicineName']) && $_POST['medicineName'] != '') {

                    // Retrieve 'medicineName' value
                    $medicineName = $_POST['medicineName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['medicineDescription']) &&
                        isset($_POST['strength']) &&
                        isset($_POST['providerAFM'])
                    ) {
                        // Retrieve values for other columns
                        $medicineDescription = $_POST['medicineDescription'];
                        $strength = $_POST['strength'];
                        $providerAFM = $_POST['providerAFM'];

                        $selectKey = mysqli_query($conn, "SELECT medicineName FROM medicine WHERE medicineName = '$medicineName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE medicine SET medicineDescription = ?, strength = ?, providerAFM = ? WHERE medicineName = ?");

                            // Bind parameters
                            $stmt->bind_param("ssss", $medicineDescription, $strength, $providerAFM, $medicineName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Medicine updated successfully.';
                            } else {
                                echo 'Error: Unable to update Medicine.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO medicine (medicineName, medicineDescription, strength, providerAFM) VALUES (?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssss", $medicineName, $medicineDescription, $strength, $providerAFM);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Medicine inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Medicine.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Medicine name is required
                    echo 'Error: Medicine name is required.';
                }
                break;

            case 'provider':

                // Check if 'AFM' is set and not empty
                if (isset($_POST['AFM']) && $_POST['AFM'] != '') {

                    // Retrieve 'AFM' value
                    $AFM = $_POST['AFM'];

                    // Check if other required values are set
                    if (
                        isset($_POST['fullName']) &&
                        isset($_POST['city']) &&
                        isset($_POST['street']) &&
                        isset($_POST['streetNumber']) &&
                        isset($_POST['postCode'])
                    ) {
                        // Retrieve values for other columns
                        $fullName = $_POST['fullName'];
                        $city = $_POST['city'];
                        $street = $_POST['street'];
                        $streetNumber = $_POST['streetNumber'];
                        $postCode = $_POST['postCode'];

                        $selectKey = mysqli_query($conn, "SELECT AFM FROM provider WHERE AFM = '$AFM'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE provider SET fullName = ?, city = ?, street = ?, streetNumber = ?, postCode = ? WHERE AFM = ?");

                            // Bind parameters
                            $stmt->bind_param("ssssss", $fullName, $city, $street, $streetNumber, $postCode, $AFM);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Provider updated successfully.';
                            } else {
                                echo 'Error: Unable to update Provider.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO provider (AFM, fullName, city, street, streetNumber, postCode) VALUES (?, ?, ?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssssss", $AFM, $fullName, $city, $street, $streetNumber, $postCode);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Provider inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Provider.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Provider AFM is required
                    echo 'Error: Provider AFM is required.';
                }
                break;

            case 'communication':

                // Check if 'communicationId' is set and not empty
                if (isset($_POST['communicationId']) && $_POST['communicationId'] != '') {

                    // Retrieve 'communicationId' value
                    $communicationId = $_POST['communicationId'];

                    // Check if other required values are set
                    if (
                        isset($_POST['phoneNumber1']) &&
                        isset($_POST['phoneNumber2']) &&
                        isset($_POST['email']) &&
                        isset($_POST['fax'])
                    ) {
                        // Retrieve values for other columns
                        $phoneNumber1 = $_POST['phoneNumber1'];
                        $phoneNumber2 = $_POST['phoneNumber2'];
                        $email = $_POST['email'];
                        $fax = $_POST['fax'];

                        $selectKey = mysqli_query($conn, "SELECT communicationId FROM communication WHERE communicationId = '$communicationId'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE communication SET phoneNumber1 = ?, phoneNumber2 = ?, email = ?, fax = ? WHERE communicationId = ?");

                            // Bind parameters
                            $stmt->bind_param("sssss", $phoneNumber1, $phoneNumber2, $email, $fax, $communicationId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Communication updated successfully.';
                            } else {
                                echo 'Error: Unable to update Communication.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO communication (communicationId, phoneNumber1, phoneNumber2, email, fax) VALUES (?, ?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sssss", $communicationId, $phoneNumber1, $phoneNumber2, $email, $fax);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Communication inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Communication.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Communication Id is required
                    echo 'Error: Communication Id is required.';
                }
                break;

            case 'doctorRelatesToSpecialty':

                // Check if 'doctorId' and 'specialtyName' is set and not empty
                if (isset($_POST['doctorId']) && $_POST['doctorId'] != '' && isset($_POST['specialtyName']) && $_POST['specialtyName'] != '') {

                    // Retrieve 'doctorId' and 'specialtyName' value
                    $doctorId = $_POST['doctorId'];
                    $specialtyName = $_POST['specialtyName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("INSERT INTO doctorRelatesToSpecialty (doctorId, specialtyName) VALUES (?, ?)");

                    // Bind parameters
                    $stmt->bind_param("ss", $doctorId, $specialtyName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo 'Doctor&Specialty inserted successfully.';
                    } else {
                        echo 'Error: Unable to insert Doctor&Specialty.';
                    }

                    // Close prepared statement
                    $stmt->close();

                } else {
                    // Error: Doctor Id and Specialty name are required
                    echo 'Error: Doctor Id and Specialty name are required.';
                }
                break;

            case 'doctorRelatesToMedicine':

                // Check if 'doctorId' and 'medicineName' is set and not empty
                if (isset($_POST['doctorId']) && $_POST['doctorId'] != '' && isset($_POST['medicineName']) && $_POST['medicineName'] != '') {

                    // Retrieve 'doctorId' and 'medicineName' value
                    $doctorId = $_POST['doctorId'];
                    $medicineName = $_POST['medicineName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("INSERT INTO doctorRelatesToMedicine (doctorId, medicineName) VALUES (?, ?)");

                    // Bind parameters
                    $stmt->bind_param("ss", $doctorId, $medicineName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo 'Doctor&Medicine inserted successfully.';
                    } else {
                        echo 'Error: Unable to insert Doctor&Medicine.';
                    }

                    // Close prepared statement
                    $stmt->close();

                } else {
                    // Error: Doctor Id and Medicine name are required
                    echo 'Error: Doctor Id and Medicine name are required.';
                }
                break;

            case 'patientRelatesToDoctor':

                // Check if 'patientId' and 'doctorId' is set and not empty
                if (isset($_POST['patientId']) && $_POST['patientId'] != '' && isset($_POST['doctorId']) && $_POST['doctorId'] != '') {

                    // Retrieve 'patientId' and 'doctorId' value
                    $patientId = $_POST['patientId'];
                    $doctorId = $_POST['doctorId'];

                    // Check if other required values are set
                    if (
                        isset($_POST['dateOfSupervision'])
                    ) {
                        // Retrieve values for other columns
                        $dateOfSupervision = $_POST['dateOfSupervision'];

                        $selectKey = mysqli_query($conn, "SELECT patientId, doctorId FROM patientRelatesToDoctor WHERE patientId = '$patientId' AND doctorId = '$doctorId'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE patientRelatesToDoctor SET dateOfSupervision = ? WHERE patientId = ? AND doctorId = ?");

                            // Bind parameters
                            $stmt->bind_param("sss", $dateOfSupervision, $patientId, $doctorId);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Doctor updated successfully.';
                            } else {
                                echo 'Error: Unable to update Patient&Doctor.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO patientRelatesToDoctor (patientId, doctorId, dateOfSupervision) VALUES (?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sss", $patientId, $doctorId, $dateOfSupervision);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Doctor inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Patient&Doctor.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Patient Id and Doctor Id are required
                    echo 'Error: Patient Id and Doctor Id are required.';
                }
                break;

            case 'patientRelatesToIllness':

                // Check if 'patientId' and 'illnessName' is set and not empty
                if (isset($_POST['patientId']) && $_POST['patientId'] != '' && isset($_POST['illnessName']) && $_POST['illnessName'] != '') {

                    // Retrieve 'patientId' and 'illnessName' value
                    $patientId = $_POST['patientId'];
                    $illnessName = $_POST['illnessName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['dateOfIllness'])
                    ) {
                        // Retrieve values for other columns
                        $dateOfIllness = $_POST['dateOfIllness'];

                        $selectKey = mysqli_query($conn, "SELECT patientId, illnessName FROM patientRelatesToIllness WHERE patientId = '$patientId' AND illnessName = '$illnessName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE patientRelatesToIllness SET dateOfIllness = ? WHERE patientId = ? AND illnessName = ?");

                            // Bind parameters
                            $stmt->bind_param("sss", $dateOfIllness, $patientId, $illnessName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Illness updated successfully.';
                            } else {
                                echo 'Error: Unable to update Patient&Illness.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO patientRelatesToIllness (patientId, illnessName, dateOfIllness) VALUES (?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("sss", $patientId, $illnessName, $dateOfIllness);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Illness inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Patient&Illness.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Patient Id and Illness name are required
                    echo 'Error: Patient Id and Illness name are required.';
                }
                break;

            case 'patientRelatesToMedicine':

                // Check if 'patientId' and 'medicineName' is set and not empty
                if (isset($_POST['patientId']) && $_POST['patientId'] != '' && isset($_POST['medicineName']) && $_POST['medicineName'] != '') {

                    // Retrieve 'patientId' and 'medicineName' value
                    $patientId = $_POST['patientId'];
                    $medicineName = $_POST['medicineName'];

                    // Check if other required values are set
                    if (
                        isset($_POST['dose']) &&
                        isset($_POST['dateOfMedicine'])
                    ) {
                        // Retrieve values for other columns
                        $dose = $_POST['dose'];
                        $dateOfMedicine = $_POST['dateOfMedicine'];

                        $selectKey = mysqli_query($conn, "SELECT patientId, medicineName FROM patientRelatesToMedicine WHERE patientId = '$patientId' AND medicineName = '$medicineName'");

                        if (mysqli_num_rows($selectKey) > 0) {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("UPDATE patientRelatesToMedicine SET dose = ?, dateOfMedicine = ? WHERE patientId = ? AND medicineName = ?");

                            // Bind parameters
                            $stmt->bind_param("ssss", $dose, $dateOfMedicine, $patientId, $medicineName);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Medicine updated successfully.';
                            } else {
                                echo 'Error: Unable to update Patient&Medicine.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        } else {
                            // Prepare SQL statement with placeholders
                            $stmt = $conn->prepare("INSERT INTO patientRelatesToMedicine (patientId, medicineName, dose, dateOfMedicine) VALUES (?, ?, ?, ?)");

                            // Bind parameters
                            $stmt->bind_param("ssss", $patientId, $medicineName, $dose, $dateOfMedicine);

                            // Execute SQL statement
                            if ($stmt->execute()) {
                                echo 'Patient&Medicine inserted successfully.';
                            } else {
                                echo 'Error: Unable to insert Patient&Medicine.';
                            }

                            // Close prepared statement
                            $stmt->close();
                        }

                    } else {
                        // Error: Missing values
                        echo 'Error: All required values are not provided.';
                    }
                } else {
                    // Error: Patient Id and Medicine name are required
                    echo 'Error: Patient Id and Medicine name are required.';
                }
                break;
        }
    } else {
        // Error: 'formType' is not set in the form data
        echo 'Error: Form type is not provided.';
    }

    echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 2000);</script>';
    //header( "Refresh:5; http://localhost/database_website/index.php", true, 303);
}


?>
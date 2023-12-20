<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if 'formType' and 'id' are set in the $_GET array
    if (isset($_GET['formType']) && isset($_GET['id'])) {
        $formType = $_GET['formType'];
        $id = json_decode(urldecode($_GET['id']), true);

        switch ($formType) {
            case 'clinic':
                // Check if 'clinicName' is set and not empty
                if (isset($id['clinicName']) && $id['clinicName'] != '') {
                    // Retrieve 'clinicName' value
                    $clinicName = $id['clinicName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM clinic WHERE clinicName = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $clinicName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Clinic deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Clinic. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Clinic name is required
                    echo '<p class="adjust-p">Error: Clinic name is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'room':
                // Check if 'roomName' is set and not empty
                if (isset($id['roomName']) && $id['roomName'] != '') {
                    // Retrieve 'roomName' value
                    $roomName = $id['roomName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM room WHERE roomName = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $roomName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Room deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Room. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Room name is required
                    echo '<p class="adjust-p">Error: Room name is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'doctor':
                // Check if 'AM' is set and not empty
                if (isset($id['AM']) && $id['AM'] != '') {
                    // Retrieve 'AM' value
                    $AM = $id['AM'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM doctor WHERE AM = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $AM);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Doctor deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Doctor. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: AM is required
                    echo '<p class="adjust-p">Error: AM is required. ✳️</p>';
                }
                break;

            case 'specialty':
                // Check if 'specialtyName' is set and not empty
                if (isset($id['specialtyName']) && $id['specialtyName'] != '') {
                    // Retrieve 'specialtyName' value
                    $specialtyName = $id['specialtyName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM specialty WHERE specialtyName = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $specialtyName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Specialty deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Specialty. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Specialty name is required
                    echo '<p class="adjust-p">Error: Specialty name is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'patient':
                // Check if 'patientId' is set and not empty
                if (isset($id['patientId']) && $id['patientId'] != '') {
                    // Retrieve 'patientId' value
                    $patientId = $id['patientId'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM patient WHERE patientId = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $patientId);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Patient deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Patient. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Patient ID is required
                    echo '<p class="adjust-p">Error: Patient ID is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'illness':
                // Check if 'illnessName' is set and not empty
                if (isset($id['illnessName']) && $id['illnessName'] != '') {
                    // Retrieve 'illnessName' value
                    $illnessName = $id['illnessName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM illness WHERE illnessName = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $illnessName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Illness deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Illness. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Illness name is required
                    echo '<p class="adjust-p">Error: Illness name is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'medicine':
                // Check if 'medicineName' is set and not empty
                if (isset($id['medicineName']) && $id['medicineName'] != '') {
                    // Retrieve 'medicineName' value
                    $medicineName = $id['medicineName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM medicine WHERE medicineName = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $medicineName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Medicine deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Medicine. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Medicine name is required
                    echo '<p class="adjust-p">Error: Medicine name is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'provider':
                // Check if 'AFM' is set and not empty
                if (isset($id['AFM']) && $id['AFM'] != '') {
                    // Retrieve 'AFM' value
                    $AFM = $id['AFM'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM provider WHERE AFM = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $AFM);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Provider deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Provider. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: AFM is required
                    echo '<p class="adjust-p">Error: AFM is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'communication':
                // Check if 'communicationId' is set and not empty
                if (isset($id['communicationId']) && $id['communicationId'] != '') {
                    // Retrieve 'communicationId' value
                    $communicationId = $id['communicationId'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM communication WHERE communicationId = ?");

                    // Bind parameters
                    $stmt->bind_param("s", $communicationId);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Communication deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Communication. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Communication ID is required
                    echo '<p class="adjust-p">Error: Communication ID is required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'doctorRelatesToSpecialty':
                // Check if 'doctorId' and 'specialtyName' is set and not empty
                if (isset($id['doctorId']) && $id['doctorId'] != '' && isset($id['specialtyName']) && $id['specialtyName'] != '') {
                    // Retrieve 'doctorId' and 'specialtyName' value
                    $doctorId = $id['doctorId'];
                    $specialtyName = $id['specialtyName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM doctorRelatesToSpecialty WHERE doctorId = ? AND specialtyName = ?");

                    // Bind parameters
                    $stmt->bind_param("ss", $doctorId, $specialtyName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Doctor&Specialty deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Doctor&Specialty. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Doctor ID and Specialty name are required
                    echo '<p class="adjust-p">Error: Doctor ID and Specialty name are required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'doctorRelatesToMedicine':
                // Check if 'doctorId' and 'medicineName' is set and not empty
                if (isset($id['doctorId']) && $id['doctorId'] != '' && isset($id['medicineName']) && $id['medicineName'] != '') {
                    // Retrieve 'doctorId' and 'medicineName' value
                    $doctorId = $id['doctorId'];
                    $medicineName = $id['medicineName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM doctorRelatesToMedicine WHERE doctorId = ? AND medicineName = ?");

                    // Bind parameters
                    $stmt->bind_param("ss", $doctorId, $medicineName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Doctor&Medicine deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Doctor&Medicine. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Doctor ID and Medicine name are required
                    echo '<p class="adjust-p">Error: Doctor ID and Medicine name are required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'patientRelatesToDoctor':
                // Check if 'patientId' and 'doctorId' is set and not empty
                if (isset($id['patientId']) && $id['patientId'] != '' && isset($id['doctorId']) && $id['doctorId'] != '') {
                    // Retrieve 'patientId' and 'doctorId' value
                    $patientId = $id['patientId'];
                    $doctorId = $id['doctorId'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM patientRelatesToDoctor WHERE patientId = ? AND doctorId = ?");

                    // Bind parameters
                    $stmt->bind_param("ss", $patientId, $doctorId);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Patient&Doctor deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Patient&Doctor. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Patient ID and Doctor ID are required
                    echo '<p class="adjust-p">Error: Patient ID and Doctor ID are required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'patientRelatesToIllness':
                // Check if 'patientId' and 'illnessName' is set and not empty
                if (isset($id['patientId']) && $id['patientId'] != '' && isset($id['illnessName']) && $id['illnessName'] != '') {
                    // Retrieve 'patientId' and 'illnessName' value
                    $patientId = $id['patientId'];
                    $illnessName = $id['illnessName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM patientRelatesToIllness WHERE patientId = ? AND illnessName = ?");

                    // Bind parameters
                    $stmt->bind_param("ss", $patientId, $illnessName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Patient&Illness deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Patient&Illness. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Patient ID and Illness name are required
                    echo '<p class="adjust-p">Error: Patient ID and Illness name are required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;

            case 'patientRelatesToMedicine':
                // Check if 'patientId' and 'medicineName' is set and not empty
                if (isset($id['patientId']) && $id['patientId'] != '' && isset($id['medicineName']) && $id['medicineName'] != '') {
                    // Retrieve 'patientId' and 'medicineName' value
                    $patientId = $id['patientId'];
                    $medicineName = $id['medicineName'];

                    // Prepare SQL statement with placeholders
                    $stmt = $conn->prepare("DELETE FROM patientRelatesToMedicine WHERE patientId = ? AND medicineName = ?");

                    // Bind parameters
                    $stmt->bind_param("ss", $patientId, $medicineName);

                    // Execute SQL statement
                    if ($stmt->execute()) {
                        echo '<p class="success-p">Patient&Medicine deleted successfully. ✅</p>' . '<br><br>Redirecting...';
                    } else {
                        echo '<p class="error-p">Error: Unable to delete Patient&Medicine. ❎</p>' . '<br><br>Redirecting...';
                    }

                    // Close prepared statement
                    $stmt->close();
                } else {
                    // Error: Patient ID and Medicine name are required
                    echo '<p class="adjust-p">Error: Patient ID and Medicine name are required. ✳️</p>' . '<br><br>Redirecting...';
                }
                break;
        }
    } else {
        // Error: formType or id is missing
        echo '<p class="error-p">Error: formType or id is missing. ❎</p>' . '<br><br>Redirecting...';

    }

    echo '<link rel="stylesheet" type="text/css" href="styles-redirect.css">';
    echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 2000);</script>';
    //header( "Refresh:5; http://localhost/database_website/index.php", true, 303);
} else {
    
    // Error: Only accept GET requests
    echo '<link rel="stylesheet" type="text/css" href="styles-redirect.css">';
    echo '<p class="error-p">Error: Invalid request method. ❎</p>' . '<br><br>Redirecting...';
    echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 2000);</script>';
    //header( "Refresh:5; http://localhost/database_website/index.php", true, 303);
}
?>
<?php
include("database.php");
?>

<html>

<head>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <!-- div tab1, tab2 -->
    <div class="tab1">
        <button id="clinic" class="tablinks" onclick="openTable('clinic')">Clinics</button>
        <button id="room" class="tablinks" onclick="openTable('room')">Rooms</button>
        <button id="doctor" class="tablinks" onclick="openTable('doctor')">Doctors</button>
        <button id="specialty" class="tablinks" onclick="openTable('specialty')">Specialties</button>
        <button id="patient" class="tablinks" onclick="openTable('patient')">Patients</button>
        <button id="illness" class="tablinks" onclick="openTable('illness')">Illnesses</button>
        <button id="medicine" class="tablinks" onclick="openTable('medicine')">Medicines</button>
        <button id="provider" class="tablinks" onclick="openTable('provider')">Providers</button>
        <button id="communication" class="tablinks" onclick="openTable('communication')">Communications</button>
    </div>
    <div class="tab2">
        <button id="doctorRelatesToSpecialty" class="tablinks"
            onclick="openTable('doctorRelatesToSpecialty')">Doctor&Specialty</button>
        <button id="doctorRelatesToMedicine" class="tablinks"
            onclick="openTable('doctorRelatesToMedicine')">Doctor&Medicine</button>
        <button id="patientRelatesToDoctor" class="tablinks"
            onclick="openTable('patientRelatesToDoctor')">Patient&Doctor</button>
        <button id="patientRelatesToIllness" class="tablinks"
            onclick="openTable('patientRelatesToIllness')">Patient&Illness</button>
        <button id="patientRelatesToMedicine" class="tablinks"
            onclick="openTable('patientRelatesToMedicine')">Patient&Medicine</button>
        <!--<div class="searchCon">
                <form action="search.php" method="post">
                    <input class="Searchbar" name="searchRequest"type="text" placeholder="Search.." required>
                    <button id="" class="" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>-->
    </div>

    <div id="contentContainer">
        <!-- The content of each tab will be loaded here -->
    </div>



    <script src="script.js"></script>

</body>
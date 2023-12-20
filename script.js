
function openTable(tableName) {
    fetch("generateTable.php?tableName=" + tableName)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById('contentContainer').innerHTML = data;
        })
        .catch(error => {
            console.error('Error during fetch operation:', error);
        });
}


document.getElementById("clinic").addEventListener("click", function () {
    openTable("clinic");
});
document.getElementById("room").addEventListener("click", function () {
    openTable("room");
});
document.getElementById("doctor").addEventListener("click", function () {
    openTable("doctor");
});
document.getElementById("specialty").addEventListener("click", function () {
    openTable("specialty");
});
document.getElementById("patient").addEventListener("click", function () {
    openTable("patient");
});
document.getElementById("illness").addEventListener("click", function () {
    openTable("illness");
});
document.getElementById("medicine").addEventListener("click", function () {
    openTable("medicine");
});
document.getElementById("provider").addEventListener("click", function () {
    openTable("provider");
});
document.getElementById("communication").addEventListener("click", function () {
    openTable("communication");
});

document.getElementById("clinic").click();




function openForm(divId) {
    document.getElementById(divId).style.display = "block";
}
function closeForm(divId) {
    document.getElementById(divId).style.display = "none";
}

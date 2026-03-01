<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
  
    <title>Smart Bus Tracking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-container">
    <h1>🚌 Find your Bus </h1>

    <div class="card">
        
        <label>Route :</label>
        <input type="text" id="route" list="routeList" placeholder="Start typing route..." required>
        <datalist id="routeList"></datalist>

        <label>Current Stop :</label>
        <input type="text" id="stop" list="stopList" placeholder="Select stop..." required>
        <datalist id="stopList"></datalist>

        <label>Time :</label>
        <input type="time" id="time">

        <button onclick="findBus()">Find Bus</button>
        <div id="result"></div>
         
    </div>

   
 
</div>

<script>
window.onload = function() {
    let now = new Date();
    document.getElementById("time").value = now.toTimeString().slice(0,5);
};

document.getElementById("route").addEventListener("input", function() {
    fetch("get_routes.php?q=" + this.value)
    .then(res => res.text())
    .then(data => document.getElementById("routeList").innerHTML = data);
});

document.getElementById("route").addEventListener("change", function() {
    fetch("get_stops.php?route=" + this.value)
    .then(res => res.text())
    .then(data => document.getElementById("stopList").innerHTML = data);
});

function findBus() {
    let route = document.getElementById("route").value;
    let stop = document.getElementById("stop").value;
    let time = document.getElementById("time").value;

    fetch("find_bus.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: `route=${route}&stop=${stop}&time=${time}`
    })
    .then(res => res.text())
    .then(data => {document.getElementById("result").innerHTML = data;
        startETA();
    });
}
function startETA() {

    let arrivalElement = document.getElementById("arrival_time");
    if (!arrivalElement) return;

    let arrivalTime = arrivalElement.getAttribute("data-time");

    let etaSpan = document.getElementById("eta");
    let statusSpan = document.getElementById("status");

    let interval = setInterval(function() {

        let now = new Date();
        let todayDate = now.toISOString().split("T")[0];
        let arrivalDateTime = new Date(todayDate + "T" + arrivalTime);

        let diff = Math.floor((arrivalDateTime - now) / 1000);

        // 🔴 Departed (after 1 minute past arrival)
        if (diff < -60) {
            clearInterval(interval);
            etaSpan.innerHTML = "--";
            statusSpan.innerHTML = "🔴 Departed";
            return;
        }

        // 🟢 Arrived (within 2 minute)
        if (diff <= 0) {
            etaSpan.innerHTML = "0 h 0 m 0 s";
            statusSpan.innerHTML = "🟢 Arriving Now";
            return;
        }

        let hours = Math.floor(diff / 3600);
        let minutes = Math.floor((diff % 3600) / 60);
        let seconds = diff % 60;

        etaSpan.innerHTML =
            hours + " h " +
            minutes + " m " +
            seconds + " s";

        // 🟡 Arriving
        statusSpan.innerHTML = "🟡 Arriving ...";

    }, 1000);
}
</script>

</body>
</html>

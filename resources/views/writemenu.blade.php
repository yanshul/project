<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style>
        table, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<p>Add Your dishes</p>

<table id="myTable">

</table>
<br>

<button onclick="myFunction()">Add new</button>

<script>
    function myFunction() {
        var table = document.getElementById("myTable");
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        cell1.innerText = document.createElement("TEXTAREA");
        cell2.innerHTML = document.createElement("TEXTAREA");
    }
</script>

</body>
</html>
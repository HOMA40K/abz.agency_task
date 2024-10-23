<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Users</title>
</head>
<body>
<h1>Create Users</h1>
    <form action="/api/generateUsers/" method="GET" onsubmit="addCountToAction()">
        <label for="count">Number of Users:</label>
        <input type="number" id="count" name="count" min="1" required>
        <button type="submit">Submit</button>
    </form>

    <script>
        function addCountToAction() {
            var count = document.getElementById('count').value;
            // Dynamically modify the action URL to include the count
            var form = document.querySelector('form');
            form.action = `/api/generateUsers/${count}`;
        }
    </script>
</body>
</html>
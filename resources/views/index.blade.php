<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<body>
<table id="user-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody id="user-list">

        <!-- Users will be appended here -->
    </tbody>
</table>

<button id="show-more" data-page="1">Show more users</button>

<script>
    document.getElementById('show-more').addEventListener('click', function () {
        let page = this.getAttribute('data-page');
        
        fetch(`/api/users?page=${page}`) //fetch(`/api/users`) 
            .then(response => response.json())
            .then(data => {
                // Append new users to the list
                const userList = document.getElementById('user-list');
                
                data.data.forEach(user => {
                    let userCell = document.createElement('tr');
                    let userNameTd = document.createElement('td');
                    let userEmailTd = document.createElement('td');
                    userNameTd.textContent = user.name;
                    userEmailTd.textContent = user.email;
                    userCell.appendChild(userNameTd);
                    userCell.appendChild(userEmailTd);
                    userList.appendChild(userCell);
                });
                
                // Check if there is a next page
                if (data.next_page_url) {
                    this.setAttribute('data-page', parseInt(page) + 1);
                } else {
                    // No more pages, hide the button
                    this.style.display = 'none';
                }
            });
    });
</script>

</body>
</html>



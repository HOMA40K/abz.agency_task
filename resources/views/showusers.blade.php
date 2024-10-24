<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table id="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Picture Path</th>
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
                    let userIdTd = document.createElement('td');
                    let userNameTd = document.createElement('td');
                    let userEmailTd = document.createElement('td');
                    let userPhoneTd = document.createElement('td');
                    let userpictureTd = document.createElement('td');
                    userIdTd.textContent = user.id;
                    userNameTd.textContent = user.name;
                    userEmailTd.textContent = user.email;
                    userPhoneTd.textContent = user.phone_number;
                    let userPictureImg = document.createElement('img');
                    userPictureImg.src = `${user.picture_path}`;
                    userPictureImg.width = 100;
                    userPictureImg.height = 100;
                    userpictureTd.appendChild(userPictureImg);

                    userCell.appendChild(userIdTd);
                    userCell.appendChild(userNameTd);
                    userCell.appendChild(userEmailTd);
                    userCell.appendChild(userPhoneTd);
                    userCell.appendChild(userPictureImg);
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


// Product js file

/**
 * Get All products
 */
async function fetchUsers() {
    let content = "";

    const userSelector = document.getElementById('users-block');

    const url = BASE_API_ENDPOINT + '/api/get_all_users.php';

    return await fetch(url)
        .then((response) =>  response.json() )
        .then((response) => {
            if (200 === response.code) {
                const users = response.data;
                console.log("users :",users)

                users.forEach((user) => (content += getUserHtml(user)));
    
                userSelector.querySelector('tbody').innerHTML = content;
            }

            // display error message
        })
        .catch((error) => {
            console.log(error)
        });
}

const getUserHtml = function (user) {
    return `
        <tr class="user-${user.id}">
            <td>${user.id}</td>
            <td>${user.first_name}</td>
            <td>${user.last_name}</td>
            <td>${user.email}</td>
            <td>${user.phone}</td>
            <td>
            <button type=\"button\" id="btn-view" > View</button>
            <button type=\"button\"> Edit</button>
            <button type=\"button\"> Delete</button>
            </td>
        </tr>
    `;
}


window.onload = function () {
    fetchUsers();
}

function redirect(){
    window.location.href("userEditor.html")
}
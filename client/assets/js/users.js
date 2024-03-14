// Product js file

/**
 * Get All products
 */
/*async function fetchUsers() {
  let content = "";


  const userSelector = document.getElementById("users-block");

  const url = BASE_API_ENDPOINT + "/api/requestHandler.php" + "?read=1";

  return await fetch(url)
    .then((response) => response.json()) // Parse response as JSON
    .then((response) => {
      if (response.success) {
        // Check for success property
        const users = response.data;
        users.forEach((user) => (content += getUserHtml(user)));

        userSelector.querySelector("tbody").innerHTML = content;
      } else {
        console.error("Error:", response.message);
      }
    })
    .catch((error) => {
      console.error(error);
    });
}*/
const prevButton = document.getElementById('prevPage');
const nextButton = document.getElementById('nextPage');
let currentPage = 1; // Initialize currentPage

prevButton.addEventListener('click', () => {
    if (currentPage > 1) {
        currentPage--;
        fetchUsers(currentPage);
    }
});

nextButton.addEventListener('click', () => {
    currentPage++;
    fetchUsers(currentPage);
});

async function fetchUsers(page) {
    let content = "";
    const userSelector = document.getElementById("users-block");
    const limit = 10; // Set the limit here

    const url = `${BASE_API_ENDPOINT}/api/requestHandler.php?read=1&page=${page}&limit=${limit}`;

    return await fetch(url)
        .then((response) => response.json())
        .then((response) => {
            if (response.success) {
                const users = response.data.data; // Extracting the users array from the response
                users.forEach((user) => (content += getUserHtml(user)));
                userSelector.querySelector("tbody").innerHTML = content;
            } else {
                console.error("Error:", response.message);
            }
        })
        .catch((error) => {
            console.error(error);
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
            <button type="button" onclick="editUser(${user.id})" id="edit-btn" > Edit</button>
            <button type="button" onclick="deleteUser(${user.id})" id="delete-btn"> Delete</button>
        </td>
        </tr>
        
    `;
};

window.onload = function () {
  fetchUsers();
};

function redirect() {
  window.location.href("userEditor.html");
}
const deleteUser = async (id) => {
    
    const url = BASE_API_ENDPOINT + `/api/requestHandler.php?delete=1&id=${id}`;
        const data = await fetch(url);
        try{
        if (data.ok) {
            // User deleted successfully
            fetchUsers(); // Fetch updated user list
            alert("User deleted successfully");
          } else {
            alert("Failed to delete user");
          }
        } catch (error) {
            alert("Error deleting user:", error);
        }
   
   
   }



   const tbody = document.querySelector('tbody');

 //delete user
 tbody.addEventListener('click',(e)=>{
    if(e.target &&(e.target.id=== 'delete-btn' )){
        e.preventDefault();
        let id = e.target.getAttribute("id");
        deleteUser(id);
    }
   });

   const editUser = async (id) => {
    window.location.href = `updateUser.html?id=${id}`;
}

  

  
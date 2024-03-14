const updateForm = document.getElementById("edit-user-form");

const fetchOne = async (id) => {
    try {
        const url = `${BASE_API_ENDPOINT}/api/requestHandler.php?readOne=1&id=${id}`;
        const response = await fetch(url);
        const userData = await response.json();
        console.log('user',userData)

        // Populate input fields with user data
        document.getElementById("id").value = userData.id;
        document.getElementById("firstName").value = userData.first_name;
        document.getElementById("lastName").value = userData.last_name;
        document.getElementById("email").value = userData.email;
        document.getElementById("phone").value = userData.phone;
    } catch (error) {
        console.error("Error fetching user data:", error);
    }
}

updateForm.addEventListener("submit", function (e) {
  e.preventDefault();
  submitData(e.target);
});
async function submitData(values) {
  var formData = new FormData(values);
  // full endpoint url;
  const url = `${BASE_API_ENDPOINT}/api/requestHandler.php?update=1&id=${id}`;
  await fetch(url, {
    method: "POST", 
    body: formData, 
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.code == 200) {

        if (confirm("User updated successfully!") == true) {
            location.replace(BASE_API_ENDPOINT + '/client/users.html')
        } else {
          form.reset();
        }
      } else {
        alert("error on user update");
      }
    });
}


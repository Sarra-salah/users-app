const form = document.getElementById("myForm");
form.addEventListener("submit", function (e) {
  e.preventDefault();
  submitData(e.target);
});
async function submitData(values) {
  var formData = new FormData(values);
  // full endpoint url;
  const url = BASE_API_ENDPOINT + "/api/add_user.php";
  await fetch(url, {
    //action will be as a controller file
    method: "POST", //method we are using
    body: formData, //the data will be sent to the server
  })
    .then((response) => response.json())
    .then((response) => {
      //handle the response
      console.log(response);
      // You need to add error response handle case:
      if (response.code == 200) {
        // if 200 response user added go to users list
        if (confirm("Uer Created successfully!") == true) {
            location.replace(BASE_API_ENDPOINT + '/client/users.html')
        } else {
          form.reset();
        }
      } else {
        // if 402 response failed to add user show alert message
        alert("error on user creation");
      }
    });
}

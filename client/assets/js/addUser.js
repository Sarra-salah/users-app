
const form = document.getElementById("myForm");
form.addEventListener("submit", function (e) {
  e.preventDefault();
  submitData(e.target);
});
async function submitData(values) {
  var formData = new FormData(values);
  // full endpoint url;
  const url = BASE_API_ENDPOINT + "/api/requestHandler.php"+"?add";
  await fetch(url, {
    method: "POST", 
    body: formData, 
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.code == 200) {

        if (confirm("User Created successfully!") == true) {
            location.replace(BASE_API_ENDPOINT + '/client/users.html')
        } else {
          form.reset();
        }
      } else {
        alert("error on user creation");
      }
    });
}

const tbody = document.querySelector('tbody');


tbody.addEventListener("click",e =>{
    if (e.target){
        e.preventDefault();
        let id = e.target.getAttribute("id")
    }
})
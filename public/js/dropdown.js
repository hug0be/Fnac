document.addEventListener("DOMContentLoaded", ()=> {
    let dropdowns = document.querySelectorAll('.dropdown_btn')
    for(let dropdown of dropdowns) {
        let element = dropdown.parentNode.querySelector('.dropdown') 
        dropdown.addEventListener('click', ()=> {
            element.classList.toggle('visibility_visible');
        })
    }
})
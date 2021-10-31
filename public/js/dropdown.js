document.addEventListener("DOMContentLoaded", ()=> {
    let dropdowns = document.querySelectorAll('.dropdown')

    for(let dropdown of dropdowns) {
        let element = dropdown.parentNode.querySelector('.visibility_hidden') 
        dropdown.addEventListener('click', ()=> {
            element.classList.toggle('visibility_visible');
        })
    }
})
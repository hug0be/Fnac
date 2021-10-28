

document.addEventListener("DOMContentLoaded", ()=> {

    let aisle_container = document.querySelector('.container_aisle')
    let settings_container = document.querySelector('.settings_container')


    let settings_drop = settings_container.children[1];
    settings_container.addEventListener('click', ()=> {
        settings_drop.classList.toggle('visibility_visible');
    })

    
})
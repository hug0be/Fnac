document.addEventListener("DOMContentLoaded", ()=> {
    let body = document.querySelector('body');
    let header_container_toggle_aisle = document.querySelector('.header_container_toggle_aisle')
    let menu_nav_sidebar = document.querySelector('.menu_nav_sidebar')
    let aisle_container = document.querySelector('.container_aisle')

    let header_aisle_dropdown = aisle_container.children[1];
    aisle_container.addEventListener('click', ()=> {
        header_aisle_dropdown.classList.toggle('visibility_visible');
    })


    header_container_toggle_aisle.addEventListener('click', ()=> {
        menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
        body.classList.toggle('overflow_hidden');

    })

    window.addEventListener('resize', ()=> {
        if (window.innerWidth > 768) {
            menu_nav_sidebar.classList.remove('menu_nav_sidebar_active');
            body.classList.remove('overflow_hidden');
        }
    })
})

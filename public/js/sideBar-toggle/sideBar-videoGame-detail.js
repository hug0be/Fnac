
document.addEventListener("DOMContentLoaded", ()=> {

    // let header_container_toggle_aisle_videoGame_detail = document.querySelector('.header_container_toggle_aisle_videoGame_detail');
    
    // let header_aisle_dropdown = document.querySelector('.header_aisle_dropdown');
    // let aisle_content_p = document.querySelector('.aisle_content p');
    // let List_header_aisle_dropdown_item = document.querySelectorAll('.header_aisle_dropdown_item');
    

    // let header_container_toggle_aisle = document.querySelector('.header_container_toggle_aisle');
    // let menu_nav_sidebar = document.querySelector('.menu_nav_sidebar');


    // container_aisle.addEventListener('click', ()=> {
    //     header_aisle_dropdown.classList.toggle('visibility_visible');
    // })






    // console.log(header_container_toggle_aisle);


    // header_container_toggle_aisle.addEventListener('click', ()=> {
    //     menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
    //     body.classList.toggle('overflow_hidden');

    //     console.log('cliquer');
    // })

    // window.addEventListener('resize', ()=> {
    //     if (window.innerWidth > 768) {
    //         menu_nav_sidebar.classList.remove('menu_nav_sidebar_active');
    //         body.classList.remove('overflow_hidden');
    //     }
    // })

    

    let body = document.querySelector('body');


    let container_aisle = document.querySelector('.container_aisle');
    let header_aisle_dropdown = document.querySelector('.header_aisle_dropdown');





    let header_container_toggle_aisle_videoGame_detail = document.querySelector('.header_container_toggle_aisle_videoGame_detail');
    let menu_nav_sidebar = document.querySelector('.menu_nav_sidebar');





    container_aisle.addEventListener('click', ()=> {
        header_aisle_dropdown.classList.toggle('visibility_visible');
    })







    header_container_toggle_aisle_videoGame_detail.addEventListener('click', ()=> {

        if (window.innerWidth < 769) {
            menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
            body.classList.toggle('overflow_hidden');
        }
        else {
            menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
        }
        // menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
       
    })






})






// console.log("DETAILLLLLLLLLLLLLLLLLLL");
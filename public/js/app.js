


document.addEventListener("DOMContentLoaded", ()=> {
    let body = document.querySelector('body');

    let container_aisle = document.querySelector('.container_aisle');
    let header_aisle_dropdown = document.querySelector('.header_aisle_dropdown');
    let aisle_content_p = document.querySelector('.aisle_content p');
    let List_header_aisle_dropdown_item = document.querySelectorAll('.header_aisle_dropdown_item');
    

    let header_container_toggle_aisle = document.querySelector('.header_container_toggle_aisle');
    let menu_nav_sidebar = document.querySelector('.menu_nav_sidebar');


    container_aisle.addEventListener('click', ()=> {
        header_aisle_dropdown.classList.toggle('visibility_visible');
    })


    List_header_aisle_dropdown_item.forEach(aItem => {
        aItem.addEventListener('click', ()=> {
            console.log(aItem.textContent);

            aisle_content_p.innerHTML = aItem.textContent;
        })

        
    })

    console.log(header_container_toggle_aisle);


    header_container_toggle_aisle.addEventListener('click', ()=> {
        menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
        body.classList.toggle('overflow_hidden');

        console.log('cliquer');
    })

    window.addEventListener('resize', ()=> {
        if (window.innerWidth > 768) {
            menu_nav_sidebar.classList.remove('menu_nav_sidebar_active');
            body.classList.remove('overflow_hidden');
        }
    })

    





    // let header_container_toggle_aisle_videoGame_detail = document.querySelector('.header_container_toggle_aisle_videoGame_detail');

    // header_container_toggle_aisle_videoGame_detail.addEventListener('click', ()=> {
    //     menu_nav_sidebar.classList.toggle('menu_nav_sidebar_active');
    // })
    // console.log("hi");

    // console.log(header_container_toggle_aisle_videoGame_detail);




})

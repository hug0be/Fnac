

document.addEventListener('DOMContentLoaded', ()=> {

    let body = document.querySelector('body');

    let all_game_detail_small_img = document.querySelectorAll('.game_detail_small_img');

    let game_detail_active_img = document.querySelector('.game_detail_active_img');

    let container_lightbox_detail_game = document.querySelector('.container_lightbox_detail_game');
    let lightbox_detail_game_img = document.querySelector('.lightbox_detail_game_img');
    let lightbox_detail_game_content = document.querySelector('.lightbox_detail_game_content');
    let lightbox_detail_game_close = document.querySelector('.lightbox_detail_game_close');

    let active_img_open = document.querySelector('.active_img_open');





    // ----------------------- Display img open
    game_detail_active_img.addEventListener('mouseenter', ()=> {
        active_img_open.style.visibility = "visible";
    })
    game_detail_active_img.addEventListener('mouseleave', ()=> {
        active_img_open.style.visibility = "hidden";
    })





    // ------------------------ Change src of image
    lightbox_detail_game_img.src = game_detail_active_img.src;


    all_game_detail_small_img.forEach(a_small_img => {

        a_small_img.addEventListener('mouseenter', ()=> {
            // console.log(a_small_img.src);

            game_detail_active_img.src = a_small_img.src ;
            lightbox_detail_game_img.src = a_small_img.src;
            
        })
    })








    // ------------------------ Open and Close lightbox
    game_detail_active_img.addEventListener('click', ()=> {
        container_lightbox_detail_game.style.visibility = "visible";
        body.classList.add('overflow_hidden');
    })

    lightbox_detail_game_close.addEventListener('click', ()=> {
        container_lightbox_detail_game.style.visibility = "hidden";
        body.classList.remove('overflow_hidden');
    })

    container_lightbox_detail_game.addEventListener('click', (e)=> {
        if (e.target != lightbox_detail_game_content && e.target != lightbox_detail_game_img) {
            container_lightbox_detail_game.style.visibility = "hidden";
            body.classList.remove('overflow_hidden');
        }
    })

    

    // console.log(all_game_detail_small_img);






})
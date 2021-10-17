

document.addEventListener('DOMContentLoaded', ()=> {

    let body = document.querySelector('body');

    let all_game_detail_small_img = document.querySelectorAll('.game_detail_small_img');

    let game_detail_active_img = document.querySelector('.game_detail_active_img');

    let container_lightbox_detail_game = document.querySelector('.container_lightbox_detail_game');
    let lightbox_detail_game_img = document.querySelector('.lightbox_detail_game_img');
    let lightbox_detail_game_content = document.querySelector('.lightbox_detail_game_content');
    let lightbox_detail_game_close = document.querySelector('.lightbox_detail_game_close');

    let container_active_img = document.querySelector('.container_active_img');
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

    game_detail_active_vid = document.createElement("video");
    game_detail_active_vid.classList.add('game_detail_active_img');
    game_detail_active_vid.setAttribute("controls", "controls");

    game_detail_active_vid_source = document.createElement("source");
    game_detail_active_vid.appendChild(game_detail_active_vid_source);

        all_game_detail_small_img.forEach(a_small_img => {

        a_small_img.addEventListener('mouseenter', ()=> {

            if(a_small_img.tagName.toLowerCase() == 'img')
            {
                if (document.body.contains(game_detail_active_vid)){
                    console.log("Suppr vid");
                    game_detail_active_vid.parentNode.removeChild(game_detail_active_vid);
                }
                console.log(game_detail_active_img);

                if (!document.body.contains(game_detail_active_img)){
                    console.log("Add img");
                    container_active_img.appendChild(game_detail_active_img);
                }

                game_detail_active_img.src = a_small_img.src ;
                lightbox_detail_game_img.src = a_small_img.src;
            }
            else 
            {
                if (document.body.contains(game_detail_active_img)){
                    console.log("Suppr img");
                    game_detail_active_img.parentNode.removeChild(game_detail_active_img);
                }

                if (!document.body.contains(game_detail_active_vid)){
                    console.log("Add vid");
                    container_active_img.appendChild(game_detail_active_vid);
                }
                game_detail_active_vid_source.setAttribute("src", a_small_img.currentSrc);
                game_detail_active_vid.load();
            }
            
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

    

    console.log(all_game_detail_small_img);






})
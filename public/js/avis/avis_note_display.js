

document.addEventListener('DOMContentLoaded', ()=> {
    
    
    let notice_card_note = document.querySelectorAll('.notice_card_note') ;


       // ------------------------ Note notice card


       notice_card_note.forEach(aNoticeNote => {

        valueNote = parseInt( aNoticeNote.querySelector('.notice_value_note').textContent )
    
        allIconStars = aNoticeNote.querySelectorAll('.notice_icon_note');

        for (let i = 0; i < valueNote; i++) {
            allIconStars[i].style.color = "#f1c40f";
         
        }

    })
})
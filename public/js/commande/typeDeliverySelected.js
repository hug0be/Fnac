



document.addEventListener("DOMContentLoaded", () => {


    let allRadio  = document.querySelectorAll('.order_input_box_radio input');

    let allSelectBox = document.querySelectorAll('.order_input_box_select')



    radioCheckedContent(allRadio, allSelectBox);



})






function radioCheckedContent(allRadio, allSelectBox) {
    allRadio.forEach(aLabelRadio => {

        if (aLabelRadio.checked) {

            allSelectBox.forEach(aSelectBox => {
                
                if (aSelectBox.id == aLabelRadio.id) {
                    aSelectBox.style.display = "flex" ;
                }
                else {
                    aSelectBox.style.display = "none" ;
                }


            });
        }


        aLabelRadio.addEventListener('click', ()=> {
            // console.log(aLabelRadio.checked);


            if (aLabelRadio.checked) {

                allSelectBox.forEach(aSelectBox => {
                    
                    if (aSelectBox.id == aLabelRadio.id) {
                        aSelectBox.style.display = "flex" ;
                    }
                    else {
                        aSelectBox.style.display = "none" ;
                    }
    
    
                });
            }





        })

        
    });
}
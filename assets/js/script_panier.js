const btns = document.querySelectorAll('.add-cart');
for (let btn of btns){
    btn.addEventListener('click', function (){
        var panier = "coucou";
        console.log(panier);
    });
}




// JS quantity 

// document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

// var valueCount

// document.querySelector(".plus-btn").addEventListener("click", function () {

//     valueCount = document.getElementById("quantity").value;

//     valueCount++;

//     document.getElementById("quantity").value = valueCount;

//       if (valueCount > 1) {
//              document.querySelector(".minus-btn").removeAttribute("disabled");
//              document.querySelector(".minus-btn").classList.remove("disabled");
//      }
// })

// document.querySelector(".minus-btn").addEventListener("click", function () {

//     valueCount = document.getElementById("quantity").value;

//     valueCount--;

//     document.getElementById("quantity").value = valueCount

//         if (valueCount == 1) {
//             document.querySelector(".minus-btn").setAttribute("disabled", "disabled")
//          }
// })





document.querySelector(".minus-btn").setAttribute("disabled", "disabled");


btnPlus = document.querySelectorAll(".plus-btn");
btnMoin = document.querySelectorAll(".minus-btn");
qantity = document.querySelectorAll(".quantitie");


for (let btn of btnPlus){
    btn.addEventListener('click', function (e){       
    const index = [].indexOf.call(btnPlus, e.target);
    qantity[index].value ++; 
        console.log(index);
    if (qantity[index].value > 1) {
                     btnMoin[index].removeAttribute("disabled");
                     btnMoin[index].classList.remove("disabled");
             }
    });
}

for (let btn of btnMoin){
    btn.addEventListener('click', function (e){       
        const index = [].indexOf.call(btnMoin, e.target);
        qantity[index].value --;  

        if (qantity[index].value == 1) {
                       btnMoin[index].setAttribute("disabled", "disabled")
                     }

    });
}





const btns = document.querySelectorAll('.add-cart');
const cartValue = document.querySelector('.cart span');
const total = document.querySelector('#total');
for (let btn of btns){
    btn.addEventListener('click', function (e){
        const index = [].indexOf.call(btns, e.target);
        const quantities = quantity[index].value;
        const productID = btns[index].dataset.idproduct;
        fetch(`/cart/${productID}/${quantities}`)
        .then(response => response.json())
        .then(data => {
        console.log(data.nombre)
        cartValue.innerHTML = data.nombre


    });

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
quantity = document.querySelectorAll(".quantitie");
validation = document.querySelectorAll(".add-cart");



for (let btn of btnPlus){
    btn.addEventListener('click', function (e){       
    const index = [].indexOf.call(btnPlus, e.target);
    quantity[index].value ++; 
        console.log(index);
    if (quantity[index].value > 1) {
                     btnMoin[index].removeAttribute("disabled");
                     btnMoin[index].classList.remove("disabled");
             }
    });
}

for (let btn of btnMoin){
    btn.addEventListener('click', function (e){       
        const index = [].indexOf.call(btnMoin, e.target);
        quantity[index].value --;  

        if (qantity[index].value == 1) {
                       btnMoin[index].setAttribute("disabled", "disabled")
                     }

    });
}





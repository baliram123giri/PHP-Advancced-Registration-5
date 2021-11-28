var bgImg = document.querySelector(".bg-img")
window.addEventListener("mousemove", (e) =>{
    var x = e.clientX/50
    var y = e.clientY/50
//   var rnad =   Math.random(10,100)*1
//     console.log(rnad)
    // console.log("Client X : " + x, "Client Y : " + y)
    // bgImg.style.transform= 'translateX('+x+'px)';
    // bgImg.style.transform= 'translateY('+y+'px)';
    bgImg.style.backgroundPositionX= x+"px"
    bgImg.style.backgroundPositionY= y+"px"
     setTimeout(() => {
        bgImg.style.backgroundPosition= "center"
     }, 1500);

})
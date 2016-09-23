function review(elem){
   var x = document.getElementsByClassName("upButton");
   var y = document.getElementsByClassName("data");
   var z = document.getElementsByClassName("edit");
   var i;

    x[elem].style.display = "block";
    y[elem].style.display = "block";
    z[elem].style.display = "none";

}
function edit(elem){
   var x = document.getElementsByClassName("upButton");
   var y = document.getElementsByClassName("data");
   var z = document.getElementsByClassName("edit");
   var i;

   x[elem].style.display = "none";
    y[elem].style.display = "none";
    z[elem].style.display = "block";

}

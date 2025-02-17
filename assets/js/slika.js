var glavnaSlika = document.getElementById("glavnaSlika");
var malaSlika = document.getElementsByClassName("small-slika");

for(let i=0;i<4;i++){
    //kada kliknemo jednu od slika koja ima id small-slika,glavnaSlika se updatuje sa njenim ID-om
malaSlika[i].onclick=function(){
    glavnaSlika.src=malaSlika[i].src;
}
}
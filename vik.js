
var feeDiv = document.getElementById('showFee');
var infoDiv = document.getElementById('showInfo');
var codeDiv = document.getElementById('showCode');
var feeBtn = document.getElementById('btn1');
var infoBtn = document.getElementById('btn2');
var codeBtn = document.getElementById('btn3');
feeBtn.addEventListener("click",show);
infoBtn.addEventListener("click",show);
codeBtn.addEventListener("click",show);
function show(){
  var allSection = document.querySelectorAll("section");
  for (var i = 0; i < allSection.length; i++) {
    allSection[i].className="hide";
  }

  var fid = this.attributes["data-img"].value;
  var x = document.getElementById(fid);
  if (x.className=="hide") {
    x.className="";
  }
  else {
    x.className="hide";
  }
}
/*..............................................................*/
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn1')) {

    var dropdowns = document.getElementsByClassName("dropdown1-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
/*..........................................................*/

    function mySub() {
      var btn = document.getElementById('btnsub');
      if (btn.value=="SUBSCRIBED") {
        btn.value ="SUBSCRIBE";
      }
      else {
        btn.value="SUBSCRIBED";
      }

    }
    /*....................................................*/

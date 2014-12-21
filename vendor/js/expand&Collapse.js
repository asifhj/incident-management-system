// JavaScript Document
 function toggleDiv(id1,id2) {
  var tag = document.getElementById(id1).style;
  var tagicon = document.getElementById(id2);
  alert(id);
  if(tag.display == "none") {
   tag.display = "block";
   tagicon.innerHTML = '<img src="images/arrowNew.gif' alt='' title=''>";
  } else {
   tag.display = "none";
   tagicon.innerHTML = '<img src="images/arrowNew.gif' alt='' title=''>";
  }
 }
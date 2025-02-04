function allClose(menuid) {
  var list = document.getElementById(menuid).getElementsByTagName("ul");
  for (var i = 0; i < list.length; i++) {
    list[i].style.display = "none";
  }
}
function openMenu(node) {
  var subMenu = node.parentNode.getElementsByTagName("ul")[0];
  subMenu.style.display == "none"
    ? (subMenu.style.display = "block")
    : (subMenu.style.display = "none");
}

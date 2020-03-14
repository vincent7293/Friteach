var bodyClass = document.getElementById("BottomBar").classList,
    lastScrollY = 0;
window.addEventListener('scroll', function(){
  "use strict";
  var st = this.scrollY;
  // 判斷是向上捲動，而且捲軸超過 200px
  if( st < lastScrollY) {
    bodyClass.remove('hideUp');
  }else{
    bodyClass.add('hideUp');
  }
  lastScrollY = st;
});
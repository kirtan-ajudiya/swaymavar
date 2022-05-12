const menu = document.querySelector('.menu');
const menuSection = menu.querySelector('.menu-section');
const menuArrow = menu.querySelector('.menu-mobile-arrow');
const menuClosed = menu.querySelector('.menu-mobile-close');
const menuTrigger = document.querySelector('.menu-mobile-trigger');
const menuOverlay = document.querySelector('.overlay');
let subMenu;
menuSection.addEventListener('click', (e) => {
   if (!menu.classList.contains('active')) {
      return;
   }
   if (e.target.closest('.menu-item-has-children')) {
      const hasChildren = e.target.closest('.menu-item-has-children');
      showSubMenu(hasChildren);
   }
});
menuArrow.addEventListener('click', () => {
   hideSubMenu();
});
menuTrigger.addEventListener('click', () => {
   toggleMenu();
});
menuClosed.addEventListener('click', () => {
   toggleMenu();
});
menuOverlay.addEventListener('click', () => {
   toggleMenu();
});
function toggleMenu() {
   menu.classList.toggle('active');
   menuOverlay.classList.toggle('active');
}
function showSubMenu(hasChildren) {
   subMenu = hasChildren.querySelector('.menu-subs');
   subMenu.classList.add('active');
   subMenu.style.animation = 'slideLeft 0.5s ease forwards';
   const menuTitle = hasChildren.querySelector('i').parentNode.childNodes[0].textContent;
   menu.querySelector('.menu-mobile-title').innerHTML = menuTitle;
   menu.querySelector('.menu-mobile-header').classList.add('active');
}
function hideSubMenu() {
   subMenu.style.animation = 'slideRight 0.5s ease forwards';
   setTimeout(() => {
      subMenu.classList.remove('active');
   }, 300);
   menu.querySelector('.menu-mobile-title').innerHTML = '';
   menu.querySelector('.menu-mobile-header').classList.remove('active');
}
window.onresize = function () {
   if (this.innerWidth > 991) {
      if (menu.classList.contains('active')) {
         toggleMenu();
      }
   }
};

$(document).ready(function(){
  window.onscroll = function() {myFunction()};

  var header = document.getElementById("myHeader");
  var sticky = header.offsetTop;

  function myFunction() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
      $('.menu-logo').show();
    } else {
      header.classList.remove("sticky");
      $('.menu-logo').hide();
    }
  }
})


$(document).ready(function() {
   $("#Arrival-slider").owlCarousel({
       items : 5,
     itemsDesktop:[1199,5],  
     itemsDesktop:[1199,5],
       itemsDesktopSmall:[980,2],
       itemsMobile : [600,1],
       navigation:true,loop:true,
   margin:10,
   nav:true,
  autoplay:true,
   autoplayTimeout: 200,
   autoplayHoverPause:true,
   center: true,
       navigationText:["",""],
       
       
   });
   
   $("#products-slider").owlCarousel({
      items : 5,
    itemsDesktop:[1199,5],  
    itemsDesktop:[1199,5],
      itemsDesktopSmall:[980,2],
      itemsMobile : [600,1],
      navigation:true,loop:true,
  margin:10,
  nav:true,
 autoplay:true,
  autoplayTimeout: 200,
  autoplayHoverPause:true,
  center: true,
      navigationText:["",""],
      
      
  });
  
  $("#Seller-slider").owlCarousel({
   items : 5,
 itemsDesktop:[1199,5],  
 itemsDesktop:[1199,5],
   itemsDesktopSmall:[980,2],
   itemsMobile : [600,1],
   navigation:true,loop:true,
margin:10,
nav:true,
autoplay:true,
autoplayTimeout: 200,
autoplayHoverPause:true,
center: true,
   navigationText:["",""],
   
   
});
});
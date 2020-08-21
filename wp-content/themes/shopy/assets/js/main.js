$(document).ready(function(){

/*------------------------------------    

	01. JS For mobile view menu

--------------------------------------*/

	$( ".fa-times" ).hide();

    $( ".nav-menu" ).hide();

    jQuery('.fa-bars').click(function(){

        jQuery('.nav-menu').slideToggle(function() {

            $( ".fa-bars" ).hide();

            $( ".fa-times" ).show();        

          });

    });



    jQuery(".fa-times" ).click(function() {

        jQuery( ".nav-menu" ).slideToggle(function() {

            $( ".fa-times" ).hide();

            $( ".fa-bars" ).show();

          });

    });



    $(".fa-bars").click(function(){

        $("body").addClass("stop-scroll");

    });

    $(".fa-times").click(function(){

    	$("body").removeClass("stop-scroll");

	});



/*------------------------------------    

	02. Shopping Cart Area

--------------------------------------*/



    $('.cart__menu').on('click', function(e) {

        e.preventDefault();

        $('.shopping__cart').addClass('shopping__cart__on');

        $('.body__overlay').addClass('is-visible');



    });



    $('.offsetmenu__close__btn').on('click', function(e) {

        e.preventDefault();

        $('.shopping__cart').removeClass('shopping__cart__on');

        $('.body__overlay').removeClass('is-visible');

    });



/*------------------------------------    

    03. Search Bar

--------------------------------------*/ 

    

    $( '.search__open' ).on( 'click', function () {

        $( 'body' ).toggleClass( 'search__box__show__hide' );

        return false;

    });



    $( '.search__close__btn .search__close__btn_icon' ).on( 'click', function () {

        $( 'body' ).toggleClass( 'search__box__show__hide' );

        return false;

    });

/*------------------------------------    

    04. Toogle Menu

--------------------------------------*/



    $('.toggle__menu').on('click', function(e) {

        e.preventDefault();

        $('.offsetmenu').addClass('offsetmenu__on');

        $('.body__overlay').addClass('is-visible');



    });



    $('.offsetmenu__close__btn').on('click', function(e) {

        e.preventDefault();

        $('.offsetmenu').removeClass('offsetmenu__on');

        $('.body__overlay').removeClass('is-visible');

    });

/*------------------------------------    

    05. User Menu

--------------------------------------*/



    $('.user__menu').on('click', function(e) {

        e.preventDefault();

        $('.user__meta').addClass('user__meta__on');

        $('.body__overlay').addClass('is-visible');



    });



    $('.offsetmenu__close__btn').on('click', function(e) {

        e.preventDefault();

        $('.user__meta').removeClass('user__meta__on');

        $('.body__overlay').removeClass('is-visible');

    });

/*------------------------------------    

    06. Overlay Close

--------------------------------------*/



    $('.body__overlay').on('click', function() {

        $(this).removeClass('is-visible');

        $('.offsetmenu').removeClass('offsetmenu__on');

        $('.shopping__cart').removeClass('shopping__cart__on');

        $('.filter__wrap').removeClass('filter__menu__on');

        $('.user__meta').removeClass('user__meta__on');

        $('.off__canvars__wrap').removeClass('off__canvars__wrap__on');

        $('body').removeClass('off__canvars__open');

        $('.menu__click').show();

    });

/*------------------------------------    

    07. Slider for Section

--------------------------------------*/

    $('.banner-slider').slick({

        infinite: true,

        slidesToShow:1,

        slidesToScroll: 1,

        arrow: false,

        dots: false,

        autoplay: true,

        autoplaySpeed: 2000

    });

/*------------------------------------    

    08 . Add to cart home page new arrivals

--------------------------------------*/
$( ".card .display-25 .product__action" ).find('a.cart').click(function( event ) {
    //alert('hii');
    var product_id = $(this).attr("data-product_id");
    $.ajax({
      type : "post",
      dataType : "json",
      url : adminurl,
      data : {action: "custom_add_to_cart",product_id:product_id},
      success: function(response) {
      console.log(response);
      }
    })
});
/*------------------------------------    

    09 . Add to cart home page best sales

--------------------------------------*/
$( ".add-to-cart" ).find('a.cart').click(function( event ) {
    //alert('he');
    var product_id = $(this).attr("data-product_id");
    $.ajax({
      type : "post",
      dataType : "json",
      url : adminurl,
      data : {action: "product_add_to_cart",product_id:product_id},
      success: function(response) {
      console.log(response);
      }
    })
});

/*------------------------------------    

    10 . Remove item from cart on minicart

--------------------------------------*/
$( ".remove__btn .remove_cart_item" ).click(function( event ) {
    //alert('remove');
    var product_id = $(this).attr("data-product_id");
      $.ajax({
        type : "post",
        dataType : "json",
        url : adminurl,
        data : {action: "custom_remove_from_cart",product_id:product_id},
        success: function(response) {
          console.log(response);
        }
      })
});


/*------------------------------------    

    11 . Add to cart home page Adv. section

--------------------------------------*/
$( ".price" ).find('a.cart').click(function( event ) {
    //alert('adv');
    var product_id = $(this).attr("data-product_id");
    $.ajax({
      type : "post",
      dataType : "json",
      url : adminurl,
      data : {action: "prod_add_to_cart",product_id:product_id},
      success: function(response) {
      console.log(response);
      }
    })
});

/*-------------------------------------------------
  12.  Add to cart new-arrivals page
--------------------------------------------------*/
$( ".card .display-33 .product__action .cart").click(function( event ) {
    //alert('hii22');
    var product_id = $(this).attr("data-product_id");
    $.ajax({
      type : "post",
      dataType : "json",
      url : adminurl,
      data : {action: "cust_add_to_cart",product_id:product_id},
      success: function(response) {
      console.log(response);
      }
    })
});
/*---------------------------------------------------
    13. Accordion
---------------------------------------------------*/
function emeAccordion(){
    $('.accordion__title')
      .siblings('.accordion__title').removeClass('active')
      .first().addClass('active');
    $('.accordion__body')
      .siblings('.accordion__body').slideUp()
      .first().slideDown();
    $('.accordion').on('click', '.accordion__title', function(){
      $(this).addClass('active').siblings('.accordion__title').removeClass('active');
      $(this).next('.accordion__body').slideDown().siblings('.accordion__body').slideUp();
    });
    };
emeAccordion();


/*-------------------------------------------------
  14.  Remove class from wishlist icon on content single product page
--------------------------------------------------*/

$(".cloth-collection").find(".cloth-list ul li a").removeClass("add_to_wishlist");
$(".cloth-collection").find(".cloth-list ul li a").removeClass("single_add_to_wishlist");
$(".cloth-collection").find(".cloth-list ul li a").removeClass("button");
$(".cloth-collection").find(".cloth-list ul li a").removeClass("alt");


/*-------------------------------------------------
  15. Remove class from wishlist icon on new-arrivals and hot-deals page
--------------------------------------------------*/

$(".Mainproduct").find(".cloth-list ul li a").removeClass("add_to_wishlist");
$(".Mainproduct").find(".cloth-list ul li a").removeClass("single_add_to_wishlist");
$(".Mainproduct").find(".cloth-list ul li a").removeClass("button");
$(".Mainproduct").find(".cloth-list ul li a").removeClass("alt");

/*-------------------------------------------------
  16. Remove class from wishlist icon on content-single-prduct page
--------------------------------------------------*/

$(".summary").find(".cloth-list ul li a").removeClass("add_to_wishlist");
$(".summary").find(".cloth-list ul li a").removeClass("single_add_to_wishlist");
$(".summary").find(".cloth-list ul li a").removeClass("button");
$(".summary").find(".cloth-list ul li a").removeClass("alt");

}); // main function close
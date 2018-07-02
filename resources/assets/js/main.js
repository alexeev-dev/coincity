$(document).ready(function() {

	// settings menu
	$('.js-settings').click(function(e) {
		e.preventDefault();

		$('.app').toggleClass('active-settings');
		$(this).toggleClass('active');
	});

	// news menu
	$('.js-news').click(function(e) {
		e.preventDefault();

		$('.app').toggleClass('active-news');
		$(this).toggleClass('active');
	});

	// close popup
	$('.js-closePopup').click(function(e) {
		e.preventDefault();

		$(this).parent().removeClass('active');
		$('.popup').removeClass('active');
	});
    
    //check real length
    dragula([document.getElementById("left-lovehandles"), document.getElementById("right-lovehandles")], {
        moves: function (el, container, handle) {
            return handle.classList.contains('handle');
        }
    })
    .on('drop', function (el) {
        el.className += ' dropped';
        // if($("#right-lovehandles .house-item").hasClass("dropped")){
        //     $("#right-lovehandles .house-item.dropped").prependTo("#right-lovehandles");
        // };
        el.classList.remove('dropped');
        
        var housesWidth = $(".houses.drop").outerWidth();
        var housesWidth_ = 0;
        for(i=0; i<$(".houses.drop .house-item").length; i++) {
        	housesWidth_ += $(".houses.drop .house-item").eq(i).outerWidth();
        }
        
        if(housesWidth_ > $(window).width()){
        	$(".houses.drop").attr("style", "width: "+ housesWidth_ +"px;");
        } else {
        	$(".houses.drop").attr("style", "width: 100%;");
        }
        
    });
    
    
    
	// main owl carousel
//	carouselsInit();

	// footer list sorting
	footerListSort();

	// footer buttons actions (info popup and featured)
	footerButtonsActions();

	newsResize();
    
//    $("footer").on("mouseover", ".featured", function(){
//        $(this).parent(".footer-buttons").parent("header").parent(".house-item").parent(".new-active").removeClass("drop");
//    });
//    $("footer").on("mouseleave", ".featured", function(){
//        $(this).parent(".footer-buttons").parent("header").parent(".house-item").parent(".new-active").addClass("drop");
//    });
    
//    $('.dragdrop').draggable({
//        revert: true,
//        placeholder: true,
//        droptarget: '.drop',
//        drop: function(evt, droptarget) {
//            var realLength = $(".houses.drop .house-item").length;
//            $(this).prependTo(droptarget);
//            $(this).draggable('destroy');
//            var housesWidth = $(".houses.drop").outerWidth();
//            if(realLength < $(".houses.drop .house-item").length){
//                if($(".houses.drop .house-item").length > 3){
//                    $(".houses.drop").attr("style", "width: "+ (housesWidth+410) +"px;")
//                }
//            }else{
//                if(realLength > $(".houses.drop .house-item").length){
//                    $(".houses.drop").attr("style", "width: "+ (housesWidth-410) +"px;")
//                    if($(".houses.drop .house-item").length <= 3){
//                        $(".houses.drop").attr("style", "width: 100%;")   
//                    }
//                }
//            }
//        }
//    });

	// jquery scrollbar
	$('.scrollbar').scrollbar({
		"scrollx": $('.scrollbar_x')
	});
    
});

$(window).resize(function() {
	newsResize();
});

//function dragFunctionInit() {
////	$('.footer .owl-stage').attr('id', 'footerHouses');
////	$('.houses .owl-stage').attr('id', 'middleHouses');
//
//	// dragula([footerHouses, middleHouses]);
////	dragula([document.querySelector('#middleHouses'), document.querySelector('#footerHouses')], {
////		revertOnSpill: true
////	}).on('drop', function () {
////		$('.houses, .footer > section').trigger('destroy.owl.carousel');
////
////		carouselsInit();
////
////		console.log(1);
////	});
//}

//function carouselsInit() {
//	var middleOwlCarousel = $('.houses').owlCarousel({
//		center: true,
//		navs: false,
//		dots: false,
//		autoWidth: true,
//		margin: 30,
//		loop: true,
////		onInitialized: dragFunctionInit,
//		stagePadding: 15
//	});
//
//	// footer owl carousel
//	var footerOwlCarousel = $('.footer > section').owlCarousel({
//		navs: false,
//		dots: false,
//		autoWidth: true,
////		onInitialized: dragFunctionInit,
//		stagePadding: 15,
//		responsive : {
//			0 : {
//				stagePadding: 5,
//				margin: 10
//			},
//			480 : {
//				stagePadding: 10,
//				margin: 20
//			},
//			768 : {
//				stagePadding: 15,
//				margin: 30
//			}
//		}
//	});
//}


function footerListSort() {
	$("body").on("click", ".js-listSort a", function(e) {
		e.preventDefault();
        $('.js-listSort a').addClass("active");
		$(this).toggleClass('active');

		if($(this).hasClass('new')) {
            $(".footer section").removeClass("show");
            $(".footer .new-active").addClass("show");
		}

		if($(this).hasClass('built')) {
            $(".footer section").removeClass("show");
            $(".footer .buld-active-block").addClass("show");
			$(".buld-active-block .house-item").remove()
			$(".houses.drop .house-item").clone().appendTo(".buld-active-block.show")
		}

		if($(this).hasClass('featured')) {
            $(".footer section").removeClass("show");
            $(".footer .featured-active-block").addClass("show");
            $(".featured-active-block").find(".house-item").remove()
//            $(".houses").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
            $(".buld-active-block").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
            $(".new-active").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
		}
	})
}

function footerButtonsActions() {
	$("body").on("click", ".js-footerButtons .featured", function(e) {
		e.preventDefault();
        
		$(this).toggleClass('active');
		var featuredItem = $(this).parents('house-item');
		featuredItem.addClass('featured');
        $(this).parent(".footer-buttons").parent("header").parent(".house-item").toggleClass("active-featured")
	});

	$('.js-footerButtons .info').click(function(e) {
		e.preventDefault();		
	});
}

function newsResize() {
	var windowWidth = $(window).width();

	if(windowWidth < 768) {
		$('.js-news').next().css('width', (windowWidth - 70));
	} else {
		$('.js-news').next().attr('style', '');
	}
}
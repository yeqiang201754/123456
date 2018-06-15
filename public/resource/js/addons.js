$(function() {
	/*浜岀骇瀵艰埅*/
	$('.navToggle,.dialog_goback').click(function(){
		if($('.subNav').hasClass('navActive')){
			$('.subNav').removeClass('navActive');	
			
		}							  
		else{
			$('.subNav').addClass('navActive');		
		}
	})
	
		$('.navToggle,.dialog_goback').click(function(){
			$(".dialog_blank").slideToggle(0);
		});
		//椤甸潰涓嶈冻涓€灞忥紝閾烘弧涓€灞�
	$('.layout').css('min-height',$(window).height());

//绾㈠寘寮圭獥
$('#sbt_hb').click(function(){
			$('.box_hbtc').fadeIn();
			$('.mask').show();
		});
	

})
	
//Regional寮€濮�
$(document).ready(function(){
    $(".Regional").click(function(){
        if ($('.grade-eject').hasClass('grade-w-roll')) {
            $('.grade-eject').removeClass('grade-w-roll');
			$(this).removeClass('current');
		
        } else {
            $('.grade-eject').addClass('grade-w-roll');
			$(this).addClass('current');
			$(".meishi").removeClass('current');
			$(".Brand").removeClass('current');
			$(".Sort").removeClass('current');
	
        }
    });
});


//Brand寮€濮�

$(document).ready(function(){
    $(".Brand").click(function(){
        if ($('.Category-eject').hasClass('grade-w-roll')) {
            $('.Category-eject').removeClass('grade-w-roll');
			$(this).removeClass('current');
	
        } else {
            $('.Category-eject').addClass('grade-w-roll');
			$(this).addClass('current');
			$(".Regional").removeClass('current');
			$(".Sort").removeClass('current');
		
        }
    });
});



//Sort寮€濮�

$(document).ready(function(){
    $(".Sort").click(function(){
        if ($('.Sort-eject').hasClass('grade-w-roll')) {
            $('.Sort-eject').removeClass('grade-w-roll');
			$(this).removeClass('current');
		
        } else {
            $('.Sort-eject').addClass('grade-w-roll');
			$(this).addClass('current');
			$(".Regional").removeClass('current');
			$(".Brand").removeClass('current');
		
        }
    });
});


//鍒ゆ柇椤甸潰鏄惁鏈夊脊鍑�

$(document).ready(function(){
    $(".Regional").click(function(){
        if ($('.Category-eject').hasClass('grade-w-roll')){
            $('.Category-eject').removeClass('grade-w-roll');
        };
    });
});
$(document).ready(function(){
    $(".Regional").click(function(){
        if ($('.Sort-eject').hasClass('grade-w-roll')){
            $('.Sort-eject').removeClass('grade-w-roll');
        };
    });
});

$(document).ready(function(){
    $(".Brand").click(function(){
        if ($('.Sort-eject').hasClass('grade-w-roll')){
            $('.Sort-eject').removeClass('grade-w-roll');
        };
    });
});
$(document).ready(function(){
    $(".Brand").click(function(){
        if ($('.grade-eject').hasClass('grade-w-roll')){
            $('.grade-eject').removeClass('grade-w-roll');
        };
    });
});


$(document).ready(function(){
    $(".Sort").click(function(){
        if ($('.Category-eject').hasClass('grade-w-roll')){
            $('.Category-eject').removeClass('grade-w-roll');
        };
    });
});
$(document).ready(function(){
    $(".Sort").click(function(){
        if ($('.grade-eject').hasClass('grade-w-roll')){
            $('.grade-eject').removeClass('grade-w-roll');
        };

    });
});

$(".grade-w li").click(function(){
	$(".grade-w li").removeClass("selected");
	$(this).addClass("selected");
});
$(".Sort-Sort li").click(function(){
	$(".Sort-Sort li").removeClass("selected");
	$(this).addClass("selected");
});
$(".Category-w li").click(function(){
	$(".Category-w li").removeClass("selected");
	$(this).addClass("selected");
});


//js鐐瑰嚮浜嬩欢鐩戝惉寮€濮�



function grade1(wbj){
    var arr = document.getElementById("gradew").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    };

}

function gradet(tbj){
    var arr = document.getElementById("gradet").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    
    };
}

function grades(sbj){
    var arr = document.getElementById("grades").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    };
}

function Categorytw(wbj){
    var arr = document.getElementById("Categorytw").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
       
    };
	
}

function Categoryt(tbj){
    var arr = document.getElementById("Categoryt").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    };
}

function Categorys(sbj){
    var arr = document.getElementById("Categorys").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    };
    sbj.style.borderBottom = "solid 1px #ff7c08"
}

function Sorts(sbj){
    var arr = document.getElementById("Sort-Sort").getElementsByTagName("li");
    for (var i = 0; i < arr.length; i++){
        var a = arr[i];
    };
}
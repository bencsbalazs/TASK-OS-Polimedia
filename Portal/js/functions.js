$(function(){
	
	init();
	
	$('.modal-footer button').click(function(){
		var button = $(this);
		if ( button.attr("data-dismiss") != "modal" ){
			var inputs = $('form input');
			var title = $('.modal-title');
			var progress = $('.progress');
			var progressBar = $('.progress-bar');
			button.hide();
			progress.show();
			progressBar.animate({width : "100%"}, 100);
			progress.delay(1000)
					.fadeOut(600);
			$.ajax({
				type: "post",
				url: "engine/login.php",
				data: {
					user: $('#uLogin').val(),
					pass: $('#uPassword').val()
				},
				success: function( result ) {	
					if (result == "ok") {
					button.text("Close")
						.removeClass("btn-primary")
						.addClass("btn-success")
						.blur()
						.delay(1600)
						.fadeIn(function(){
							title.text("Log in is successful");
							button.attr("data-dismiss", "modal");
						});
						window.open("http://onlinestudium.hu/upm#lista", '_self');	
					} else {
						button.text("Retry")
						.removeClass("btn-primary")
						.addClass("btn-warning")
						.blur()
						.delay(1600)
						.fadeIn(function(){
							title.text(result);
						});
					}
				},
				fail: function(){
					button.text("Retry")
						.removeClass("btn-primary")
						.addClass("btn-danger")
						.blur()
						.delay(1600)
						.fadeIn(function(){
							title.text("Log in failed");			
						});
				}
			});	
		}
	});
	$('#myModal').on('hidden.bs.modal', function (e) {
		var inputs = $('form input');
		var title = $('.modal-title');
		var progressBar = $('.progress-bar');
		var button = $('.modal-footer button');
		inputs.removeAttr("disabled");
		title.text("Log in");
		progressBar.css({ "width" : "0%" });
		button.removeClass("btn-success")
				.addClass("btn-primary")
				.text("Ok")
				.removeAttr("data-dismiss");
                
	});
	
	$(window).on('hashchange', function(e){
		hashchanged();
	});
	hashchanged();
	
	$("a").on("click", function(event){
		if ($(this).is("[disabled]")) {
			event.preventDefault();
		}
	});
	
	
	$('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
	
	$('#telefonkonyv').on('click', function(){
		var p = $('#search_param').val();
		var s = $('#search_text').val();
		$('#tel_iframe').attr('src','http://old.uniduna.hu/telefonkonyv?webra_action=phonebookSearch&searchStr='+s+'&name=&department=&title=&email=&phone=');
	});
	
});

/*
 * 
 * Oldalbetöltéskor lefutó függvény, a kezdeti értékek beállítására
 * 
 */

var init = function(){
	LoadMenu();
	LoadLink();
	UserMenu();
	Targets();
}

/*
 * 
 * Ez a függvény vizsgálja a "hash" változását. Ezen keresztül végzi a belső oldalak betöltését.
 * A felismert hash utótaghoz tartozó tartalmat, esetleges plugineket, és utólagos függvényeket
 * tölti be a DOM-ba.
 * 
 */

var hashchanged = function(){
	var hash = location.hash.replace( /^#/, '' );
	switch (hash) {
		case "lista":
			$.when( Load("lista") ).done(function(){
				console.log("okké");
			});
		break;
		case "synchronize":
			Load("sync");
		break;
		case "videok": 
			$.when( Load("sample_videos") ).done(function() {
				$('video').each(function(){
					$(this).load();
				});
			});
		break;
		case "animaciok": 
			$.cachedScript( "js/SWFobject.js" ).done(function( script, textStatus ) {
				console.log( textStatus );
			});
			Load("sample_animations");
		break;
		case "szabadsagnaptar": 
			Load("szabadsagnaptar");
		break;
		case "polimediajotanacsok": Load("pages/polimediatanacsok");
		break;
		default: false;
	}
}

/*
 * 
 * Az AJAX ami betölti a paraméterül kapott PHP állomány tartalmát,
 * a letörölt képernyőre a menüsáv után.
 * 
 */

var Load = function(mit){
	$("body > .row").remove();
	$.ajax({
		type: "post",
		url: "engine/"+mit+".php"
	}).done(function(data) {
		$( data ).insertAfter("nav");
	});
}

/*
 * A főmenü betöltése
 */

var LoadMenu = function(){
	$.ajax({
		url: "engine/menu_linkek.php"
	}).done(function(data) {
		$( data ).appendTo("#MenuDobozok");
	});
}

/* 
 * A főoldali linkgyűjtemény betöltése 
 */

var LoadLink = function(){
	$.ajax({
		url: "engine/menu_boxes.php"
	}).done(function(data) {
		$( data ).appendTo("#DobozosLinkek");
	});
}

var UserMenu = function(){
	$.ajax({
		url: "engine/menu_user.php"
	}).done(function(data) {
		$( data ).appendTo("#UserMenu");
	});
}

/*
 * 
 * Ez a függvény oldaltöltések után végignézi a tartalmat,
 * és a nem belső hivatkozásra mutató linkekhez hozzáadja a
 * target="_blank" attribútumot, hogy az ilyen linkek új ablakban 
 * jelenjenek meg.
 * 
 */

var Targets = function(){
	$("a").each(function(){
		if ($(this).get(0).hasAttribute("href")){
			if($(this).attr("href").substr(0,1) != "#") {
				$(this).attr("target","_blank");
			};
		}
	});
}

/*
 * Megadott URL címről, asyncron módon betölt egy script fájlt,
 * és hozzáadja az oldalhoz futtatható függvényekként.
 */

jQuery.cachedScript = function( url, options ) {
	options = $.extend( options || {}, {
		dataType: "script",
		cache: true,
		url: url
	}); 
	return jQuery.ajax( options );
};

/*
 * A paraméterül kapott UNIX timestamp értéket, ember által olvasható 
 * formátumúra alakítja.
 */

function unixTime(unixtime) {
	var u = new Date(unixtime*1000);
	return u.getUTCFullYear() +
		'-' + ('0' + u.getUTCMonth()).slice(-2) +
		'-' + ('0' + u.getUTCDate()).slice(-2) + 
		' ' + ('0' + u.getUTCHours()).slice(-2) +
		':' + ('0' + u.getUTCMinutes()).slice(-2) +
		':' + ('0' + u.getUTCSeconds()).slice(-2) +
		'.' + (u.getUTCMilliseconds() / 1000).toFixed(1).slice(2, 3) 
};

function videoleker(){
	var sumsize=0;
	var jqxhr = $.post( "http://online.duf.hu/jsondata.php",{})
	.done(function(data) {
		$( "#videodata" ).html( data );
	})
	.fail(function() {
		alert( "error" );
	});
	jqxhr.always(function() {
		$('#datatables').DataTable({
			"bPaginate": false,
			"bStateSave": true
			});
		rows = $("#videodata > tr");
		$(rows).each(function(){
			mts = $(this).find("td").eq(1);
			if (parseInt(mts.text()) > 0){
				mts.text(unixTime(mts.text()));
			}	
			size = $(this).find("td").eq(3);
			sumsize += parseInt(size.text());
			size.text((parseInt(size.text())/1024/1024).toFixed(2) + ' MB');
		});
	});
	$("#videomeret").text((sumsize / 1024 / 1024).toFix(2) + " MB");
}

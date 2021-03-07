(function() {

	$completionBar = $('.completion-bar');
	$container = $('.gratitude-item-container');
	var topPosition = $container.css('top').replace('px', '') * 1;

	$container.find('.gratitude-item > i.favorite').tooltip();

	var idGratitude;
	var items_count = 5;
	var items = [];
	for(var i = 0; i < items_count; i++) {
		items[i] = {
 			_text: "",
 			_favorite: false
 		}
	}

	/**
	* Fetch
	*/

	function fetch() {

		//si no existe lo crea y devuelve id
		$.post('daily-gratitude/init').done(function(rs) {

			idGratitude = rs.grat_date_entity[0].id;
			console.log(rs);

			// var timestamp = rs[0].fechaDt.timestamp;
			// console.log(moment(timestamp, 'X').format('YYYY-MM-DD'));

		});

	}

	//on init, busco grat del día
	fetch();


	/**
	* Submit
	*/


	function submit() {

		if($(this).attr('disabled')) return;

		console.log('submit');

		var data = {
			idGratitude: idGratitude,
			items: items
		}

		$.post('daily-gratitude/submit', { data: data }).done(function(rs) {
			console.log(rs);

	    	sessionStorage.setItem('submission_result', 'success');
	    	window.location = '../';

		});

	}

	$('#btn_submit').on('click', submit);


	/**
	* Favorite
	*/

	function toggleFavorite() {

		$(this).toggleClass('fa-star-o').toggleClass('fa-star');
		$(this).animate({ 'height': '120%' }, 50); //weird bounce effect

		var itemIndex = $(this).parent().index();
		items[itemIndex]._favorite = !items[itemIndex]._favorite;

	}

	$container.find('.gratitude-item > i.favorite').click(toggleFavorite);

	/**
	* Item complete
	*/

	function onItemChange($elem) {

		items[$elem.parent().index()]._text = $elem.val();
		calculateCompletion();

	}


	function calculateCompletion() {

		var done = 0;
		for(var i = 0; i < items_count; i++) {
			if(items[i]._text.length) done++;
		}

		var barWidth = $completionBar.css('width').replace('px', '') * 1;
		var completion = (done / items_count) * 100;

		$completionBar.find('.completion-bar-slider').animate({
			'width': (completion + '%')
		}, 50);

		$('#btn_submit').attr('disabled', !(completion == 100));

		if(completion == 100) { //all done

			$('.completion-bar-container > .fa-check').show()
			.animate({
				'zoom': '150%'
			}, 150, function() {
				$('.completion-bar-container > .fa-check').animate( {'zoom': '100%' }, 150)
			});

		} else {

			$('.completion-bar-container > .fa-check').hide();			

		}

	}

	/**
	* Items navigation
	*/

	function activateNextItem(nextIndex, motion) {

		var activeIndex = $container.find('.gratitude-item.active-item').index() + 1;
		if(activeIndex == nextIndex) return;

		$nextItem = $container.find('.gratitude-item:nth-child('+ nextIndex +')');

		if($nextItem.length) {

			$container.find('.gratitude-item').removeClass('active-item contig-item');

			$container.find('.gratitude-item:nth-child('+ (nextIndex + 1) +'), .gratitude-item:nth-child('+ (nextIndex - 1) +')')
			.addClass('contig-item');
			$nextItem.addClass('active-item');

			var direction = nextIndex > activeIndex ? -1 : 1;
			topPosition = topPosition + (120 * direction);

			$container.animate({
				'top': topPosition
			}, 100);

		}


	}


	//on focus
	$(document).on('focus', '.gratitude-item:not(.active-item) textarea', function() {

		var nextIndex = $(this).parent().index();
		activateNextItem(nextIndex + 1);

	});
	

	$(document).on('keydown', '.gratitude-item.active-item textarea', function(e) {

		if(e.keyCode != 13 && e.keyCode != 9) return; // 13: Enter // 9: Tab // 8: Return

		$nextItem = $(this).parent().next('.gratitude-item');

		//on tab
		if(e.keyCode == 9) {
			e.preventDefault();
			if(e.shiftKey) { //reverse tab
				$nextItem = $(this).parent().prev();
			}
		} 

		if(e.keyCode == 13) {
			if(e.shiftKey) return;
			e.preventDefault();
		}

		if(items[$(this).parent().index()]._text != $(this).val()) {
			//if text has changed, submit
			onItemChange($(this));
		}

		if($nextItem.length) $nextItem.find('textarea').focus();	

	});

	$(document).on('keyup', '.gratitude-item.active-item textarea', function(e) {

		if(e.keyCode != 13 && e.keyCode != 8) return; // 13: Enter // 9: Tab // 8: Return

		//if adding or deleting row, adjust height
		if( (e.keyCode == 13 && e.shiftKey) || e.keyCode == 8 ) {
			$(this).css('height', '1px');
			$(this).css('height', 'auto');
			var lines = $(this).val().split('\n').length;
			if(lines > 1) $(this).css('height', (10 + this.scrollHeight) + 'px' );
		}

	});

	//sit in first textarea on init
	$container.find('.gratitude-item:first-child textarea').focus();


})();
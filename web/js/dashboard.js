(function() {
	

	//checks if daily action has just been submitted and notifies if true
	if(sessionStorage.getItem('submission_result') !== null) {
		$.notify({  message: "Alright! now let's get to work :)" }, {
			delay: 4000,
			allow_dismiss: false
		});

		sessionStorage.removeItem('submission_result');
	}


	//on init, ask for today's action
	$.post('daily-gratitude/init').done(({ grat_date_entity, quote }) => {
		$('.quote-container > h2').text(quote.quoteString);
		if(grat_date_entity[0].status > 0) {
			//if done, hide action button and show message
			$('.btn-daily-gratitude-container').hide();
		}
	});


	//get gratitude streak
	function getConsecutiveGratitudeDate() {

		$.get('daily-gratitude/consecutive-date').done(function(rs) {
			console.log(rs);
			$('.daily-streak-container span').text(rs);
		});

	}

	getConsecutiveGratitudeDate();


})();
(function() {

	console.log('working!');

	$container = $('.gratitude-item-container');

	function nextItem() {


		var top = $container.css('top');
		console.log(top);
		$container.css('top', '-=60');

	}

	$('#btn_test').on('click', nextItem);

	console.log('This should not be a problem');
	console.log('that');


})();
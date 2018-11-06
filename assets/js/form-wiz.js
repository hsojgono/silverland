$(document).ready(function() {
  	$('#rootwizard').bootstrapWizard({'tabClass': 'nav', 'debug': false, onShow: function(tab, navigation, index) {
		console.log('onShow');
	}, onNext: function(tab, navigation, index) {
		console.log('onNext');
	}, onPrevious: function(tab, navigation, index) {
		console.log('onPrevious');
	}, onLast: function(tab, navigation, index) {
		console.log('onLast');
	}, onTabClick: function(tab, navigation, index) {
		console.log('onTabClick');
		alert('on tab click disabled');
	}, onTabShow: function(tab, navigation, index) {
		console.log('onTabShow');
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
        $('#rootwizard .progress-bar').css({width:$percent+'%'});
	}});

	$('#pills').bootstrapWizard({'tabClass': 'nav nav-pills', 'debug': false, onShow: function(tab, navigation, index) {
		console.log('onShow');
	}, onNext: function(tab, navigation, index) {
		console.log('onNext');
	}, onPrevious: function(tab, navigation, index) {
		console.log('onPrevious');
	}, onLast: function(tab, navigation, index) {
		console.log('onLast');
	}, onTabClick: function(tab, navigation, index) {
		console.log('onTabClick');
		alert('on tab click disabled');
	}, onTabShow: function(tab, navigation, index) {
		console.log('onTabShow');
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
        $('#pills .progress-bar').css({width:$percent+'%'});
	}});

	$('#tabsleft').bootstrapWizard({'tabClass': 'nav nav-tabs', 'debug': false, onShow: function(tab, navigation, index) {
		console.log('onShow');
	}, onNext: function(tab, navigation, index) {
		console.log('onNext');
	}, onPrevious: function(tab, navigation, index) {
		console.log('onPrevious');
	}, onLast: function(tab, navigation, index) {
		console.log('onLast');
	}, onTabClick: function(tab, navigation, index) {
		console.log('onTabClick');

	}, onTabShow: function(tab, navigation, index) {
		console.log('onTabShow');
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
        $('#tabsleft .progress-bar').css({width:$percent+'%'});

		// If it's the last tab then hide the last button and show the finish instead
		if($current >= $total) {
			$('#tabsleft').find('.pager .next').hide();
			$('#tabsleft').find('.pager .finish').show();
			$('#tabsleft').find('.pager .finish').removeClass('disabled');
		} else {
			$('#tabsleft').find('.pager .next').show();
			$('#tabsleft').find('.pager .finish').hide();
		}

	}});

	$('#inverse').bootstrapWizard({'tabClass': 'nav', 'debug': false, onShow: function(tab, navigation, index) {
		console.log('onShow');
	}, onNext: function(tab, navigation, index) {
		console.log('onNext');
		if(index==2) {
			// Make sure we entered the name
			if(!$('#name').val()) {
				alert('You must enter your name');
				$('#name').focus();
				return false;
			}
		}
		// Set the name for the next tab
		$('#inverse-tab3').html('Hello, ' + $('#name').val());

	}, onPrevious: function(tab, navigation, index) {
		console.log('onPrevious');
	}, onLast: function(tab, navigation, index) {
		console.log('onLast');
	}, onTabClick: function(tab, navigation, index) {
		console.log('onTabClick');
		alert('on tab click disabled');
		return false;
	}, onTabShow: function(tab, navigation, index) {
		console.log('onTabShow');
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
        $('#inverse .progress-bar').css({width:$percent+'%'});
	}});

	$('#tabsleft .finish').click(function() {
		alert('Finished!, Starting over!');
		$('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
	});
});

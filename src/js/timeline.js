var timeline = (function($){

	var questions;

	var o = {
		splash: '#splash-screen',
		confirmation: '#confirmation-screen',
		timelineMinWidth: 1000,
		imgPath: '/dist/img/',
		elems: {
			questionWrapper: '.wrapper',
			timelineWrapper: '#timeline',
			tooltip: '#tooltip',
			form: '#form',
			mailFields: ['address','city','state','zip'],
			formSubmit: '#form #submit',
			formError: '.error-wrapper',
			questionElementClass: 'questionElement',
			questionElementInnerClass: 'questionWrapper',
			timelineElementClass: 'timelineElement',
			timelineTopClass: 'timelineElementTop',
			timelineBottomClass: 'timelineElementBottom',
			timelineAxisClass: 'major-axis-point',
			timelineTickClass: 'tick-box',
			chosenClass: 'optChosen',
			correctClass: 'optCorrect',
			incorrectClass: 'optIncorrect',
			answerElementInnerClass: 'answerWrapper'
		}
	};
	
	var init = function(opt){
		o = $.extend({}, o, opt);

		questions = o.data.questions;

		buildTimelines();
		toggleHelper();
		addListeners();
		start();


		/* testing and debug */
		var d = new Date();
		console.log('dragger initialized');
		console.log('end of build '+d.toLocaleTimeString());

		
		//showCard(0);
		//$('.hit').trigger('click');


		/* testing and debug */
		
	};


	// hide the splash page, show the first question
	var start = function(){
		$(o.splash).hide();
		showCard(0);
	};


	// show conformation page
	var destroy = function(){
		eventTrigger('show confirmtation');
		$(o.confirmation).css({'display': 'flex'});
	};


	// go through each question and built timeline, question text, answer text
	var buildTimelines = function(){

		data = o.data;

		$.each(data.questions,function(i,q){

			// set some important values
			var min = q.min; //min year on timeline
			var max = q.max; // max year on timeline
			var scale = q.minorScale; // minor unit scale
			var roundScale = q.minorLabelRoundScale; //round decimal places for larger units
			var majorGridPoint = q.majorGridPoint; //major unit scale
			var majorGridPointLabel = q.majorGridLabel; // major unit label
			var majorScale = q.majorLabelRoundScale;
			var majorLabelOffset = q.majorLabelOffset;

			if('timelineMinWidth' in q){
				var minWidth = q.timelineMinWidth;
			} else {
				var minWidth = o.timelineMinWidth;
			}


			// create question and answer as wrapped element
			$("<div>", {class: o.elems.questionElementClass, id: 'question'+i}).css({
	        	'background-image': 'url(/slideImages/'+q.image+')'
	        }).append(
		        $("<div>", {class: o.elems.questionElementInnerClass}).append(
		            $("<h2>").text('Question #'+(i+1)),
		            $('<p>').text(q.text)
		        ),
		        $('<div>',{class: o.elems.answerElementInnerClass}).append(
		        	$('<h2>').html('You did better than <span>XX%</span> of people who answered this question!'),
		        	$('<div>',{class: 'answerText'}).html(q.answerText),
		        	$('<div>',{ class: 'nextButtonWrapper' }).append(
		        		$('<span>',{class: 'next', 'data-timeline': i}).text('next'),
		        		$('<div>',{class: 'arrow-right'})
	        		)
	        	)
		    ).appendTo(o.elems.questionWrapper);

			// create timeline element for this questions
			var thisT = $('<div></div>')
				.addClass(o.elems.timelineElementClass)
				.attr({'id':'timeline'+i,'data-axis':majorGridPoint})
				.css({'minWidth':minWidth+'px'})
				.html('<div class="'+o.elems.timelineTopClass+'"></div><div class="'+o.elems.timelineBottomClass+'"></div>');
			$(thisT).appendTo(o.elems.timelineWrapper);
		

			/* * * * * * * * * * */
			/* build tick marks */
			/* * * * * * * * * * */
			var thisYear = min;
			var count = 0;

			for(j = min; j.toFixed(roundScale) <= max; j = j + scale){


				if(thisYear < 0){
					displayYear = thisYear.toFixed(roundScale) * -1;
				} else {
					displayYear = thisYear.toFixed(roundScale);
				}

				var $tick = $("<div>", {class: o.elems.timelineTickClass, 'data-year': thisYear.toFixed(roundScale)}).append(
			        $("<div>", {class: 'hit'}),
			        $("<div>", {class: 'label'}).text(displayYear)
			    ).appendTo($(thisT).children('.'+o.elems.timelineTopClass));

				/*
				if('hideMinorLabels' in q){
					if(q.hideMinorLabels == true){
						$(tick).html('<div></div>');
					}
				}*/

				thisYear = thisYear + scale;
				count++;
			}
			
			$('#timeline'+i+' .tick-box').each(function(){
				var thisYear = $(this).attr('data-year');

				if(thisYear % majorGridPoint === 0){

					if(thisYear < 0) {
						displayYear = thisYear * -1;
					} else {
						displayYear = thisYear;
					}

					var shortenedLabel = displayYear/majorScale;
					shortenedLabel = shortenedLabel + majorLabelOffset;

					var thisMajorLabel = shortenedLabel + majorGridPointLabel;
					var majorPoint = $('<div></div>').html(thisMajorLabel).addClass(o.elems.timelineAxisClass).attr({'data-year':thisYear});
					$(majorPoint).appendTo($(thisT).children('.'+o.elems.timelineBottomClass));
				}
			});
		});
	};
	

	// hide this timeline and show the next one
	var showCard = function(num){

		toggleTimeline(true);
		
		
		if($('#question'+num).length) {
			$('.'+o.elems.questionElementClass+', .'+o.elems.timelineElementClass).hide();
			$('.'+o.elems.timelineTickClass+' .hit').removeClass('correct').removeClass('incorrect');

			eventTrigger('page show',(num+1));


			$('#question'+num+', #timeline'+num).show();
			fitTimelineLabels(num);
			toggleHelper();
		} else {
			
			eventTrigger('quiz complete');
			destroy();
		}	
	};


	// show the user what the correct answer is with text and timeline ticks
	var showAnswer = function(opt,num){

		toggleTimeline(false);

		var correct = questions[num].answer;

		$('.chosen').remove();

		$('.'+o.elems.timelineTickClass+'[data-year="'+correct+'"] .hit').addClass('correct');

		if(opt != correct){
			$('.'+o.elems.timelineTickClass+'[data-year="'+opt+'"] .hit').addClass('incorrect');
		}

		$(o.elems.tooltip).hide();
		$('#question'+num+' .questionWrapper').hide();
		$('#question'+num+' .answerWrapper').show();
	};


	// show the user capture form
	var showForm = function(selectedYear){
		eventTrigger('show form');
		$('#form #submittedYear').val(selectedYear);
		$(o.elems.tooltip).hide();
		$('#form, #screen').show();
	};


	// validate form fields on capture form
	var validateForm = function(){

		var formError = false;
		$(o.elems.form + ' .required').each(function() {
			var $theInput = $(this).siblings();

			if($theInput.val() == ''){
				formError = true;
				$($theInput).addClass('error');
			}
		});

		if(formError == true){
			toggleSubmit(false);
		} else {

			eventTrigger('form submit');


			$('#form, #screen').hide();
			var selectedYear = $('#form #submittedYear').val();
			showAnswer(selectedYear,0);
		}
	}

	
	// look at the year boxes for this timeline and adjust their widths
	var fitTimelineLabels = function(timelineId){

		if(timelineId == null){
			var timeline = getActiveTimeline();
		} else {
			var timeline = $('#timeline'+timelineId);
		}
		
		
		var majorGridPoint = $(timeline).attr('data-axis');
		var childTicks = $(timeline).find('.'+o.elems.timelineTickClass);

		$(childTicks).each(function(){

			var thisYear = $(this).attr('data-year');
			if(thisYear % majorGridPoint === 0){
				var offset = $(this).offset();
				var majorPoint = $(timeline).find('.'+o.elems.timelineAxisClass+'[data-year="'+thisYear+'"]');
				$(majorPoint).css({'left':(offset.left-1)+'px'});
			}

		});
	};


	// helper, get the active timeline
	var getActiveTimeline = function(){
		return $('.'+o.elems.timelineElementClass+':visible');
	};


	//look at widths of window and timeline to show/hide helper tooltip
	var toggleHelper = function(){
		
		var $tooltip = $(o.elems.tooltip);
		var $timeline = getActiveTimeline();

		if($timeline.width() > $(window).width()){
			$tooltip.show();
			$(o.elems.timelineWrapper).css({
				'cursor': 'grab', 
				'cursor': '-o-grab',
				'cursor' : '-moz-grab',
				'cursor' : '-webkit-grab'
			});
		} else {
			$tooltip.hide();
			$(o.elems.timelineWrapper).css({'cursor': 'default'});
		}
	}


	// when showing the answer to a question, disable clicking on the timeline they just interacted with
	var toggleTimeline = function(newStatus){

		if(newStatus == true){
			$(o.elems.timelineWrapper).css({'pointer-events': 'auto'});
		} else {
			$(o.elems.timelineWrapper).css({'pointer-events': 'none'});
		}
	}


	// turn the user capture form submit button on and off
	toggleSubmit = function(newStatus){

		if(newStatus == true){
			$(o.elems.formError).css({'opacity': 0});
			$(o.elems.formSubmit).removeAttr('disabled');
		} else {
			$(o.elems.formError).css({'opacity': 1});
			$(o.elems.formSubmit).attr('disabled','disabled');
		}
	}


	// add event listeners
	var addListeners = function(){
		var that = this;

		// timeline year boxes need to be sized properly on load and resize
		// tooltip to scroll shows when the timeline is wider than the window
		$(window).resize(function() {
			fitTimelineLabels();
			toggleHelper();
		});

		// user has viewed an answer, move on to the next question
		$('.next').click(function(){
			var thisTimeline = $(this).attr('data-timeline');
			thisTimeline++;
			showCard(thisTimeline);

		});

		// user has picked their answer, proceed to answer or capture if this is Q #1
		$('.'+o.elems.timelineTickClass+' .hit').click(function(){
			var selectedYear = $(this).parent().attr('data-year');
			var $t = getActiveTimeline();
			var timelineNum = $t.attr('id').substring(8);

			eventTrigger('answered question',(parseInt(timelineNum)+1));

			if(timelineNum == 0){
				showForm(selectedYear);
			} else {
				showAnswer(selectedYear,timelineNum);
			}
		});

		// user has attempted to submit the capture form
		$(o.elems.formSubmit).click(function(){
			validateForm();
		});

		// user interactions with capture form fields
		$('#form input[type="text"],#form input[type="email"], #form select').on('focus',function() {
			$(this).addClass('active');
		}).on('blur',function() {

			// adjust this input
			if($(this).val() == ''){
				$(this).removeClass('active');

				if($(this).siblings('label').hasClass('required')){
					$(this).addClass('error');
				}
			} else {
				$(this).removeClass('error').addClass('active');
			}

			// check all inputs to toggle error message
			if($('#form input[type="text"],#form input[type="email"]').hasClass('error')){
				toggleSubmit(false);
			} else {
				toggleSubmit(true);
			}
		});

		$('#form #optin').click(function(){
			if($(this).is(":checked")){
				//$('label[for="address"], label[for="city"]').addClass('required');
				$.each(o.elems.mailFields,function(i,v){
					$('label[for="'+v+'"]').addClass('required');
				});
			} else {
				$.each(o.elems.mailFields,function(i,v){
					$('label[for="'+v+'"]').removeClass('required');
				});
			}
		});
	};

	var eventTrigger = function(eventName,val){
		var addition = '';
		if(val !== undefined){
			var addition = ', '+val;
		}

		console.log('triggering event: '+eventName+addition);
	};


	return { init: init };
})(jQuery);

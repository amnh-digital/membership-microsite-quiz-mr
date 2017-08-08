var timeline = (function($){
	var questions;

	var o = {
		splash: '#splash-screen',
		confirmation: '#confirmation-screen',
		scrollAmount: 100,
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
		checkForm();
		addListeners();
		start();	
	};

	/**
	  * build and destroy
	  * 
	  * 
	*/
	// hide the splash page, show the first question
	var start = function(){
		$('.'+o.elems.timelineElementClass).hide();
		$(o.splash).slideUp();
		showNextQuestion(0);
	};


	// show conformation page
	var destroy = function(){

		// calculate final score
		data = { step: 'final' };

		$.post("post.php",data).done(function(resp) {
			result = JSON.parse(resp);

			if(result.result == 'success'){
				
				if(result.message > 20){
					$('#resultScoreContainer').show();
					$('#resultScore').html(result.message+'%');
				}


			}
		});


		eventTrigger('/end');
		$(o.confirmation).css({'display': 'flex'});
	};




	/**
	  * generate html for each timeline/question pair
	  * 
	  * 
	*/
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

			if('imagePosition' in q){
				var imagePosition = q.imagePosition;
			} else {
				var imagePosition = '0% 0%';
			}


			// create question and answer as wrapped element
			$("<div>", {class: o.elems.questionElementClass, id: 'question'+i}).css({
	        	'background-image': 'url(/slideImages/'+q.image+')',
	        	'background-position': imagePosition
	        }).append(
		        $("<div>", {class: o.elems.questionElementInnerClass}).append(
		            $("<h2>").text('Question #'+(i+1)),
		            $('<p>').html(q.text)
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




	/**
	  * timeline interactions
	  * 
	  * 
	*/
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
				//var offset = $(this).offset();
				var offset = $(this).position();

				//console.log(thisYear);
				//console.log(offset);
				//console.log('  ');


				var majorPoint = $(timeline).find('.'+o.elems.timelineAxisClass+'[data-year="'+thisYear+'"]');
				$(majorPoint).css({'left':(offset.left-1)+'px'});
			}

		});
	};

	var moveTimeline = function(direction){
		var currentScroll = $('#timelineInner').scrollLeft();

		if(direction == 'left'){
			currentScroll = currentScroll + o.scrollAmount;
		} else {
			currentScroll = currentScroll - o.scrollAmount;
		}

		//$('#timelineInner').scrollLeft(currentScroll);
		$('#timelineInner').animate({scrollLeft: currentScroll}, 200);
	}


	var centerTimeline = function(num){
		//var timeline = getActiveTimeline();
		$('#timelineInner').scrollLeft(0);
	}
	

	// save individual question
	var saveQuestionResponse = function(userAnswer,timelineNumber){
		data = {
			step: 'question',
			answer: userAnswer,
			questionNumber: timelineNumber
		};
			
		//console.log('sending data to question save');
		//console.log(data);


		$.post("post.php",data).done(function(resp) {
			result = JSON.parse(resp);
			//console.log(result);
			if(result.result == 'success'){
				prepareAnswer(result.message);
			}
		});
	}


	// show the user what the correct answer after saving it is with text and timeline ticks
	var prepareAnswer = function(data){
		
		//console.log(data);

		var timelineNum = data.questionId - 1;
		var correctAnswer = data.questionAnswer;
		var userAnswer = data.userAnswer;
		var score = data.score;

		if(score <= 20){
			h2copy = 'Oops! Your score was in the bottom <span>20%</span> of this question. A visit to the museum can help you brush up on our history.';
		} else {
			h2copy = 'You did better than <span>'+score+'%</span> of people who answered this question!';
		}

		if(userAnswer == correctAnswer){
			h2copy = 'You got it right!';
		}

		toggleTimeline(false);
		toggleHelper('hide');


		$('.chosen').remove();

		$('.'+o.elems.timelineTickClass+'[data-year="'+correctAnswer+'"] .hit').addClass('correct');

		if(userAnswer != correctAnswer){
			$('.'+o.elems.timelineTickClass+'[data-year="'+userAnswer+'"] .hit').addClass('incorrect');
		}

		$(o.elems.tooltip).hide();
		$('#question'+timelineNum+' .questionWrapper').hide();
		$('#question'+timelineNum+' .answerWrapper h2').html(h2copy);
		$('#question'+timelineNum+' .answerWrapper').show();

		eventTrigger('/answer-'+(timelineNum+1));
	};


	// hide this timeline and show the next one
	var showNextQuestion = function(num){

		if($('#question'+num).length) {
			eventTrigger('/question-'+(num+1));



			// hide this one
			$('#timeline'+(num-1)).fadeOut();
			$('.'+o.elems.questionElementClass).hide();
			$('.'+o.elems.timelineTickClass+' .hit').removeClass('correct').removeClass('incorrect');		


			
			// show the next one
			$('#question'+num).show();
			
			

			if(num == 0){
				var targetHeight = $(window).height() - 60 - 115 - 20;
				$('body .wrapper').delay(500).animate({height: targetHeight+"px"}, 500);
				
			} else {
				//$('#timeline'+num).delay(800).show( "slide", { direction: 'right' },1400);
			}


			$('#timeline'+num).fadeIn(400,function(){
				centerTimeline(num);
				fitTimelineLabels(num);
				$('#question'+num+' .questionWrapper').delay(1000).fadeIn();
				setTimeout(function(){
					toggleHelper();
					toggleTimeline(true);
				},1500);
			});
			
			


			

	
			
		} else {
			destroy();
		}	
	};




	/**
	  * form interactions
	  * 
	  * 
	*/
	// show the user capture form
	var showForm = function(selectedYear){
		eventTrigger('/email-capture');
		$('#form #submittedYear').val(selectedYear);
		$('#form #optin').trigger('click');
		$('#form #optin').prop('checked', true);
		
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

		if($('#zip').val() != ''){
			var regex = /^\d{5}$/;
			if(regex.test($('#zip').val()) == false){
				formError = true;
				$('#zip').addClass('error');
			}
		}



		if(formError == true){
			toggleSubmit(false);
		} else {
			var formData = convertToJson('#form form');
			saveFormResponse(formData);
		}
	}


	// post the form to the database, move on to first answer
	var saveFormResponse = function(data){

		data.step = 'user';

		$.post("post.php",data).done(function( resp ) {
			result = JSON.parse(resp);

			if(result.result == 'error'){
				toggleSubmit(false);

				$.each(result.focus,function(key,val){
					$(val).addClass('error');
				});

				if('message' in result){
					$(o.elems.formError+' span').text(result.message);
				}

			} else {
				toggleSubmit(true);
				$('*').removeClass('error');

				$('#form, #screen').hide();

				dataLayer.push({
				  'event': 'emailSignup'
				});

				saveQuestionResponse(data.submittedYear,0);
			}


		});
	};




	/**
	  * togglers
	  * catch events, prepare some values, call a function
	  * 
	*/
	//look at widths of window and timeline to show/hide helper tooltip
	var toggleHelper = function(intent){

		intent = intent || null;
		
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

		var $thisQ = getActiveQuestion();
		if($thisQ.length){
			if($thisQ.children('.answerWrapper').is(':visible')){
				$tooltip.hide();
				$(o.elems.timelineWrapper).css({'cursor': 'default'});
			}
		}

		if(intent == 'hide'){ 
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
			$(o.elems.tooltip).hide();
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




	/**
	  * helpers
	  * catch events, prepare some values, call a function
	  * 
	*/
	// helper, get the active timeline
	var getActiveTimeline = function(){
		return $('.'+o.elems.timelineElementClass+':visible');
	};

	var getActiveQuestion = function(){
		return $('.'+o.elems.questionElementClass+':visible');
	};


	// convert form fields with set value to key => value
	var convertToJson = function(form){
	    var array = jQuery(form).serializeArray();
	    var json = {};
	    
	    jQuery.each(array, function() {

	    	if(this.value != ''){
	    		json[this.name] = this.value || '';
	    	}
	        
	    });
	    
	    return json;
	}

	var checkForm = function(){
		$('#form input').each(function(){
			if($(this).val() != ''){
				validate(this);
			}
		});
	};

	
	var validate = function(elem){
		// adjust elem input
		if($(elem).val() == ''){
			$(elem).removeClass('active');

			if($(elem).siblings('label').hasClass('required')){
				$(elem).addClass('error');
			}
		} else {
			$(elem).removeClass('error').addClass('active');
			$(elem).siblings('label').addClass('complete');
		}

		// check all inputs to toggle error message
		if($('#form input[type="text"],#form input[type="email"]').hasClass('error')){
			toggleSubmit(false);
		} else {
			toggleSubmit(true);
		}
	}

	/**
	  * event listeners
	  * catch events, prepare some values, call a function
	  * 
	*/
	var addListeners = function(){
		var that = this;

		// timeline year boxes need to be sized properly on load and resize
		// tooltip to scroll shows when the timeline is wider than the window
		$(window).resize(function() {
			fitTimelineLabels();
			toggleHelper();

			var targetHeight = $(window).height() - 60 - 115 - 20;
			$('body .wrapper').height(targetHeight+"px");

		});

		// user has viewed an answer, move on to the next question
		$('.next').click(function(){
			var thisTimeline = $(this).attr('data-timeline');
			thisTimeline++;
			showNextQuestion(thisTimeline);
		});

		// user has picked their answer, proceed to answer or capture if this is Q #1
		$('.'+o.elems.timelineTickClass+' .hit').click(function(){
			var selectedYear = $(this).parent().attr('data-year');
			var $t = getActiveTimeline();
			var timelineNum = $t.attr('id').substring(8);

			if(timelineNum == 0){
				showForm(selectedYear);
			} else {
				saveQuestionResponse(selectedYear,timelineNum);
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
			validate(this);
		});

		$('#form input[type="text"],#form input[type="email"], #form select').on('keyup',function() {
			if($(this).hasClass('error')){
				validate(this);
			}
		});

		$('#form select').click(function(){
			validate(this);
		});

		// adjust which fields are required if the user wants a premium
		$('#form #optin').click(function(){
			if($(this).is(":checked")){
				$.each(o.elems.mailFields,function(i,v){
					$('label[for="'+v+'"]').addClass('required');
				});
			} else {
				$.each(o.elems.mailFields,function(i,v){
					$('label[for="'+v+'"]').removeClass('required');
					$('#'+v).removeClass('error');
				});
			}
			validate(this);
		});

		$('#tooltip .arrow').click(function(){
			if($(this).hasClass('arrow-left')){ direction = 'right'; }
			else { direction = 'left'; }
			moveTimeline(direction);
		});
	};


	// google analytics event firing
	var eventTrigger = function(eventName){
		console.log('triggering event: '+eventName);
		dataLayer.push({
		  'gaVirtualPageURL': eventName,
		  'event': 'gaVirtualPageview'
		});
	};


	return { init: init };
})(jQuery);

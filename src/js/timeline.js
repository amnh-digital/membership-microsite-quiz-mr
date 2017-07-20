var timeline = (function($){

	var questions;

	var o = {
		splash: '',
		timelineMinWidth: 1000,
		imgPath: '/dist/img/',
		elems: {
			questionWrapper: '.wrapper',
			timelineWrapper: '#timeline',
			tooltip: '#tooltip',
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

		if(o.splash == ''){
			throw new Error('the splash screen must be defined');
		}
		questions = o.data.questions;

		buildTimelines();
		toggleHelper();
		addListeners();
		start();

		var d = new Date();
		console.log('dragger initialized');
		console.log('end of build '+d.toLocaleTimeString());
		
	};

	var start = function(){
		
		$(o.splash).hide();
		showCard(0);
	};

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

			console.log(minWidth);


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
			console.log('---------');

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
			
			$('.tick-box').each(function(){
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


	


	var showCard = function(num){
		$('.'+o.elems.questionElementClass+', .'+o.elems.timelineElementClass).hide();
		
		if($('#question'+num).length) {
			$('#question'+num+', #timeline'+num).show();
			fitTimelineLabels(num);
			toggleHelper();
		} else {
			alert('no more questions');
		}	
	};


	
	
	var answerSelected = function(opt){
		$('.'+o.elems.chosenClass).remove();
		var $indicator = $("<img>", {class: o.elems.chosenClass, 'src': o.imgPath+'pick.png'})
		.appendTo('.'+o.elems.timelineTickClass+'[data-year="'+opt+'"] .hit');
	};

	var showAnswer = function(opt,num){
		var correct = questions[num].answer;

		$('.chosen').remove();

		var $indicator = $("<img>", {class: 'chosen '+ o.elems.correctClass, 'src': o.imgPath+'yep.png'})
			.appendTo('.'+o.elems.timelineTickClass+'[data-year="'+correct+'"] .hit');

		if(opt != correct){
			var $indicator = $("<img>", {class: 'chosen '+o.elems.incorrectClass, 'src': o.imgPath+'nope.png'})
			.appendTo('.'+o.elems.timelineTickClass+'[data-year="'+opt+'"] .hit');
		}	

		$(o.elems.tooltip).hide();
		$('#question'+num+' .questionWrapper').hide();
		$('#question'+num+' .answerWrapper').show();
	};

	var showForm = function(selectedYear){
		$('#form #submittedYear').val(selectedYear);
		$(o.elems.tooltip).hide();
		$('#form, #screen').show();


	};

	var validateForm = function(){
		$('#form, #screen').hide();
		var selectedYear = $('#form #submittedYear').val();
		showAnswer(selectedYear,0);
	}











	var toggleHelper = function(){
		
		var $tooltip = $(o.elems.tooltip);
		var $timeline = getActiveTimeline();

		console.log($timeline.width());
		console.log($(window).width());

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

	var getActiveTimeline = function(){
		return $('.'+o.elems.timelineElementClass+':visible');
	};

	var addListeners = function(){
		var that = this;

		$(window).resize(function() {
			fitTimelineLabels();
			toggleHelper();
		});

		$('.next').click(function(){
			var thisTimeline = $(this).attr('data-timeline');
			thisTimeline++;
			showCard(thisTimeline);

		});

		$('.'+o.elems.timelineTickClass+' .hit').click(function(){
			var selectedYear = $(this).parent().attr('data-year');
			var $t = getActiveTimeline();
			var timelineNum = $t.attr('id').substring(8);


			if(timelineNum == 0){
				showForm(selectedYear);
			} else {
				//answerSelected(selectedYear);
				showAnswer(selectedYear,timelineNum);
			}
		});

		$('#form #submit').click(function(){
			validateForm();
		});
	};


	return { init: init };
})(jQuery);



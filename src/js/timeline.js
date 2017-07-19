var timeline = (function($){

	var questions;

	var o = {
		timelineMinWidth: 1000,
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
			timelineTickClass: 'tick-box'
		}
	};
	
	var init = function(opt){
		o = $.extend({}, o, opt);

		buildTimelines();
		toggleHelper();
		addListeners();
		showSplash();


		var d = new Date();
		

		console.log('dragger initialized');
		console.log('end of build '+d.toLocaleTimeString());
		
	};

	var buildTimelines = function(){

		data = o.data;

		$.each(data.questions,function(i,q){
			console.log(i); // number
			console.log(q); // question data

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


			// create question as wrapped element
			/*var thisQ = $('<div></div>')
				.addClass(o.elems.questionElementClass)
				.attr({'id':'question'+i})
				.html('<h2>Question #'+(i+1)+'</h2><p>'+q.text+'</p>');
			$(thisQ).appendTo(o.elems.questionWrapper);

			var $thisQ = $('<div>',{
				'class': o.elems.questionElementClass,
				'id': 'question'+i
			}).appendTo(o.elems.questionWrapper);*/

			$("<div>", {class: o.elems.questionElementClass, 'id': 'question'+i}).css({
	        	'background-image': 'url(/dist/img/'+q.image+')'
	        }).append(
		        $("<div>", {class: o.elems.questionElementInnerClass}).append(
		            $("<h2>").text('Question #'+(i+1)),
		            $('<p>').text(q.text)
		        )
		    ).appendTo(o.elems.questionWrapper);


			// this was there for testing, likely wont need
			/*
			var nextWrapper = $('<div></div>').addClass('next-wrapper');
			$(nextWrapper).appendTo($thisQ);

			var nextButton = $('<input>').addClass('next').attr({
				'type': 'button',
				'value': 'next',
				'data-timeline': i
			});
			$(nextButton).appendTo($(nextWrapper));*/

			// create timeline element for this questions
			var thisT = $('<div></div>')
				.addClass(o.elems.timelineElementClass)
				.attr({'id':'timeline'+i,'data-axis':majorGridPoint})
				.css({'minWidth':minWidth+'px'})
				.html('<div class="'+o.elems.timelineTopClass+'"></div><div class="'+o.elems.timelineBottomClass+'"></div>');
			$(thisT).appendTo(o.elems.timelineWrapper);

			console.log('ping elem made');
			

			/* * * * * * * * * * */
			/* build tick marks */
			/* * * * * * * * * * */
			//console.log(min);
			//console.log(max);
			//console.log(scale);




			var thisYear = min;
			var count = 0;
			console.log('---------');

			for(j = min; j.toFixed(roundScale) <= max; j = j + scale){


				if(thisYear < 0){
					displayYear = thisYear.toFixed(roundScale) * -1;
				} else {
					displayYear = thisYear.toFixed(roundScale);
				}


				var tick = $('<div></div>').addClass('tick-box').html('<div>'+displayYear+'</div>').attr('data-year',thisYear.toFixed(roundScale));
				/*
				if('hideMinorLabels' in q){
					if(q.hideMinorLabels == true){
						$(tick).html('<div></div>');
					}
				}*/

				$(tick).appendTo($(thisT).children('.'+o.elems.timelineTopClass));

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

	

	var showSplash = function(){


		//this will be moved to a click element later
		showCard(0);


	};


	var showCard = function(num){
		$('.'+o.elems.questionElementClass+', .'+o.elems.timelineElementClass).hide();
		
		if($('#question'+num).length) {
			$('#question'+num+', #timeline'+num).show();
			fitTimelineLabels(num);
		} else {
			alert('no more questions');
		}	
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
	};


	var toggleHelper = function(){
		
		var $tooltip = $(o.elems.tooltip);
		var $timeline = getActiveTimeline();

		console.log($timeline.width());
		console.log($(window).width());

		if($timeline.width() > $(window).width()){
			$tooltip.show();
		} else {
			$tooltip.hide();
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


	return { init: init };
})(jQuery);



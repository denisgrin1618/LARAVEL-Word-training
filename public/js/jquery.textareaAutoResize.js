
(function($) {
	$(document).ready(function() {
		$('body').append('<div id="autoResizeTextareaCopy" style="word-break: break-word;    box-sizing: border-box; -moz-box-sizing: border-box;  -ms-box-sizing: border-box; -webkit-box-sizing: border-box; visibility: hidden;"></div>');
		var $copy = $('#autoResizeTextareaCopy');

		function autoSize($textarea, options) {
			// The copy must have the same padding, the same dimentions and the same police than the original.
			$copy.css({
				fontFamily:     $textarea.css('fontFamily'),
				fontSize:       $textarea.css('fontSize'),
				padding:        $textarea.css('padding'),
				paddingLeft:    $textarea.css('paddingLeft'),
				paddingRight:   $textarea.css('paddingRight'),
				paddingTop:     $textarea.css('paddingTop'),
				paddingBottom:  $textarea.css('paddingBottom'),
				width:          $textarea.css('width')
			});
			$textarea.css('overflow', 'hidden');

			// Copy textarea contents; browser will calculate correct height of copy.
			var text = $textarea.val()
					.replace('<', '&lt;')
					.replace('>', '&gt;')
					.replace('!', '&excl;')
					.replace('"', '&quot;')
					.replace('$', '&dollar;')
					.replace('#', '&num;')
					.replace('%', '&percnt;')
					.replace('&', '&amp;')
					.replace('\'', '&apos;')

					.replace(/\n/g, '<br />');

			$copy.html(text + '<br />');

			//console.log($textarea.val());
			
			// Then, we get the height of the copy and we apply it to the textarea.
			
			
			
			// + Денис
			//var newHeight = $copy.css('height');
			var newHeight1 = $copy.css('height');
			
			if(options.elCopyResize != undefined) {
				var text2 = options.elCopyResize.val()
						.replace('<', '&lt;')
						.replace('>', '&gt;')
						.replace('!', '&excl;')
						.replace('"', '&quot;')
						.replace('$', '&dollar;')
						.replace('#', '&num;')
						.replace('%', '&percnt;')
						.replace('&', '&amp;')
						.replace('\'', '&apos;')
						.replace(/\n/g, '<br />');

				$copy.html(text2 + '<br />');
				var newHeight2 = $copy.css('height');
//                                console.log(options.elCopyResize.attr('id') + " - " + options.elCopyResize.val());
			}
			else{
				var text2 = "";
				var newHeight2 = 0;
			}
			
			
			var newHeight = Math.max(parseInt(newHeight1), parseInt(newHeight2));
			// - Денис
			
			
			
			
			
			$copy.html(''); // We do this because otherwise, a large void appears in the page if the textarea has a high height.

                        
                        newHeightI = parseInt(newHeight);

                        


			maxHeight = parseInt(options.maxHeight);
			minHeight = parseInt(options.minHeight);

			
			
			
			
			if(newHeightI != 0) {
				if((!options.maxHeight || newHeightI < maxHeight) && (!options.minHeight || newHeightI > minHeight)) {
					if(options.animate.enabled) {
						$textarea.animate({
							height: newHeight
						}, {
							duration: options.animate.duration,
							complete: options.animate.complete,
							step:     options.animate.step,
							queue:    false
						});
					}
					else {
						$textarea.css('height', newHeight);
					}

					$textarea.css('overflow-y', 'hidden');
				}
				else {
					$textarea.css('overflow-y', 'scroll');

					if (options.maxHeight && newHeightI >= maxHeight) {
						$textarea.css('height', options.maxHeight);
                                                newHeight = options.maxHeight;
					}
					else if (options.minHeight && newHeightI <= minHeight)
					{
						$textarea.css('height', options.minHeight);
                                                newHeight = options.minHeight;
					}
				}
			}
			
//                         + denis
			if(options.elCopyResize != undefined) {
				options.elCopyResize.css('height', newHeight);
			}
//			 - denis
			
			
			
		}

		$.fn.autoResize = function(options) {
			var $this = $(this),
			    defaultOptions = {
					animate: {
						enabled:   false,
						duration:  100,
						complete:  null,
						step:      null
					},
					maxHeight:     null,
					minHeight:     null
				};

			options = (options == undefined) ? {} : options;
			options = $.extend(true, defaultOptions, options);

			$this.change ( function() { autoSize($this, options); } )
				 .keydown( function() { autoSize($this, options); } )
				 .keyup  ( function() { autoSize($this, options); } )
				 .focus  ( function() { autoSize($this, options); } );

			// No animations on startup
			startupOptions = options;
			startupOptions.animate.enabled = false;
			autoSize($this, startupOptions);

			
		};
		
		// + Denis
		$.fn.ResizeSecondaryElement = function(dest, minHeight) {
			var resizeInt = null;
			var $this = $(this);
			     
			// the handler function
			var resizeEvent = function() {
                            
                                var heg = Math.max( $this.outerHeight(), minHeight);
                                dest.outerWidth( $this.outerWidth() );
				dest.outerHeight( $this.outerHeight());

			};

			// This provides a "real-time" (actually 15 fps)
			// event, while resizing.
			// Unfortunately, mousedown is not fired on Chrome when
			// clicking on the resize area, so the real-time effect
			// does not work under Chrome.
			$this.on("mousedown", function(e) {
				resizeInt = setInterval(resizeEvent, 1000/15);
			});

			// The mouseup event stops the interval,
			// then call the resize event one last time.
			// We listen for the whole window because in some cases,
			// the mouse pointer may be on the outside of the textarea.
			$(window).on("mouseup", function(e) {
				if (resizeInt !== null ) {
					clearInterval(resizeInt);
				}
				resizeEvent();
                                
                                
//                                var min_hight = Math.max(min_height_input, dest.outerHeight(), $this.outerHeight());
                                if( min_height_input > $this.outerHeight()){
                                    $this.autoResize({elCopyResize: dest, minHeight: min_height_input});
//                                    dest.autoResize({elCopyResize: $this, minHeight: min_height_input});
                                }
                                
			});

		};
		// - Denis
		

	});
})(jQuery);

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });
    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title a, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title a, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description').css({'color': to});
            }
        });
    });
    //Top Header date
    wp.customize('eggnews_header_date', function (value) {
        value.bind(function (to) {
            if (to === 'disable') {
                $('.top-header-section .date-section').fadeOut();
            } else {
                $('.top-header-section .date-section').fadeIn();
            }
        });
    });
    //Top Header social
    wp.customize('eggnews_header_social_option', function (value) {
        value.bind(function (to) {
            if (to === 'disable') {
                $('.top-header-section .top-social-wrapper').fadeOut();
            } else {
                $('.top-header-section .top-social-wrapper').fadeIn();
            }
        });
    });
    //News ticker
    wp.customize('eggnews_ticker_option', function (value) {
        value.bind(function (to) {
            if (to === 'disable') {
                $('.eggnews-ticker-wrapper').fadeOut();
            } else {
                $('.eggnews-ticker-wrapper').fadeIn();
            }
        });
    });
    wp.customize('eggnews_ticker_caption', function (value) {
        value.bind(function (to) {
            $('span.ticker-caption').html(to);
        });
    });
	// Whether a header image is available.
	function hasHeaderImage() {
		var image = wp.customize( 'header_image' )();
		return '' !== image && 'remove-header' !== image;
	}

	// Whether a header video is available.
	function hasHeaderVideo() {
		var externalVideo = wp.customize( 'external_header_video' )(),
			video = wp.customize( 'header_video' )();

		return '' !== externalVideo || ( 0 !== video && '' !== video );
	}

	// Toggle a body class if a custom header exists.
	$.each( [ 'external_header_video', 'header_image', 'header_video' ], function( index, settingId ) {
		wp.customize( settingId, function( setting ) {
			setting.bind(function() {
				if ( hasHeaderImage() ) {
					$( document.body ).addClass( 'has-header-image' );
				} else {
					$( document.body ).removeClass( 'has-header-image' );
				}

				if ( ! hasHeaderVideo() ) {
					$( document.body ).removeClass( 'has-header-video' );
				}
			} );
		} );
	} );
}(jQuery));

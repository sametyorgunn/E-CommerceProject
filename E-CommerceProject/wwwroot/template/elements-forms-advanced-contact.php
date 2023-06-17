<?php
namespace PortoContactForm;
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'php/simple-php-captcha/simple-php-captcha.php';
require 'php/php-mailer/src/PHPMailer.php';
require 'php/php-mailer/src/SMTP.php';
require 'php/php-mailer/src/Exception.php';
// Step 1 - Enter your email address below.
$email = 'you@domain.com';
// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;
if(isset($_POST['emailSent'])) {
	// If contact form don't has the subject input change the value of subject here
	$subject = ( isset($_POST['subject']) ) ? $_POST['subject'] : 'Define subject in php/contact-form.php line 29';
	// Step 2 - If you don't want a "captcha" verification, remove that IF.
	if (strtolower($_POST['captcha']) == strtolower($_SESSION['captcha']['code'])) {
		$message = '';
		foreach($_POST as $label => $value) {
			if( !in_array( $label, array( 'emailSent', 'captcha' ) ) ) {
				$label = ucwords($label);
				// Use the commented code below to change label texts. On this example will change "Email" to "Email Address"
				// if( $label == 'Email' ) {               
				// 	$label = 'Email Address';              
				// }
				// Checkboxes
				if( is_array($value) ) {
					// Store new value
					$value = implode(', ', $value);
				}
				$message .= $label.": " . nl2br(htmlspecialchars($value, ENT_QUOTES)) . "<br>";
			}
		}
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = $debug;                            // Debug Mode
			// Step 3 (Optional) - If you don't receive the email, try to configure the parameters below:
			//$mail->IsSMTP();                                         // Set mailer to use SMTP
			//$mail->Host = 'mail.yourserver.com';				       // Specify main and backup server
			//$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			//$mail->Username = 'user@example.com';                    // SMTP username
			//$mail->Password = 'secret';                              // SMTP password
			//$mail->SMTPSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
			//$mail->Port = 587;   								       // TCP port to connect to
			$mail->AddAddress($email);	 						       // Add a recipient
			//$mail->AddAddress('person2@domain.com', 'Person 2');     // Add another recipient
			//$mail->AddCC('person3@domain.com', 'Person 3');          // Add a "Cc" address. 
			//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 
			// From - Name
			$fromName = ( isset($_POST['name']) ) ? $_POST['name'] : 'Website User';
			$mail->SetFrom($email, $fromName);
			// Repply To
			if( isset($_POST['email']) && !empty($_POST['email']) ) {
				$mail->AddReplyTo($_POST['email'], $fromName);
			}
			$mail->IsHTML(true);                                  		// Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = $subject;
			$mail->Body    = $message;
			// Step 4 - If you don't want to attach any files, remove that code below
			if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
				$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
			}
			$mail->Send();
			$arrResult = array ('response'=>'success');
		} catch (Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
		} catch (\Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
		}
	} else {
		$arrResult = array ('response'=>'captchaError');
	}
}
?>
<!DOCTYPE html><html>
	<head>
		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	
		<title>Forms | Porto - Responsive HTML5 Template</title>	
		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
		<!-- Web Fonts  -->		<link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">
		<!-- Vendor CSS -->		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">		<link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">		<link rel="stylesheet" href="vendor/animate/animate.compat.css">		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">
		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">

		<!-- Skin CSS -->		<link id="skinCSS" rel="stylesheet" href="css/skins/default.css">
		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">
		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body data-plugin-page-transition>
		<div class="body">
			<header id="header" class="header-transparent header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': false, 'stickyEnableOnMobile': false, 'stickyStartAt': 70, 'stickyChangeLogo': false, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0 bg-dark box-shadow-none overflow-visible">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index.html"><img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="img/logo-default-slim-dark.png"></a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-line header-nav-bottom-line header-nav-bottom-line-no-transform header-nav-bottom-line-active-text-light header-nav-bottom-line-effect-1 header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-text-capitalize header-nav-main-text-size-2 header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="index.html">															Home														</a>														<ul class="dropdown-menu">															<li>																<a class="dropdown-item" href="index.html">																	Landing Page																</a>															</li>															<li>																<a class="dropdown-item" href="index.html#demos">																	Demos <span class="tip tip-dark">hot</span>																</a>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Classic</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-classic.html">Classic - Original</a></li>																	<li><a class="dropdown-item" href="index-classic-color.html">Classic - Color</a></li>																	<li><a class="dropdown-item" href="index-classic-light.html">Classic - Light</a></li>																	<li><a class="dropdown-item" href="index-classic-video.html">Classic - Video</a></li>																	<li><a class="dropdown-item" href="index-classic-video-light.html">Classic - Video - Light</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Corporate</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-corporate.html">Corporate - Version 1</a></li>																	<li><a class="dropdown-item" href="index-corporate-2.html">Corporate - Version 2</a></li>																	<li><a class="dropdown-item" href="index-corporate-3.html">Corporate - Version 3</a></li>																	<li><a class="dropdown-item" href="index-corporate-4.html">Corporate - Version 4</a></li>																	<li><a class="dropdown-item" href="index-corporate-5.html">Corporate - Version 5</a></li>																	<li><a class="dropdown-item" href="index-corporate-6.html">Corporate - Version 6</a></li>																	<li><a class="dropdown-item" href="index-corporate-7.html">Corporate - Version 7</a></li>																	<li><a class="dropdown-item" href="index-corporate-8.html">Corporate - Version 8</a></li>																	<li><a class="dropdown-item" href="index-corporate-9.html">Corporate - Version 9</a></li>																	<li><a class="dropdown-item" href="index-corporate-10.html"->Corporate - Version 10</a></li>																	<li><a class="dropdown-item" href="index.html#demos"->More...</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Portfolio</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-portfolio.html">Portfolio - Version 1</a></li>																	<li><a class="dropdown-item" href="index-portfolio-2.html">Portfolio - Version 2</a></li>																	<li><a class="dropdown-item" href="index-portfolio-3.html">Portfolio - Version 3</a></li>																	<li><a class="dropdown-item" href="index-portfolio-4.html">Portfolio - Version 4</a></li>																	<li><a class="dropdown-item" href="index-portfolio-5.html">Portfolio - Version 5</a></li>																</ul>															</li>																	<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Blog</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-blog.html">Blog - Version 1</a></li>																	<li><a class="dropdown-item" href="index-blog-2.html">Blog - Version 2</a></li>																	<li><a class="dropdown-item" href="index-blog-3.html">Blog - Version 3</a></li>																	<li><a class="dropdown-item" href="index-blog-4.html">Blog - Version 4</a></li>																	<li><a class="dropdown-item" href="index-blog-5.html">Blog - Version 5</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">One Page</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-one-page.html">One Page Original</a></li>																</ul>															</li>														</ul>													</li>													<li class="dropdown dropdown-mega">														<a class="dropdown-item dropdown-toggle active" href="elements.html">															Elements														</a>														<ul class="dropdown-menu">															<li>																<div class="dropdown-mega-content">																	<div class="row">																		<div class="col-lg-3">																			<span class="dropdown-mega-sub-title">Elements 1</span>																			<ul class="dropdown-mega-sub-nav">																				<li><a class="dropdown-item" href="elements-accordions.html">Accordions</a></li>																				<li><a class="dropdown-item" href="elements-toggles.html">Toggles</a></li>																				<li><a class="dropdown-item" href="elements-tabs.html">Tabs</a></li>																				<li><a class="dropdown-item" href="elements-icons.html">Icons</a></li>																				<li><a class="dropdown-item" href="elements-icon-boxes.html">Icon Boxes</a></li>																				<li><a class="dropdown-item" href="elements-carousels.html">Carousels</a></li>																				<li><a class="dropdown-item" href="elements-modals.html">Modals</a></li>																				<li><a class="dropdown-item" href="elements-lightboxes.html">Lightboxes</a></li>																				<li><a class="dropdown-item" href="elements-word-rotator.html">Word Rotator</a></li>																				<li><a class="dropdown-item" href="elements-before-after.html">Before / After</a></li>																				<li><a class="dropdown-item" href="elements-360-image-viewer.html">360º Image Viewer</a></li>																				<li><a class="dropdown-item" href="elements-random-images.html">Random Images</a></li>																			</ul>																		</div>																		<div class="col-lg-3">																			<span class="dropdown-mega-sub-title">Elements 2</span>																			<ul class="dropdown-mega-sub-nav">																				<li><a class="dropdown-item" href="elements-buttons.html">Buttons</a></li>																				<li><a class="dropdown-item" href="elements-badges.html">Badges</a></li>																				<li><a class="dropdown-item" href="elements-lists.html">Lists</a></li>																				<li><a class="dropdown-item" href="elements-cards.html">Cards</a></li>																				<li><a class="dropdown-item" href="elements-image-gallery.html">Image Gallery</a></li>																				<li><a class="dropdown-item" href="elements-image-frames.html">Image Frames</a></li>																				<li><a class="dropdown-item" href="elements-image-hotspots.html">Image Hotspots</a></li>																				<li><a class="dropdown-item" href="elements-testimonials.html">Testimonials</a></li>																				<li><a class="dropdown-item" href="elements-blockquotes.html">Blockquotes</a></li>																											<li><a class="dropdown-item" href="elements-sticky-elements.html">Sticky Elements</a></li>																				<li><a class="dropdown-item" href="elements-shape-dividers.html">Shape Dividers</a></li>																			</ul>																		</div>																		<div class="col-lg-3">																			<span class="dropdown-mega-sub-title">Elements 3</span>																			<ul class="dropdown-mega-sub-nav">																				<li><a class="dropdown-item" href="elements-typography.html">Typography</a></li>																				<li><a class="dropdown-item" href="elements-call-to-action.html">Call to Action</a></li>																				<li><a class="dropdown-item" href="elements-pricing-tables.html">Pricing Tables</a></li>																				<li><a class="dropdown-item" href="elements-tables.html">Tables</a></li>																				<li><a class="dropdown-item" href="elements-progressbars.html">Progress Bars</a></li>																				<li><a class="dropdown-item" href="elements-process.html">Process</a></li>																				<li><a class="dropdown-item" href="elements-counters.html">Counters</a></li>																				<li><a class="dropdown-item" href="elements-countdowns.html">Countdowns</a></li>																				<li><a class="dropdown-item" href="elements-sections-parallax.html">Sections &amp; Parallax</a></li>																				<li><a class="dropdown-item" href="elements-tooltips-popovers.html">Tooltips &amp; Popovers</a></li>																				<li><a class="dropdown-item" href="elements-read-more.html">Read More</a></li>																										</ul>																		</div>																		<div class="col-lg-3">																			<span class="dropdown-mega-sub-title">Elements 4</span>																			<ul class="dropdown-mega-sub-nav">																				<li><a class="dropdown-item" href="elements-headings.html">Headings</a></li>																				<li><a class="dropdown-item" href="elements-dividers.html">Dividers</a></li>																				<li><a class="dropdown-item" href="elements-animations.html">Animations</a></li>																				<li><a class="dropdown-item" href="elements-medias.html">Medias</a></li>																				<li><a class="dropdown-item" href="elements-maps.html">Maps</a></li>																				<li><a class="dropdown-item" href="elements-arrows.html">Arrows</a></li>																				<li><a class="dropdown-item" href="elements-star-ratings.html">Star Ratings</a></li>																				<li><a class="dropdown-item" href="elements-alerts.html">Alerts</a></li>																				<li><a class="dropdown-item" href="elements-posts.html">Posts</a></li>																				<li><a class="dropdown-item" href="elements-forms.html">Forms</a></li>																				<li><a class="dropdown-item" href="elements-cascading-images.html">Cascading Images</a></li>																			</ul>																		</div>																	</div>																</div>															</li>														</ul>													</li>													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="#">															Features														</a>														<ul class="dropdown-menu">															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Headers</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-headers-overview.html">Overview</a></li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Classic</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-classic.html">Classic</a></li>																			<li><a class="dropdown-item" href="feature-headers-classic-language-dropdown.html">Classic + Language Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-headers-classic-big-logo.html">Classic + Big Logo</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Flat</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-flat.html">Flat</a></li>																			<li><a class="dropdown-item" href="feature-headers-flat-top-bar.html">Flat + Top Bar</a></li>																			<li><a class="dropdown-item" href="feature-headers-flat-top-bar-top-borders.html">Flat + Top Bar + Top Border</a></li>																			<li><a class="dropdown-item" href="feature-headers-flat-colored-top-bar.html">Flat + Colored Top Bar</a></li>																			<li><a class="dropdown-item" href="feature-headers-flat-borders.html">Flat + Borders</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Center</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-center.html">Center</a></li>																			<li><a class="dropdown-item" href="feature-headers-center-double-navs.html">Center + Double Navs</a></li>																			<li><a class="dropdown-item" href="feature-headers-center-nav-buttons.html">Center + Nav + Buttons</a></li>																			<li><a class="dropdown-item" href="feature-headers-center-below-slider.html">Center Below Slider</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Floating</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-floating-bar.html">Floating Bar</a></li>																			<li><a class="dropdown-item" href="feature-headers-floating-icons.html">Floating Icons</a></li>																		</ul>																	</li>																	<li><a class="dropdown-item" href="feature-headers-below-slider.html">Below Slider</a></li>																	<li><a class="dropdown-item" href="feature-headers-full-video.html">Full Video</a></li>																	<li><a class="dropdown-item" href="feature-headers-narrow.html">Narrow</a></li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Sticky</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-sticky-shrink.html">Sticky Shrink</a></li>																			<li><a class="dropdown-item" href="feature-headers-sticky-scroll-up.html">Sticky Scroll Up</a></li>																			<li><a class="dropdown-item" href="feature-headers-sticky-static.html">Sticky Static</a></li>																			<li><a class="dropdown-item" href="feature-headers-sticky-change-logo.html">Sticky Change Logo</a></li>																			<li><a class="dropdown-item" href="feature-headers-sticky-reveal.html">Sticky Reveal</a></li>																		</ul>																	</li>																					<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Transparent</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-transparent-light.html">Transparent Light</a></li>																			<li><a class="dropdown-item" href="feature-headers-transparent-dark.html">Transparent Dark</a></li>																			<li><a class="dropdown-item" href="feature-headers-transparent-light-bottom-border.html">Transparent Light + Bottom Border</a></li>																			<li><a class="dropdown-item" href="feature-headers-transparent-dark-bottom-border.html">Transparent Dark + Bottom Border</a></li>																			<li><a class="dropdown-item" href="feature-headers-transparent-bottom-slider.html">Transparent Bottom Slider</a></li>																			<li><a class="dropdown-item" href="feature-headers-semi-transparent-light.html">Semi Transparent Light</a></li>																			<li><a class="dropdown-item" href="feature-headers-semi-transparent-dark.html">Semi Transparent Dark</a></li>																			<li><a class="dropdown-item" href="feature-headers-semi-transparent-bottom-slider.html">Semi Transparent Bottom Slider</a></li>																			<li><a class="dropdown-item" href="feature-headers-semi-transparent-top-bar-borders.html">Semi Transparent + Top Bar + Borders</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Full Width</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-full-width.html">Full Width</a></li>																			<li><a class="dropdown-item" href="feature-headers-full-width-borders.html">Full Width + Borders</a></li>																			<li><a class="dropdown-item" href="feature-headers-full-width-transparent-light.html">Full Width Transparent Light</a></li>																			<li><a class="dropdown-item" href="feature-headers-full-width-transparent-dark.html">Full Width Transparent Dark</a></li>																			<li><a class="dropdown-item" href="feature-headers-full-width-semi-transparent-light.html">Full Width Semi Transparent Light</a></li>																			<li><a class="dropdown-item" href="feature-headers-full-width-semi-transparent-dark.html">Full Width Semi Transparent Dark</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Navbar</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-navbar.html">Navbar</a></li>																			<li><a class="dropdown-item" href="feature-headers-navbar-full.html">Navbar Full</a></li>																			<li><a class="dropdown-item" href="feature-headers-navbar-pills.html">Navbar Pills</a></li>																			<li><a class="dropdown-item" href="feature-headers-navbar-divisors.html">Navbar Divisors</a></li>																			<li><a class="dropdown-item" href="feature-headers-navbar-icons-search.html">Nav Bar + Icons + Search</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Side Header</a>																		<ul class="dropdown-menu">																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Side Header Left</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-headers-side-header-left-dropdown.html">Dropdown</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-left-expand.html">Expand</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-left-columns.html">Columns</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-left-slide.html">Slide</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-left-semi-transparent.html">Semi Transparent</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-left-dark.html">Dark</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Side Header Right</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-headers-side-header-right-dropdown.html">Dropdown</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-right-expand.html">Expand</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-right-columns.html">Columns</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-right-slide.html">Slide</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-right-semi-transparent.html">Semi Transparent</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-right-dark.html">Dark</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Side Header Offcanvas</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-headers-side-header-offcanvas-push.html">Push</a></li>																					<li><a class="dropdown-item" href="feature-headers-side-header-offcanvas-slide.html">Slide</a></li>																				</ul>																			</li>																			<li><a class="dropdown-item" href="feature-headers-side-header-narrow-bar.html">Side Header Narrow Bar</a></li>																		</ul>																	</li>																	<li><a class="dropdown-item" href="feature-headers-sign-in-sign-up.html">Sign In / Sign Up</a></li>																	<li><a class="dropdown-item" href="feature-headers-logged.html">Logged</a></li>																	<li><a class="dropdown-item" href="feature-headers-mini-cart.html">Mini Cart</a></li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Search Styles</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-search-simple-input.html">Simple Input</a></li>																			<li><a class="dropdown-item" href="feature-headers-search-simple-input-reveal.html">Simple Input Reveal</a></li>																			<li><a class="dropdown-item" href="feature-headers-search-dropdown.html">Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-headers-search-big-input-hidden.html">Big Input Hidden</a></li>																			<li><a class="dropdown-item" href="feature-headers-search-full-screen.html">Full Screen</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Extra</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-headers-extra-big-icon.html">Big Icon</a></li>																			<li><a class="dropdown-item" href="feature-headers-extra-big-icons-top.html">Big Icons Top</a></li>																			<li><a class="dropdown-item" href="feature-headers-extra-button.html">Button</a></li>																			<li><a class="dropdown-item" href="feature-headers-extra-background-color.html">Background Color</a></li>																		</ul>																	</li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Navigations</a>																<ul class="dropdown-menu">																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Pills</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-pills.html">Pills</a></li>																			<li><a class="dropdown-item" href="feature-navigations-pills-arrows.html">Pills + Arrows</a></li>																			<li><a class="dropdown-item" href="feature-navigations-pills-dark-text.html">Pills Dark Text</a></li>																			<li><a class="dropdown-item" href="feature-navigations-pills-color-dropdown.html">Pills Color Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-navigations-pills-square.html">Pills Square</a></li>																			<li><a class="dropdown-item" href="feature-navigations-pills-rounded.html">Pills Rounded</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Stripes</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-stripe.html">Stripe</a></li>																			<li><a class="dropdown-item" href="feature-navigations-stripe-dark-text.html">Stripe Dark Text</a></li>																			<li><a class="dropdown-item" href="feature-navigations-stripe-color-dropdown.html">Stripe Color Dropdown</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Hover Effects</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-hover-top-line.html">Top Line</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-top-line-animated.html">Top Line Animated</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-top-line-color-dropdown.html">Top Line Color Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-bottom-line.html">Bottom Line</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-bottom-line-animated.html">Bottom Line Animated</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-slide.html">Slide</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-sub-title.html">Sub Title</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hover-line-under-text.html">Line Under Text</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Vertical</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-vertical-dropdown.html">Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-navigations-vertical-expand.html">Expand</a></li>																			<li><a class="dropdown-item" href="feature-navigations-vertical-columns.html">Columns</a></li>																			<li><a class="dropdown-item" href="feature-navigations-vertical-slide.html">Slide</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Hamburguer</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-hamburguer-sidebar.html">Sidebar</a></li>																			<li><a class="dropdown-item" href="feature-navigations-hamburguer-overlay.html">Overlay</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Dropdown Styles</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-dark.html">Dark</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-light.html">Light</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-colors.html">Colors</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-top-line.html">Top Line</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-square.html">Square</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-arrow.html">Arrow Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-arrow-center.html">Arrow Center Dropdown</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-modern-light.html">Modern Light</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-modern-dark.html">Modern Dark</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Dropdown Effects</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-no-effect.html">No Effect</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-opacity.html">Opacity</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-move-to-top.html">Move To Top</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-move-to-bottom.html">Move To Bottom</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-move-to-right.html">Move To Right</a></li>																			<li><a class="dropdown-item" href="feature-navigations-dropdowns-effect-move-to-left.html">Move To Left</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Font Styles</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-font-small.html">Small</a></li>																			<li><a class="dropdown-item" href="feature-navigations-font-medium.html">Medium</a></li>																			<li><a class="dropdown-item" href="feature-navigations-font-large.html">Large</a></li>																			<li><a class="dropdown-item" href="feature-navigations-font-alternative.html">Alternative</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Icons</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-navigations-icons.html">Icons</a></li>																			<li><a class="dropdown-item" href="feature-navigations-icons-float-icons.html">Float Icons</a></li>																		</ul>																	</li>																	<li><a class="dropdown-item" href="feature-navigations-sub-title.html">Sub Title</a></li>																	<li><a class="dropdown-item" href="feature-navigations-divisors.html">Divisors</a></li>																	<li><a class="dropdown-item" href="feature-navigations-logo-between.html">Logo Between</a></li>																	<li><a class="dropdown-item" href="feature-navigations-one-page.html">One Page Nav</a></li>																	<li><a class="dropdown-item" href="feature-navigations-click-to-open.html">Click To Open</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Page Headers</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-page-headers-overview.html">Overview</a></li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Classic</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-page-headers-classic-small.html">Small</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-classic-medium.html">Medium</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-classic-large.html">Large</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Modern</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-page-headers-modern-small.html">Small</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-modern-medium.html">Medium</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-modern-large.html">Large</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Colors</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-page-headers-colors-primary.html">Primary</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-colors-secondary.html">Secondary</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-colors-tertiary.html">Tertiary</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-colors-quaternary.html">Quaternary</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-colors-light.html">Light</a></li>																							<li><a class="dropdown-item" href="feature-page-headers-colors-dark.html">Dark</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Title Position</a>																		<ul class="dropdown-menu">																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Left</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-page-headers-title-position-left-small.html">Small</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-left-medium.html">Medium</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-left-large.html">Large</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Right</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-page-headers-title-position-right-small.html">Small</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-right-medium.html">Medium</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-right-large.html">Large</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Center</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-page-headers-title-position-center-small.html">Small</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-center-medium.html">Medium</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-title-position-center-large.html">Large</a></li>																				</ul>																			</li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Background</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-page-headers-background-fixed.html">Fixed</a></li>																					<li><a class="dropdown-item" href="feature-page-headers-background-parallax.html">Parallax</a></li>																			<li><a class="dropdown-item" href="feature-page-headers-background-video.html">Video</a></li>																						<li><a class="dropdown-item" href="feature-page-headers-background-transparent-header.html">Transparent Header</a></li>																						<li><a class="dropdown-item" href="feature-page-headers-background-pattern.html">Pattern</a></li>																						<li><a class="dropdown-item" href="feature-page-headers-background-overlay.html">Overlay</a></li>																						<li><a class="dropdown-item" href="feature-page-headers-background-clean.html">Clean (No Background)</a></li>																			</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Extra</a>																		<ul class="dropdown-menu">																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Breadcrumb</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-page-headers-extra-breadcrumb-outside.html">Outside</a></li>																									<li><a class="dropdown-item" href="feature-page-headers-extra-breadcrumb-dark.html">Dark</a></li>																							</ul>																			</li>																			<li><a class="dropdown-item" href="feature-page-headers-extra-scroll-to-content.html">Scroll to Content</a></li>																						<li><a class="dropdown-item" href="feature-page-headers-extra-full-width.html">Full Width</a></li>																		</ul>																	</li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Footers</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-footers-overview.html">Overview</a></li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Classic</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-classic.html#footer">Classic</a></li>																			<li><a class="dropdown-item" href="feature-footers-classic-advanced.html#footer">Advanced</a></li>																			<li><a class="dropdown-item" href="feature-footers-classic-compact.html#footer">Compact</a></li>																			<li><a class="dropdown-item" href="feature-footers-classic-simple.html#footer">Simple</a></li>																			<li><a class="dropdown-item" href="feature-footers-classic-locations.html#footer">Locations</a></li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Copyright</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-classic-copyright-light.html#footer">Light</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-copyright-dark.html#footer">Dark</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-copyright-social-icons.html#footer">Social Icons</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Colors</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-classic-colors-primary.html#footer">Primary</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-colors-secondary.html#footer">Secondary</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-colors-tertiary.html#footer">Tertiary</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-colors-quaternary.html#footer			">Quaternary</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-colors-light.html#footer">Light</a></li>																					<li><a class="dropdown-item" href="feature-footers-classic-colors-light-simple.html#footer">Light Simple</a></li>																				</ul>																			</li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Modern</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-modern.html#footer">Modern</a></li>																			<li><a class="dropdown-item" href="feature-footers-modern-font-style-alternative.html#footer">Font Style Alternative</a></li>																			<li><a class="dropdown-item" href="feature-footers-modern-clean.html#footer">Clean</a></li>																				<li><a class="dropdown-item" href="feature-footers-modern-useful-links.html#footer">Useful Links</a></li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Background</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-modern-background-image-simple.html#footer">Image Simple</a></li>																					<li><a class="dropdown-item" href="feature-footers-modern-background-image-advanced.html#footer">Image Advanced</a></li>																					<li><a class="dropdown-item" href="feature-footers-modern-background-video-simple.html#footer">Video Simple</a></li>																				</ul>																			</li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Call to Action</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-modern-call-to-action-button.html#footer">Button</a></li>																					<li><a class="dropdown-item" href="feature-footers-modern-call-to-action-simple.html#footer">Simple</a></li>																				</ul>																			</li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Blog</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-blog-classic.html#footer">Blog Classic</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">eCommerce</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-ecommerce-classic.html#footer">eCommerce Classic</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Contact Form</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-contact-form-classic.html#footer">Classic</a></li>																			<li><a class="dropdown-item" href="feature-footers-contact-form-above-the-map.html#footer">Above the Map</a></li>																			<li><a class="dropdown-item" href="feature-footers-contact-form-center.html#footer">Center</a></li>																			<li><a class="dropdown-item" href="feature-footers-contact-form-columns.html#footer">Columns</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Map</a>																		<ul class="dropdown-menu">																			<li><a class="dropdown-item" href="feature-footers-map-hidden.html#footer">Hidden Map</a></li> 																			<li><a class="dropdown-item" href="feature-footers-map-full-width.html#footer">Full Width</a></li>																		</ul>																	</li>																	<li class="dropdown-submenu">																		<a class="dropdown-item" href="#">Extra</a>																		<ul class="dropdown-menu">																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Simple</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-extra-top-social-icons.html#footer">Top Social Icons</a></li>																					<li><a class="dropdown-item" href="feature-footers-extra-big-icons.html#footer">Big Icons</a></li>																				</ul>																			</li>																			<li><a class="dropdown-item" href="feature-footers-extra-recent-work.html#footer">Recent Work</a></li>																			<li><a class="dropdown-item" href="feature-footers-extra-reveal.html#footeranchor">Reveal</a></li>																			<li><a class="dropdown-item" href="feature-footers-extra-instagram.html#footer">Instagram</a></li>																			<li class="dropdown-submenu">																				<a class="dropdown-item" href="#">Full Width</a>																				<ul class="dropdown-menu">																					<li><a class="dropdown-item" href="feature-footers-extra-full-width-light.html#footer">Simple Light</a></li>																					<li><a class="dropdown-item" href="feature-footers-extra-full-width-dark.html#footer">Simple Dark</a></li>																				</ul>																			</li>																		</ul>																	</li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Admin Extension <span class="tip tip-dark">hot</span><em class="not-included">(Not Included)</em></a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-admin-forms-basic.html">Forms Basic</a></li>																	<li><a class="dropdown-item" href="feature-admin-forms-advanced.html">Forms Advanced</a></li>																	<li><a class="dropdown-item" href="feature-admin-forms-wizard.html">Forms Wizard</a></li>																	<li><a class="dropdown-item" href="feature-admin-forms-code-editor.html">Code Editor</a></li>																	<li><a class="dropdown-item" href="feature-admin-tables-advanced.html">Tables Advanced</a></li>																	<li><a class="dropdown-item" href="feature-admin-tables-responsive.html">Tables Responsive</a></li>																	<li><a class="dropdown-item" href="feature-admin-tables-editable.html">Tables Editable</a></li>																	<li><a class="dropdown-item" href="feature-admin-tables-ajax.html">Tables Ajax</a></li>																	<li><a class="dropdown-item" href="feature-admin-charts.html">Charts</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Sliders</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="index-slider-revolution.html">Revolution Slider</a></li>																	<li><a class="dropdown-item" href="index-slider-owl.html">Owl Slider</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Layout Options</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-layout-boxed.html">Boxed</a></li>																	<li><a class="dropdown-item" href="feature-layout-dark.html">Dark</a></li>																	<li><a class="dropdown-item" href="feature-layout-rtl.html">RTL</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Extra</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="feature-cursor-effect.html">Cursor Effect</a></li>																	<li><a class="dropdown-item" href="feature-grid-system.html">Grid System</a></li>																	<li><a class="dropdown-item" href="feature-lazy-load.html">Lazy Load</a></li>																	<li><a class="dropdown-item" href="feature-page-loading.html">Page Loading</a></li>																	<li><a class="dropdown-item" href="feature-page-transition.html">Page Transition</a></li>																	<li><a class="dropdown-item" href="feature-side-panel.html">Side Panel</a></li>																</ul>															</li>															<li>																<a class="dropdown-item" href="feature-gdpr.html">GDPR</a>															</li>														</ul>													</li>													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="#">															Pages														</a>														<ul class="dropdown-menu">															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Contact Us</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="contact-us-advanced.php">Contact Us - Advanced</a></li>																	<li><a class="dropdown-item" href="contact-us.html">Contact Us - Basic</a></li>																	<li><a class="dropdown-item" href="contact-us-recaptcha.html">Contact Us - Recaptcha</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">About Us</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="about-us-advanced.html">About Us - Advanced</a></li>																	<li><a class="dropdown-item" href="about-us.html">About Us - Basic</a></li>																	<li><a class="dropdown-item" href="about-me.html">About Me</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Layouts</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="page-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="page-left-sidebar.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="page-right-sidebar.html">Right Sidebar</a></li>																	<li><a class="dropdown-item" href="page-left-and-right-sidebars.html">Left and Right Sidebars</a></li>																	<li><a class="dropdown-item" href="page-sticky-sidebar.html">Sticky Sidebar</a></li>																	<li><a class="dropdown-item" href="page-secondary-navbar.html">Secondary Navbar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Extra</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="page-404.html">404 Error</a></li>																	<li><a class="dropdown-item" href="page-500.html">500 Error</a></li>																	<li><a class="dropdown-item" href="page-coming-soon.html">Coming Soon</a></li>																	<li><a class="dropdown-item" href="page-maintenance-mode.html">Maintenance Mode</a></li>																	<li><a class="dropdown-item" href="page-search-results.html">Search Results</a></li>																	<li><a class="dropdown-item" href="sitemap.html">Sitemap</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Team</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="page-team-advanced.html">Team - Advanced</a></li>																	<li><a class="dropdown-item" href="page-team.html">Team - Basic</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Services</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="page-services.html">Services - Version 1</a></li>																	<li><a class="dropdown-item" href="page-services-2.html">Services - Version 2</a></li>																	<li><a class="dropdown-item" href="page-services-3.html">Services - Version 3</a></li>																</ul>															</li>															<li><a class="dropdown-item" href="page-custom-header.html">Custom Header</a></li>															<li><a class="dropdown-item" href="page-careers.html">Careers</a></li>															<li><a class="dropdown-item" href="page-faq.html">FAQ</a></li>															<li><a class="dropdown-item" href="page-login.html">Login / Register</a></li>															<li><a class="dropdown-item" href="page-user-profile.html">User Profile</a></li>														</ul>													</li>													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="#">															Portfolio														</a>														<ul class="dropdown-menu">															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Single Project</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-single-wide-slider.html">Wide Slider</a></li>																	<li><a class="dropdown-item" href="portfolio-single-small-slider.html">Small Slider</a></li>																	<li><a class="dropdown-item" href="portfolio-single-full-width-slider.html">Full Width Slider</a></li>																	<li><a class="dropdown-item" href="portfolio-single-gallery.html">Gallery</a></li>																	<li><a class="dropdown-item" href="portfolio-single-carousel.html">Carousel</a></li>																	<li><a class="dropdown-item" href="portfolio-single-medias.html">Medias</a></li>																	<li><a class="dropdown-item" href="portfolio-single-full-width-video.html">Full Width Video</a></li>																	<li><a class="dropdown-item" href="portfolio-single-masonry-images.html">Masonry Images</a></li>																	<li><a class="dropdown-item" href="portfolio-single-left-sidebar.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="portfolio-single-right-sidebar.html">Right Sidebar</a></li>																	<li><a class="dropdown-item" href="portfolio-single-left-and-right-sidebars.html">Left and Right Sidebars</a></li>																	<li><a class="dropdown-item" href="portfolio-single-sticky-sidebar.html">Sticky Sidebar</a></li>																	<li><a class="dropdown-item" href="portfolio-single-extended.html">Extended</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Grid Layouts</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-grid-1-column.html">1 Column</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-2-columns.html">2 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-3-columns.html">3 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-4-columns.html">4 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-5-columns.html">5 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-6-columns.html">6 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-no-margins.html">No Margins</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-full-width-no-margins.html">Full Width No Margins</a></li>																	<li><a class="dropdown-item" href="portfolio-grid-1-column-title-and-description.html">Title and Description</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Masonry Layouts</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-masonry-2-columns.html">2 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-3-columns.html">3 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-4-columns.html">4 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-5-columns.html">5 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-6-columns.html">6 Columns</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-no-margins.html">No Margins</a></li>																	<li><a class="dropdown-item" href="portfolio-masonry-full-width.html">Full Width</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Sidebar Layouts</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="portfolio-sidebar-right.html">Right Sidebar</a></li>																	<li><a class="dropdown-item" href="portfolio-sidebar-left-and-right.html">Left and Right Sidebars</a></li>																	<li><a class="dropdown-item" href="portfolio-sidebar-sticky.html">Sticky Sidebar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Ajax</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-ajax-page.html">Ajax on Page</a></li>																	<li><a class="dropdown-item" href="portfolio-ajax-modal.html">Ajax on Modal</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Extra</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="portfolio-extra-timeline.html">Timeline</a></li>																	<li><a class="dropdown-item" href="portfolio-extra-lightbox.html">Lightbox</a></li>																	<li><a class="dropdown-item" href="portfolio-extra-load-more.html">Load More</a></li>																	<li><a class="dropdown-item" href="portfolio-extra-infinite-scroll.html">Infinite Scroll</a></li>																	<li><a class="dropdown-item" href="portfolio-extra-pagination.html">Pagination</a></li>																	<li><a class="dropdown-item" href="portfolio-extra-combination-filters.html">Combination Filters</a></li>																</ul>															</li>														</ul>													</li>													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="#">															Blog														</a>														<ul class="dropdown-menu">															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Large Image</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-large-image-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="blog-large-image-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-large-image-sidebar-right.html">Right Sidebar </a></li>																	<li><a class="dropdown-item" href="blog-large-image-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Medium Image</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-medium-image-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-medium-image-sidebar-right.html">Right Sidebar </a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Grid</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-grid-4-columns.html">4 Columns</a></li>																	<li><a class="dropdown-item" href="blog-grid-3-columns.html">3 Columns</a></li>																	<li><a class="dropdown-item" href="blog-grid-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="blog-grid-no-margins.html">No Margins</a></li>																	<li><a class="dropdown-item" href="blog-grid-no-margins-full-width.html">No Margins Full Width</a></li>																	<li><a class="dropdown-item" href="blog-grid-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-grid-sidebar-right.html">Right Sidebar </a></li>																	<li><a class="dropdown-item" href="blog-grid-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Masonry</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-masonry-4-columns.html">4 Columns</a></li>																	<li><a class="dropdown-item" href="blog-masonry-3-columns.html">3 Columns</a></li>																	<li><a class="dropdown-item" href="blog-masonry-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="blog-masonry-no-margins.html">No Margins</a></li>																	<li><a class="dropdown-item" href="blog-masonry-no-margins-full-width.html">No Margins Full Width</a></li>																	<li><a class="dropdown-item" href="blog-masonry-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-masonry-sidebar-right.html">Right Sidebar </a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Timeline</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-timeline.html">Full Width</a></li>																	<li><a class="dropdown-item" href="blog-timeline-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-timeline-sidebar-right.html">Right Sidebar </a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Single Post</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-post.html">Full Width</a></li>																	<li><a class="dropdown-item" href="blog-post-slider-gallery.html">Slider Gallery</a></li>																	<li><a class="dropdown-item" href="blog-post-image-gallery.html">Image Gallery</a></li>																	<li><a class="dropdown-item" href="blog-post-embedded-video.html">Embedded Video</a></li>																	<li><a class="dropdown-item" href="blog-post-html5-video.html">HTML5 Video</a></li>																	<li><a class="dropdown-item" href="blog-post-blockquote.html">Blockquote</a></li>																	<li><a class="dropdown-item" href="blog-post-link.html">Link</a></li>																	<li><a class="dropdown-item" href="blog-post-embedded-audio.html">Embedded Audio</a></li>																	<li><a class="dropdown-item" href="blog-post-small-image.html">Small Image</a></li>																	<li><a class="dropdown-item" href="blog-post-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="blog-post-sidebar-right.html">Right Sidebar </a></li>																	<li><a class="dropdown-item" href="blog-post-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Post Comments</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="blog-post.html#comments">Default</a></li>																	<li><a class="dropdown-item" href="blog-post-comments-facebook.html#comments">Facebook Comments</a></li>																	<li><a class="dropdown-item" href="blog-post-comments-disqus.html#comments">Disqus Comments</a></li>																</ul>															</li>														</ul>													</li>													<li class="dropdown">														<a class="dropdown-item dropdown-toggle" href="#">															Shop														</a>														<ul class="dropdown-menu">															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">Single Product</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="shop-product-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="shop-product-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="shop-product-sidebar-right.html">Right Sidebar</a></li>																	<li><a class="dropdown-item" href="shop-product-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li><a class="dropdown-item" href="shop-4-columns.html">4 Columns</a></li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">3 Columns</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="shop-3-columns-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="shop-3-columns-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="shop-3-columns-sidebar-right.html">Right Sidebar </a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">2 Columns</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="shop-2-columns-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="shop-2-columns-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="shop-2-columns-sidebar-right.html">Right Sidebar </a></li>																	<li><a class="dropdown-item" href="shop-2-columns-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li class="dropdown-submenu">																<a class="dropdown-item" href="#">1 Column</a>																<ul class="dropdown-menu">																	<li><a class="dropdown-item" href="shop-1-column-full-width.html">Full Width</a></li>																	<li><a class="dropdown-item" href="shop-1-column-sidebar-left.html">Left Sidebar</a></li>																	<li><a class="dropdown-item" href="shop-1-column-sidebar-right.html">Right Sidebar </a></li>																	<li><a class="dropdown-item" href="shop-1-column-sidebar-left-and-right.html">Left and Right Sidebar</a></li>																</ul>															</li>															<li><a class="dropdown-item" href="shop-cart.html">Cart</a></li>															<li><a class="dropdown-item" href="shop-login.html">Login</a></li>															<li><a class="dropdown-item" href="shop-checkout.html">Checkout</a></li>															<li><a class="dropdown-item" href="shop-order-complete.html">Order Complete</a></li>														</ul>													</li>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
									<div class="header-nav-features header-nav-features-light header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">										<div class="header-nav-feature header-nav-features-search d-inline-flex">											<a href="#" class="header-nav-features-toggle text-decoration-none" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>											<div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed" id="headerTopSearchDropdown">												<form role="search" action="page-search-results.html" method="get">													<div class="simple-search input-group">														<input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">														<button class="btn" type="submit">															<i class="fas fa-search header-nav-top-icon text-color-dark"></i>														</button>													</div>												</form>											</div>										</div>										<div class="header-nav-feature header-nav-features-cart d-inline-flex ms-2">											<a href="#" class="header-nav-features-toggle">												<img src="img/icons/icon-cart-light.svg" width="14" alt="" class="header-nav-top-icon-img">												<span class="cart-info">													<span class="cart-qty">1</span>												</span>											</a>											<div class="header-nav-features-dropdown" id="headerTopCartDropdown">												<ol class="mini-products-list">													<li class="item">														<a href="#" title="Camera X1000" class="product-image"><img src="img/products/product-1.jpg" alt="Camera X1000"></a>														<div class="product-details">															<p class="product-name">																<a href="#">Camera X1000 </a>															</p>															<p class="qty-price">																 1X <span class="price">$890</span>															</p>															<a href="#" title="Remove This Item" class="btn-remove"><i class="fas fa-times"></i></a>														</div>													</li>												</ol>												<div class="totals">													<span class="label">Total:</span>													<span class="price-total"><span class="price">$890</span></span>												</div>												<div class="actions">													<a class="btn btn-dark" href="#">View Cart</a>													<a class="btn btn-primary" href="#">Checkout</a>												</div>											</div>										</div>									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div role="main" class="main">
				<section class="section section-concept section-no-border section-dark section-angled section-angled-reverse pt-5 m-0" style="background-image: url(img/landing/header_bg.jpg); background-size: cover; background-position: center; animation-duration: 750ms; animation-delay: 300ms; animation-fill-mode: forwards; min-height: 645px;">
					<div class="section-angled-layer-bottom section-angled-layer-increase-angle bg-light" style="padding: 8rem 0;"></div>
					<div class="container pt-lg-5 mt-5">
						<div class="row pt-3 pb-lg-0 pb-xl-0">
							<div class="col-lg-6 pt-4 mb-5 mb-lg-0">
								<ul class="breadcrumb font-weight-semibold text-4 negative-ls-1">
									<li><a href="index.html">Home</a></li>
									<li class="text-color-primary"><a href="elements.html">Elements</a></li>
									<li class="active text-color-primary">Forms</li>
								</ul>
								<h1 class="font-weight-bold text-10 text-xl-12 line-height-2 mb-3">Forms</h1>
								<p class="font-weight-light opacity-7 pb-2 mb-4">From a simple contact form to a more advanced with Google reCaptcha enabled. Easy to use and configure trough the template files.</p>
								<a href="#examples" data-hash data-hash-offset="100" class="btn btn-gradient-primary font-weight-semi-bold px-4 btn-py-2 text-3">View Examples <i class="fas fa-arrow-down ms-1"></i></a>
								<a href="https://themeforest.net/checkout/from_item/4106987?license=regular&support=bundle_6month&ref=Okler" class="btn btn-light btn-outline btn-outline-thin btn-outline-light-opacity-2 font-weight-semi-bold px-4 btn-py-2 text-3 text-color-light text-color-hover-dark ms-2" target="_blank">Buy Porto <i class="fas fa-external-link-alt ms-1"></i></a>
							</div>
						</div>
					</div>
				</section>
				<div id="examples" class="container py-2">
					<div class="row">
						<div class="col-lg-3 order-2 order-lg-1">
							<aside class="sidebar mt-2 mb-5">								<h5 class="font-weight-semi-bold">Forms Styles</h5>								<ul class="nav nav-list flex-column">									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleDefault">Default</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleWithoutBorders">Without Borders</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleColors">Colors</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleWithIcons">With Icons</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleRoundedBorders">Rounded Borders</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleBottomLine">Bottom Line</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleWithShadow">With Shadow</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsStyleSquaredBorders">Squared Borders</a>									</li>								</ul>							</aside>							<aside class="sidebar mt-2 mb-5">								<h5 class="font-weight-semi-bold">Forms Examples</h5>								<ul class="nav nav-list flex-column">									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesFormControl">Form Control</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesSelect">Select</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesChecksRadios">Checks & Radios</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesRange">Range</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesInputGroup">Input Group</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesFloatingLabels">Floating Labels</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesLayout">Layout</a>									</li>									<li class="nav-item">										<a class="nav-link" href="elements-forms.html#formsExamplesValidation">Validation</a>									</li>								</ul>							</aside>							<aside class="sidebar mt-2">								<h5 class="font-weight-semi-bold">Forms Layouts</h5>								<ul class="nav nav-list flex-column">									<li class="nav-item"><a class="nav-link" href="elements-forms-basic-contact.html">Basic Contact Form</a></li>									<li class="nav-item"><a class="nav-link text-dark active" href="elements-forms-advanced-contact.php">Advanced Contact Form</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-contact-recaptcha-v2.html">Contact Form with Recaptcha v2</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-contact-recaptcha-v3.html">Contact Form with Recaptcha v3</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-login.html">Login</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-signup.html">Sign Up</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-lost-password.html">Lost Password</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-user-profile.html">User Profile</a></li>									<li class="nav-item"><a class="nav-link" href="elements-forms-checkout.html">Checkout</a></li>								</ul>							</aside>
						</div>
						<div class="col-lg-9 order-1 order-lg-2">
							<div class="offset-anchor" id="contact-sent"></div>
							<?php
							if (isset($arrResult)) {
								if($arrResult['response'] == 'success') {
								?>
								<div class="alert alert-success">
									<strong>Success!</strong> Your message has been sent to us.
								</div>
								<?php
								} else if($arrResult['response'] == 'error') {
								?>
								<div class="alert alert-danger">
									<strong>Error!</strong> There was an error sending your message.
									<span class="font-size-xs mt-2 d-block"><?php echo $arrResult['errorMessage'];?></span>
								</div>
								<?php
								} else if($arrResult['response'] == 'captchaError') {
								?>
								<div class="alert alert-danger">
									<strong>Error!</strong> Verification failed.
								</div>
								<?php
								}
							}
							?>
							<div class="overflow-hidden mb-1">
								<h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Contact</strong> Us</h2>
							</div>
							<div class="overflow-hidden mb-4 pb-3">
								<p class="mb-0">Feel free to ask for details, don't save any questions!</p>
							</div>
							<form id="contactFormAdvanced" action="<?php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="true" name="emailSent" id="emailSent">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="required text-2">Full Name</label>
										<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
									</div>
									<div class="form-group col-md-6">
										<label class="required text-2">Email Address</label>
										<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label>Subject</label>
										<select data-msg-required="Please enter the subject." class="form-control" name="subject" id="subject" required>
											<option value="">...</option>
											<option value="Option 1">Option 1</option>
											<option value="Option 2">Option 2</option>
											<option value="Option 3">Option 3</option>
											<option value="Option 4">Option 4</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<p class="mb-2">Checkboxes</p>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option1"> 1
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option2"> 2
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" name="checkboxes[]" type="checkbox" data-msg-required="Please select at least one option." id="inlineCheckbox1" value="option3"> 3
											</label>
										</div>
									</div>
									<div class="form-group col-md-6">
										<p class="mb-2">Radios</p>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio1" value="option1"> 1
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio2" value="option2"> 2
											</label>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="radios" data-msg-required="Please select at least one option." id="inlineRadio3" value="option3"> 3
											</label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label>Attachment</label>
										<input class="d-block" type="file" name="attachment" id="attachment">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-4">
										<label class="required text-2">Message</label>
										<textarea maxlength="5000" data-msg-required="Please enter your message." rows="6" class="form-control" name="message" id="message" required></textarea>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-0">
										<label>Human Verification</label>
									</div>
								</div>
								<div class="form-row pt-2">
									<div class="form-group col-md-4">
										<div class="captcha form-control">
											<div class="captcha-image">
												<?php
												$_SESSION['captcha'] = simple_php_captcha(array(
													'min_length' => 6,
													'max_length' => 6,
													'min_font_size' => 22,
													'max_font_size' => 22,
													'angle_max' => 3
												));
												$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];
												echo '<img id="captcha-image" src="' . "php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
												?>
											</div>
											<div class="captcha-refresh">
												<a href="#" id="refreshCaptcha"><i class="fas fa-sync"></i></a>
											</div>
										</div>
									</div>
									<div class="form-group col-md-8">
										<input type="text" value="" maxlength="6" data-msg-captcha="Wrong verification code." data-msg-required="Please enter the verification code." placeholder="Type the verification code." class="form-control form-control-lg captcha-input" name="captcha" id="captcha" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<hr>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-5">
										<input type="submit" id="contactFormSubmit" value="Send Message" class="btn btn-primary btn-modern pull-right" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<section id="elements" class="section section-height-2 border-0 mt-5 mb-0 pt-5">
					<div class="container py-2">
						<div class="row mt-3 pb-4">
							<div class="col text-center">
								<h2 class="font-weight-bold mb-0">Porto Elements</h2>
								<p class="lead text-4 pt-2 font-weight-normal">Porto comes with several elements options, it's easy to customize<br> and create the content of your website's pages.</p>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-accordions.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-bars"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-bars"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Accordions</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-toggles.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-indent"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-indent"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Toggles</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-tabs.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-columns"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-columns"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Tabs</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-icons.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-check"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-check"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Icons</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-icon-boxes.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-check-circle"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-check-circle"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Icon Boxes</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-carousels.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-ellipsis-h"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-ellipsis-h"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Carousels</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-modals.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-expand"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-expand"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Modals</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-lightboxes.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-clone"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-clone"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Lightboxes</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-buttons.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-minus"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-minus"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Buttons</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-badges.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-stream"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-stream"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Badges</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-lists.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-list-ul"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-list-ul"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Lists</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-cards.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fab fa-buffer"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fab fa-buffer"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Cards</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-image-gallery.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-file-image"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-file-image"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Image Gallery</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-image-frames.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-image"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-image"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Image Frames</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-image-hotspots.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-hand-point-up"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-hand-point-up"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Image Hotspots</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-testimonials.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-comments"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-comments"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Testimonials</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-blockquotes.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-quote-left"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-quote-left"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Blockquotes</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-word-rotator.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fab fa-autoprefixer"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fab fa-autoprefixer"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Word Rotator</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-before-after.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-arrows-alt-h"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-arrows-alt-h"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Before / After</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-typography.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-font"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-font"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Typography</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-call-to-action.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-external-link-alt"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-external-link-alt"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Call to Action</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-pricing-tables.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-dollar-sign"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-dollar-sign"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Pricing Tables</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-tables.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-table"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-table"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Tables</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-progressbars.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-chart-bar"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-chart-bar"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Progress Bars</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-process.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-bullseye"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-bullseye"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Process</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-counters.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-sort-numeric-down"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-sort-numeric-down"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Counters</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-countdowns.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-clock"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-clock"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Countdowns</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-sections-parallax.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-images"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-images"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Sections &amp; Parallax</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-tooltips-popovers.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-comment-alt"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-comment-alt"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Tooltips &amp; Popovers</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-sticky-elements.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-compress"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-compress"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Sticky Elements</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-headings.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-text-height"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-text-height"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Headings</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-dividers.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-align-center"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-align-center"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Dividers</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-animations.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-asterisk"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-asterisk"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Animations</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-medias.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-play-circle"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-play-circle"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Medias</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-maps.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-map"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-map"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Maps</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-arrows.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-arrow-alt-circle-right"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-arrow-alt-circle-right"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Arrows</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-star-ratings.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-star"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-star"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Star Ratings</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-alerts.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-exclamation-triangle"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-exclamation-triangle"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Alerts</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-posts.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-calendar-alt"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-calendar-alt"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Posts</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-forms.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-file-alt"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-file-alt"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Forms</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-360-image-viewer.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-sync-alt"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-sync-alt"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">360º Image Viewer</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-shape-dividers.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-divide"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-divide"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Shape Dividers</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-read-more.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-plus-square"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-plus-square"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Read More</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-cascading-images.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="far fa-images"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="far fa-images"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Cascading Images</span>
											</span>
										</a>
									</div>
								</div>
							</div>
							<div class="col-6 col-sm-4 col-lg-2">
								<div class="featured-boxes featured-boxes-modern-style-2 featured-boxes-modern-style-2-hover-only featured-boxes-modern-style-primary m-0 mb-4 pb-3">
									<div class="featured-box featured-box-no-borders featured-box-box-shadow">
										<a href="elements-random-images.html" class="text-decoration-none">
											<span class="box-content px-1 py-4 text-center d-block">
												<span class="text-primary text-8 position-relative top-3 mt-3"><i class="fas fa-random"></i></span>
												<span class="elements-list-shadow-icon text-default"><i class="fas fa-random"></i></span>
												<span class="font-weight-bold text-uppercase text-1 negative-ls-1 d-block text-dark pt-2">Random Images</span>
											</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<section class="section section-dark section-angled border-0 lazyload pb-0 m-0" style="background-size: 100%; background-position: top;" data-bg-src="img/landing/build_bg.jpg">
					<div class="section-angled-layer-top section-angled-layer-increase-angle bg-color-light-scale-1" style="padding: 4rem 0;"></div>
					<div class="container text-center my-5 py-5">
						<h2 class="font-weight-bold line-height-3 text-12 mt-5 mb-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="250" data-appear-animation-duration="750">Build your website with Porto</h2>
						<h4 class="font-weight-bold text-9 mb-4 pb-2 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="500" data-appear-animation-duration="750">Purchase now. Only <span class="highlighted-word highlighted-word-animation-1 highlighted-word-animation-1-no-rotate highlighted-word-animation-1 highlighted-word-animation-1-light alternative-font-4 font-weight-extra-bold text-4 light appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="800" data-appear-animation-duration="750">$16!</span></h4>
						<div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="900" data-appear-animation-duration="750">
							<h4 class="font-weight-light text-4 col-lg-6 px-0 offset-lg-3 fw-400 mb-5 opacity-8">Porto Template has been available on ThemeForest since 2013 and is one of the top sellers with more than 40K+ sales.</h4>
						</div>
						<div class="col-12 px-0 pb-2 mb-4">
							<div class="row flex-column flex-lg-row justify-content-center">
								<div class="col-auto">
									<h5 class="font-weight-semibold text-4 positive-ls-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="1100" data-appear-animation-duration="750"><i class="fa fa-check"></i> SUPER HIGH PERFORMANCE</h5>
								</div>
								<div class="col-auto mx-5 my-2 my-lg-0">
									<h5 class="font-weight-semibold text-4 positive-ls-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="1400" data-appear-animation-duration="750"><i class="fa fa-check"></i> Strict Coding Standards</h5>
								</div>
								<div class="col-auto">
									<h5 class="font-weight-semibold text-4 positive-ls-2 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="1600" data-appear-animation-duration="750"><i class="fa fa-check"></i> Free Lifetime Updates</h5>
								</div>
							</div>
						</div>
						<a href="https://themeforest.net/checkout/from_item/4106987?license=regular&support=bundle_6month&ref=Okler" class="btn btn-dark btn-modern btn-rounded px-5 btn-py-3 text-4 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="1800" data-appear-animation-duration="750" target="_blank">BUY PORTO NOW</a>
					</div>
					<div class="row border border-start-0 border-bottom-0 border-end-0 border-color-light-2">
						<div class="col-6 col-md-3 text-center d-flex align-items-center justify-content-center py-4">
							<a href="http://www.okler.net/" class="text-decoration-none" target="_blank">
								<div class="icon-box">
									<i class="icon-bg icon-menu-1"></i>
									<h4 class="text-4 mb-0">Customer Showcase<small class="d-block p-relative bottom-4 opacity-6 ls-0">(SAMPLE SITES)</small></h4>
								</div>
							</a>
						</div>
						<div class="col-6 col-md-3 text-center divider-left-border border-color-light-2 d-flex align-items-center justify-content-center py-4">
							<a href="http://www.okler.net/open-a-ticket/" class="text-decoration-none" target="_blank">
								<div class="icon-box">
									<i class="icon-bg icon-menu-2"></i>
									<h4 class="text-4 mb-0">Support Center</h4>
								</div>
							</a>
						</div>
						<div class="col-6 col-md-3 text-center divider-left-border border-color-light-2 d-flex align-items-center justify-content-center py-4">
							<a href="http://www.okler.net/" class="text-decoration-none" target="_blank">
								<div class="icon-box">
									<i class="icon-bg icon-menu-3"></i>
									<h4 class="text-4 mb-0">Online Documentation</h4>
								</div>
							</a>
						</div>
						<div class="col-6 col-md-3 text-center divider-left-border border-color-light-2 d-flex align-items-center justify-content-center py-4 opacity-5">
							<a href="http://www.okler.net/" class="text-decoration-none" target="_blank">
								<div class="icon-box">
									<i class="icon-bg icon-menu-4"></i>
									<h4 class="font-weight-500 text-color-light line-height-1 text-4 mt-0 mb-2">Video Tutorials<br><span class="text-2 d-block pt-1">(coming soon)</span></h4>
								</div>
							</a>
						</div>
					</div>
				</section>
				<section class="section bg-color-dark-scale-2 border-0 m-0 py-4">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="list list-unstyled list-inline d-flex align-items-center justify-content-center flex-column flex-lg-row mb-0">
									<li class="list-inline-item custom-text-color-1 color-inherit mb-lg-0 text-2 pe-2">Porto Versions:</li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-admin-responsive-html5-template/8539472?s_rank=2" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">ADMIN HTML</a></li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-ecommerce-shop-template/22685562" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">SHOP HTML</a></li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-responsive-wordpress-ecommerce-theme/9207399" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">WORDPRESS</a></li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-ultimate-responsive-magento-theme/9725864" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">MAGENTO</a></li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-ultimate-responsive-shopify-theme/19162959" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">SHOPIFY</a></li>
									<li class="list-inline-item mb-lg-0"><a href="https://themeforest.net/item/porto-responsive-drupal-7-theme/5219986" class="btn btn-dark btn-modern btn-rounded btn-px-4 py-3 border-0" target="_blank">DRUPAL</a></li>
								</ul>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer id="footer" class="bg-color-dark-scale-2 border border-end-0 border-start-0 border-bottom-0 border-color-light-3 mt-0">
				<div class="container text-center my-3 py-5">
					<a href="index.html">
						<img src="img/lazy.png" data-src="img/landing/logo.png" width="102" height="45" class="mb-4 appear-animation lazyload" alt="Porto" data-appear-animation="fadeIn" data-appear-animation-delay="300">
					</a>
					<p class="text-4 mb-4">Porto is exclusively available on themeforest.net by <a href="https://themeforest.net/user/okler/" class="text-color-light" target="_blank">Okler.</a></p>
					<ul class="social-icons social-icons-big social-icons-dark-2">
						<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
						<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
						<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
					</ul>
				</div>
				<div class="copyright bg-dark py-4">
					<div class="container text-center py-2">
						<p class="mb-0 text-2">Copyright 2013 - 2021 - Porto - All Rights Reserved</p>
					</div>
				</div>
			</footer>
		</div>

		<!-- devcode: !production -->
		<a class="envato-buy-redirect" href="https://themeforest.net/checkout/from_item/4106987?license=regular&support=bundle_6month&ref=Okler" target="_blank" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="right" title="Buy Porto"><i class="fas fa-shopping-cart"></i></a>
		<a class="demos-redirect" href="index.html#demos" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="right" title="Demos"><img src="img/icons/demos-redirect.png" class="img-fluid" /></a>
		<!-- endcode -->
		<!-- Vendor -->		<script src="vendor/jquery/jquery.min.js"></script>		<script src="vendor/jquery.appear/jquery.appear.min.js"></script>		<script src="vendor/jquery.easing/jquery.easing.min.js"></script>		<script src="vendor/jquery.cookie/jquery.cookie.min.js"></script>		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>		<script src="vendor/jquery.validation/jquery.validate.min.js"></script>		<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>		<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>		<script src="vendor/lazysizes/lazysizes.min.js"></script>		<script src="vendor/isotope/jquery.isotope.min.js"></script>		<script src="vendor/owl.carousel/owl.carousel.min.js"></script>		<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>		<script src="vendor/vide/jquery.vide.min.js"></script>		<script src="vendor/vivus/vivus.min.js"></script>
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		<!-- Current Page Vendor and Views -->
		<script src="js/examples/examples.forms.js"></script>

		<!-- Theme Custom -->		<script src="js/custom.js"></script>
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

	</body>
</html>
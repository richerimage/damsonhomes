<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Damson_Homes
 */

get_header(); 
do_action('dh_after_header'); ?>
<style>
	.content-area {
		position: relative;
		padding: 7em 0 5em 0;
	}
	.content-area:before {

		content: "";
		position: absolute;
		top: 0; right: 0; bottom: 0; left: 0;
		background: url('https://damsonhomes.net/wp-content/uploads/2017/08/Lakeside-170809-011.jpg') no-repeat 50%;
		background-size: cover;
		opacity: 0.2;
	}

	.emoji {
		font-size: 3em;
		margin-bottom: 1em;
	}
</style>
<section id="content_area" class="content-area bg-white">
  <?php do_action('dh_before_main_content'); ?>
  <main id="main" class="row main-content" role="main">
    <?php do_action('dh_main_content_top'); ?>

    	<div id="post_404" class="twelve columns centered page type-page page-404">
				<header class="headline-area">
					<div class="headline-wrapper">
						<p class="text-center emoji">😧</p>
						<h1 class="headline h2 ntm text-center">Oh no! The page you're looking for doesn't exist!!</h1>
					</div>
				</header>

				<div class="post-content text-center">
					<p><strong style="color: black;">Have you typed in the correct url? Or is this our fault? (Sorry!)</strong></p>
					<p><strong style="color: black;">These buttons should get you on track&hellip;</strong></p>
					<ul class="no-style inline">
<li><a class="button" href="/">Head to the Homepage &rarr;</a></li>
<li><a class="button" href="/for-sale/">See our For Sale page &rarr;</a></li>
<li><a class="button" href="/coming-soon/">See Coming Soon page &rarr;</a></li>
<li><a class="button" href="/blog/">Visit the Blog &rarr;</a></li>
<li><a class="button" href="/portfolio/">See our Past Developments &rarr;</a></li>
<li><a class="button" href="https://facebook.com/damsonnewbuild/">See Our Facebook Page &rarr;</a></li>
<li><a class="button" href="/contact/">Contact us with your enquiry &rarr;</a></li>
					</ul>
				</div>

				<footer class="entry-footer"></footer>


    	</div>

    <?php do_action('dh_main_content_bottom'); ?>
  </main>
  <?php do_action('dh_after_main_content'); ?>
</section><!-- #content_area -->

<?php do_action('dh_before_footer');

get_footer();
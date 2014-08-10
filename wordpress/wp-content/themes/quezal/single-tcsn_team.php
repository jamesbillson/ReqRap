<?php
/**
 * The template for displaying team member details.
 *
 * @package WordPress
 * @subpackage Quezal
 * @since Quezal 1.0
 */
?>
<?php get_header(); ?>
<?php global $post; ?>

<section id="content-main" class="clearfix">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 team-single">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="row team">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <?php if ( has_post_thumbnail() ) { ?>
              <div class="member-image"> <?php echo '' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '';  ?></div>
              <?php } ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <?php 
									$tcsn_member_job         	= get_post_meta( $post->ID, '_tcsn_member_job', true );     
									$tcsn_member_behance     	= get_post_meta( $post->ID, '_tcsn_member_behance', true );      
									$tcsn_member_delicious   	= get_post_meta( $post->ID, '_tcsn_member_delicious', true );    
									$tcsn_member_dribbble    	= get_post_meta( $post->ID, '_tcsn_member_dribbble', true );
									$tcsn_member_dropbox     	= get_post_meta( $post->ID, '_tcsn_member_dropbox', true );       
									$tcsn_member_facebook    	= get_post_meta( $post->ID, '_tcsn_member_facebook', true );      
									$tcsn_member_flickr      	= get_post_meta( $post->ID, '_tcsn_member_flickr', true );       
									$tcsn_member_googleplus		= get_post_meta( $post->ID, '_tcsn_member_googleplus', true );    
									$tcsn_member_instagram   	= get_post_meta( $post->ID, '_tcsn_member_instagram', true );        
									$tcsn_member_linkedin    	= get_post_meta( $post->ID, '_tcsn_member_linkedin', true );        
									$tcsn_member_paypal      	= get_post_meta( $post->ID, '_tcsn_member_paypal', true );          
									$tcsn_member_pinterest   	= get_post_meta( $post->ID, '_tcsn_member_pinterest', true );        
									$tcsn_member_skype       	= get_post_meta( $post->ID, '_tcsn_member_skype', true );             
									$tcsn_member_soundcloud  	= get_post_meta( $post->ID, '_tcsn_member_soundcloud', true );       
									$tcsn_member_stumbleupon	= get_post_meta( $post->ID, '_tcsn_member_stumbleupon', true );       
									$tcsn_member_tumblr      	= get_post_meta( $post->ID, '_tcsn_member_tumblr', true );            
									$tcsn_member_twitter     	= get_post_meta( $post->ID, '_tcsn_member_twitter', true );          
									$tcsn_member_vimeo       	= get_post_meta( $post->ID, '_tcsn_member_vimeo', true );          
									$tcsn_member_youtube     	= get_post_meta( $post->ID, '_tcsn_member_youtube', true );        
									$tcsn_member_mail        	= get_post_meta( $post->ID, '_tcsn_member_mail', true );      
								?>
              <h4 class="member-name">
                <?php the_title(); ?>
              </h4>
              <span class="member-job"><?php echo $tcsn_member_job; ?></span>
              <div class="team-excerpt">
                <?php the_content(); ?>
              </div>
              <ul class="social clearfix">
                <?php if( $tcsn_member_behance != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_behance; ?>" target="_blank" title="behance"><i class="icon-behance"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_delicious != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_delicious; ?>" target="_blank" title="delicious"><i class="icon-delicious"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_dribbble != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_behance; ?>" target="_blank" title="dribbble"><i class="icon-dribbble"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_dropbox != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_dropbox; ?>" target="_blank" title="dropbox"><i class="icon-dropbox"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_facebook != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_facebook; ?>" target="_blank" title="facebook"><i class="icon-facebook"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_flickr != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_flickr; ?>" target="_blank" title="flickr"><i class="icon-flickr"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_googleplus != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_googleplus; ?>" target="_blank" title="googleplus"><i class="icon-googleplus8"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_instagram != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_instagram; ?>" target="_blank" title="instagram"><i class="icon-instagram"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_linkedin != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_linkedin; ?>" target="_blank" title="linkedin"><i class="icon-linkedin"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_paypal != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_paypal; ?>" target="_blank" title="paypal"><i class="icon-paypal"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_pinterest != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_pinterest; ?>" target="_blank" title="pinterest"><i class="icon-pinterest"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_skype != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_skype; ?>" target="_blank" title="skype"><i class="icon-skype"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_soundcloud != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_soundcloud; ?>" target="_blank" title="soundcloud"><i class="icon-soundcloud"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_stumbleupon != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_stumbleupon; ?>" target="_blank" title="stumbleupon"><i class="icon-stumbleupon"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_tumblr != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_tumblr; ?>" target="_blank" title="tumblr"><i class="icon-tumblr"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_twitter != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_twitter; ?>" target="_blank" title="twitter"><i class="icon-twitter"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_vimeo != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_vimeo; ?>" target="_blank" title="vimeo"><i class="icon-vimeo"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_youtube != ''  ) {  ?>
                <li><a href="<?php echo $tcsn_member_youtube; ?>" target="_blank" title="youtube"><i class="icon-youtube"></i></a></li>
                <?php }  ?>
                <?php if( $tcsn_member_mail != ''  ) {  ?>
                <li><a href="mailto:<?php echo $tcsn_member_mail; ?>" target="_blank" title="mail"><i class="icon-mail"></i></a></li>
                <?php }  ?>
              </ul>
            </div>
          </div>
        </article>
        <?php tcsn_post_nav(); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- #content -->

<?php get_footer(); ?>

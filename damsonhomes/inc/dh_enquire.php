<?php

// function dh_enquire(&$slug='', &$name='', &$subject_logo='', &$button_link, &$source_page, &$ftr_image) 


function dh_enquire(&$site_meta=array(), &$link_to=array()) { 

  ?>

  <div class="column-2-3 columns enquire-intro">
    <p class="intro">Here you will find all you'll need to know about buying your Damson Home.</p>
    <p>Any questions? We'd be happy to help. You can contact us through&hellip;
  </div>

  <ul class="contact-list no-style aside">
    <li><a class="block-link button sub" href="tel:+441217090539" target="_blank"><?php echo dh_get_svg(array('icon' => 'phone')); ?>0121 709 0539</a></li>
    <li><a class="block-link button sub" href="https://m.me/damsonnewbuild/" target="_blank"><?php echo dh_get_svg(array('icon' => 'messenger')); ?> Messenger</a></li>
    <li><a class="block-link button sub" href="/contact/" target="_blank"><?php echo dh_get_svg(array('icon' => 'chain')); ?>Our Contact Page</a></li>
    <li><a class="block-link button sub" href="mailto:<?php echo antispambot('sales@damsomhones.net'); ?>" target="_blank"><?php echo dh_get_svg(array('icon' => 'envelope-o')); ?> <?php echo antispambot('sales@damsonhomes.net'); ?></a></li>
  </ul>

  <div class="column-1-3 columns action-box aside">
    <a class="button" target="_blank" href="<?php dh_link($site_meta, $link_to['viewing']); ?>">Arrange a Viewing</a>
    <a class="button" target="_blank" href="<?php dh_link($site_meta, $link_to['brochure']); ?>">View Brochure</a>
  </div>

  <div class="column-2-3 columns desc-wrap">

    <h3>Buying a Damson Home</h3>
    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Reserving a Plot</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>You can request to reserve a plot any one of three ways.</p>
          <ul>
            <li>Tap on the Availability tab above, and select your favourite plot. This will take you to our Reservations Page.</li>
            <li>Send an email to <a href="mailto:<?php echo antispambot('sales@damsonhomes.net'); ?>" target="_blank"><?php echo antispambot('sales@damsonhomes.net'); ?></a> stating your chosen development and plot, along with your contact details.<br /><span class="aux">If you click on the link just given, it will pre-fill most of the email for you.</span></li>

            <li>Call us on 0121 709 0539 anytime between the hours of 9&ndash;5, Monday to Friday<br /><span class="aux">Please note we are closed for Bank Holidays and over the Christmas break.</span></li>
          </ul>
          <p>Making a Reservation Request if free of charge and without any obligation to proceed to purchase.</p>
      </span>
      </div>
    </div>
    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Your Deposit</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>To reserve a plot, we request a £500 refundable holding deposit. If you do not proceed with your sale for any reason; we will promptly refund your deposit to you.</p>
      </span>
      </div>
    </div>

    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Timescales</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>Due to the overall demand for our homes, it is typical for sale reservations being subject to exchange of contracts within 28 days.</p>

        <p>Once you have reserved your plot on <?php echo $site_meta['name']; ?>, we will be in contact with you to help you every step if the way; letting you know how things are progressing and assisting you with any actions you may need to take to keep the purchase running smoothly.</p>

        <p>With regards to moving-in dates, we will keep you regularly updated on the build progress, and you can also keep tabs yourself by following the <a href="/blog/" target="_blank"><?php echo $site_meta['name']; ?> build updates on our blog</a> or our <a href="https://facebook.com/damsonnewbuild/" target="_blank">Facebook page</a>.</p>

        <p>And fear not, you never have to wait for long to move into your brand new Damson Home &mdash; our overall build period is typically within 12&ndash;16 weeks!</p>
      </span>
      </div>
    </div>
 
    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Arranging your mortgage</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>It is a wise move to have your mortgage arrangements in place early when working towards a 28&ndash;day exchange of contracts.</p>

        <p>If you don't have these arrangements in place already, we highly recommend Matt Quigley of HL Financial Consultants.</p>
        <ul class="contact-list"> 
          <li><?php echo dh_get_svg(array('icon' => 'client')); ?>Matthew Quigley</li>
          <li><?php echo dh_get_svg(array('icon' => 'location')); ?>HL Financial Consultants Ltd,<br />373 Evesham Road,<br />Redditch B97 5JA</li>
          <li><?php echo dh_get_svg(array('icon' => 'phone')); ?>07866 580 883</li>
          <li><?php echo dh_get_svg(array('icon' => 'o-envelope')) . '<a href="mailto:' . antispambot('matthewquigley@hlconsulting.co.uk') . '" target="_blank">' . antispambot('matthewquigley@hlconsulting.co.uk') . '</a>'; ?></li>
        </ul>
        <p>We have worked closely with Matt for many of our sales and have always found him friendly, informative and proactive.</p>
      </span>
      </div>
    </div>

    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Choices</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>We love giving you the opportunity to put your own, individual stamp on your brand new Damson Home. You can choose from a wide selection of finishes for flooring, carpet colour, kitchen cabinets, and granite or quartz worktops.</p>

        <p>Please note, your choices are dependant on you having exchanged contracts before we are at the stage of the build where we are ordering these items. Best to get in early!</p>
      </span>
      </div>
    </div>

    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Client Portal</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>Once you have reserved your plot, we will send you log-in details to our online Client Portal.</p>
        <p>Here you can download documents related to your purchase and view updates notes to see how your sale is progressing. All portal updates automatically get emailed to all solicitors, and if applicable to your estate agent and financial advisor.</p>
        <p>This keeps your new home purchase nicely on schedule by keeping all parties fully up to speed.</p>
        <p>When you move into your brand new Damson Home, your client portal automatically updates and turns into your AfterCare Portal.</p>
      </span>
      </div>
    </div>

    <div class="dh-reveal-wrap">
      <a href="#" class="reveal" title="See more" alt="Tap to open"><span>Help to Buy</span></a>
      <div class="reveal-box" style="display: none;">
      <span class="dh-reveal-content xv">
        <p>Some of our plots for sale qualify for the government's Help to Buy scheme &mdash; this scheme was created to help home buyers by providing an equity loan of up to 20% which is interest-free for the first 5 years.</p>
        <p>You can see what plots are available with Help to Buy for this development by viewing the availability tab.</p>
        <p>If you intend to be using a Help to Buy, please let us know at the time of reservation.</p>
        <p><a class="button sub" href="/help-to-buy/" target="_blank">
          <?php // https://www.barratthomes.co.uk/offers/help-to-buy/

          echo dh_get_svg(array('icon' => 'h2b')); ?>

          More about Help to Buy</a></p>
      </span>
      </div>
    </div>

  </div>

  <div class="column-1-3 columns sidebar xv box">
    <h5>Damson AfterCare</h5>
    <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
  </div>


<?php }

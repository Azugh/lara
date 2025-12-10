<footer class="inverse-wrapper">
    <div class="container inner">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="section-title widget-title">Elsewhere</h3>
                <p>Vestibulum id ligula porta felis euismod semper.</p>
                <ul class="social">
                    <li><a href="#"><i class="icon-s-rss"></i></a></li>
                    <li><a href="#"><i class="icon-s-twitter"></i></a></li>
                    <li><a href="#"><i class="icon-s-facebook"></i></a></li>
                    <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
                    <li><a href="#"><i class="icon-s-linkedin"></i></a></li>
                    <li><a href="#"><i class="icon-s-forrst"></i></a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <h3 class="section-title widget-title">Subscribe</h3>
                <p> Cum sociis natoque penatibus et magnis dis parturient.</p>
                <div class="newsletter-wrapper">
                    <div id="mc_embed_signup2" class="newsletter-form">
                        <form
                            action="http://elemisfreebies.us3.list-manage1.com/subscribe/post?u=ddc180777a163e0f9f66ee014&amp;id=056957de28"
                            method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form"
                            class="validate" target="_blank" novalidate="">
                            <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL2"
                                placeholder="Enter email" required="">
                            <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                            <div style="position: absolute; left: -5000px;">
                                <input type="text" name="b_ddc180777a163e0f9f66ee014_056957de28" value="">
                            </div>
                            <div class="clear">
                                <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2"
                                    class="btn">
                            </div>
                        </form>
                    </div>
                    <!-- /#mc_embed_signup2 -->
                </div>
                <!-- /.newsletter-wrapper -->
            </div>
            <div class="col-sm-4">
                <h3 class="section-title widget-title">Tags</h3>
                <div class="tagcloud"> <a href="#" style="font-size: 9pt;">blogroll</a> <a href="#"
                        style="font-size: 19pt;">daily</a> <a href="#" style="font-size: 9pt;">dialog</a> <a href="#"
                        style="font-size: 9pt;">gallery</a> <a href="#" style="font-size: 10pt;">journal</a> <a href="#"
                        style="font-size: 9pt;">link</a> <a href="#" style="font-size: 12pt;">motion</a> <a href="#"
                        style="font-size: 9pt;">music</a> <a href="#" style="font-size: 20pt;">photo</a> <a href="#"
                        style="font-size: 13pt;">professional</a> <a href="#" style="font-size: 16pt;">quotation</a> <a
                        href="#" style="font-size: 9pt;">show</a> <a href="#" style="font-size: 15pt;">sound</a> </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-3">
                <div class="widget"> <img src="style/images/logo.png" data-at2x="style/images/logo@2x.png" alt="" />
                    <div class="divide20"></div>
                    <p>Aenean lacinia bibendum nulla sed leo posuere erat a ante venenatis dapibus posuere velit
                        aliquet. Donec ullamcorper metus auctor fringi. Nullam quis risus. </p>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->

            <div class="col-sm-3">
                <div class="widget">
                    <h3 class="section-title widget-title">Popular Posts</h3>
                    <ul class="post-list">
                        <li>
                            <h6><a href="blog-post.html">Vivamus sagittis lacus vel augue metus</a></h6>
                            <span class="meta date">3th Oct 2012</span>
                        </li>
                        <li>
                            <h6><a href="blog-post.html">Scelerisque nisl consectetur et</a></h6>
                            <span class="meta date">28th Sep 2012</span>
                        </li>
                    </ul>
                    <!-- /.post-list -->
                </div>
                <!-- /.widget -->
            </div>
            <!-- /column -->

            <div class="col-sm-3">
                <div class="widget">
                    <h3 class="section-title widget-title">Get In Touch</h3>
                    <p>Fusce dapibus, tellus commodo, tortor mauris condimentum utellus fermentum.</p>
                    <div class="contact-info"> <i class="icon-location"></i> Moonshine St. 14/05 Light City
                        <br />
                        <i class="icon-phone"></i>+00 (123) 456 78 90 <br />
                        <i class="icon-mail"></i> <a href="first.last@email.com">first.last@email.com</a>
                    </div>
                </div>
            </div>
            <!-- /column -->

            <div class="col-sm-3">
                <div class="widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="circled">
                        <li><a href="#">Web Design (21)</a></li>
                        <li><a href="#">Photography (19)</a></li>
                        <li><a href="#">Graphic Design (16)</a></li>
                        <li><a href="#">Manipulation (15)</a></li>
                        <li><a href="#">Motion Graphics (12)</a></li>
                    </ul>
                </div>
                <!-- /.widget -->

            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->

        <hr />
        <p class="copyright pull-left">© 2015 Hygge. All rights reserved. Theme by <a
                href="http://elemisfreebies.com">elemis</a>.</p>
        <ul class="footer-menu pull-right">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
    <!-- .container -->
    <a href="{{ route('admin') }}" class="btn btn-sm btn-secondary float-end">
        Назад к списку
    </a>INSERT INTO sliders (
    id,
    image,
    title,
    content,
    btn_text,
    isActive,
    created_at,
    updated_at
    )
    VALUES (
    'id:bigint',
    'image:character varying',
    'title:character varying',
    'content:character varying',
    'btn_text:character varying',
    isActive:boolean,
    'created_at:timestamp without time zone',
    'updated_at:timestamp without time zone'
    );
</footer>
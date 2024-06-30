<?php
/* Template Name: Sign Up Form Template */
get_header();
wp_title('Sign Up');
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php if (!isset($_POST['submit_signup'])) : ?>
        <h1 class="main-heading">Sign Up</h1>
        <form id="signup-form" name="signup" method="post">
            <div>
                <label class="label-text" for="name">Name:</label>
                <input class="form_input" type="text" id="name" name="name" required>
            </div>

            <div>
                <label class="label-text" for="address">Address:</label>
                <input class="form_input" type="text" id="address" name="address" required>
            </div>

            <div>
                <label class="label-text" for="phone">Phone Number:</label>
                <input class="form_input" type="text" id="phone" name="phone" required>
            </div>

            <div>
                <label class="label-text" for="email">Email:</label>
                <input class="form_input" type="email" id="email" name="email" required>
            </div>

            <div>
                <label class="label-text" for="hobbies">Hobbies:</label>
                <div id="tag-container">
                    <input class="form_input" type="text" id="hobbies-input" placeholder="Add a hobby" autocomplete="off">
                    <div id="suggestions-container"></div>
                </div>
                <input type="hidden" id="hobbies" name="hobbies">
            </div>
            
            <div>
                <input type="submit" name="submit_signup" value="Sign Up">
            </div>
        </form>
        <?php else : ?>
        <div class="thankyou-page-inner">
            <div class="wrapper">
                <div class="tick">
                    <div class="done-tick"></div>
                    <span class="dashicons dashicons-saved"></span>
                </div>
                <h2>Thankyou For Submission</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio minus numquam exercitationem, deleniti porro repellendus ex perspiciatis, voluptas labore asperiores fugit obcaecati amet ipsa dolorum nisi quae. Enim, id quaerat.</p>
                <div class="next-btn">
                    <a href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>">Back to Form</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>
</div>


<?php
wp_enqueue_script('csp-contact-form', plugins_url('assets/build/js/public.js', CSP__FILE__), ['jquery'], false, true);
get_footer();
?>


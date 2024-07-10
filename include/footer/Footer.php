<?php
require_once 'C:/laragon/www/BCATU/config/pdo_connection.php';
require_once 'C:/laragon/www/BCATU/config/helpers.php';
// echo $_SERVER['DOCUMENT_ROOT'];
?>

<!-- Footer starts  -->
<footer class="footer">
    <div class="footer-container">
        <div id="footer-grid">
            <div class="company">
                <h2 class="section-title">BCATU</h2>
                <ul class="links">
                    <li><a href="<?= url('/index.php') ?>" class="link">Home</a></li>
                    <li><a href="<?= url('/pages/aboutus/AboutUs.php') ?>" class="link">About Us</a></li>
                    <li><a href="<?= url('/pages/contactus/ContactUs.php') ?>" class="link">Contact Us</a></li>
                    <li><a href="<?= notes_url('/syllabus/syllabus.php') ?>" class="link">Syllabus</a></li>
                </ul>
            </div>
            <div class="company">
                <h2 class="section-title">Resources</h2>
                <ul class="links">
                    <li><a href="<?= url('/pages/community/communitypage.php') ?>" class="link">Community</a></li>
                    <li><a href="<?= blog_url('/blogpage.php') ?>" class="link">Blogs</a></li>
                    <li><a href="<?= notes_url('/notes/notes.php') ?>" class="link">Notes</a></li>
                </ul>
            </div>
            <div class="help-center">
                <h2 class="section-title">User Account</h2>
                <ul class="links">
                    <li><a href="<?= url('/pages/dashboard/Userprofile.php') ?>" class="link">View Profile</a></li>
                    <li><a href="<?= url('/pages/dashboard/Editprofile.php') ?>" class="link">Update Profile</a></li>
                    <li><a href="<?= url('/pages/dashboard/Myblogs.php') ?>" class="link">My Blogs</a></li>
                    <li><a href="<?= url('/pages/dashboard/Addblog.php') ?>" class="link">Add Blog</a></li>
                </ul>
            </div>
            <div class="legal">
                <h2 class="section-title">BCATU Terms</h2>
                <ul class="links">
                    <li><a href="#" class="link">FAQs</a></li>
                    <li><a href="#" class="link">Help Center</a></li>
                    <li><a href="#" class="link">Privacy Policy</a></li>
                    <li><a href="#" class="link">Terms of Service</a></li>
                </ul>
            </div>
            <div class="download">
                <h2 class="section-title">Connect with Us</h2>
                <ul class="links">
                    <li><a class="link" href="https://twitter.com">Twitter</a></li>
                    <li><a class="link" href="https://facebook.com">Facebook</a></li>
                    <li><a class="link" href="https://linkedin.com">LinkedIn</a></li>
                    <li><a class="link" href="/subscribe">Subscribe to Newsletter</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <span class="copyright">© 2024 BCATU. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</footer>
<!-- Footer ends -->
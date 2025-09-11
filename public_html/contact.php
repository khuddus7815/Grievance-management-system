<?php include 'header.php'; ?>

<section class="page-section">
    <div class="container">
        <h2>Contact Us</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="lead mb-5">Have questions or feedback? We'd love to hear from you. Reach out to us through the channels below or fill out the contact form.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-5 text-center">
                <i class="fas fa-map-marker-alt fa-3x mb-3 text-muted"></i>
                <h5 class="text-uppercase">Address</h5>
                <p>123 Civic Center, New Delhi, Delhi 110001, India</p>
            </div>
            <div class="col-md-4 mb-5 text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <h5 class="text-uppercase">Email</h5>
                <a href="mailto:support@tranetra.gov.in">support@tranetra.gov.in</a>
            </div>
            <div class="col-md-4 mb-5 text-center">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <h5 class="text-uppercase">Phone</h5>
                <p>+91 11 2345 6789</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-8 mx-auto">
                <form action="#" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Your Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Your Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Your Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSubject">Subject</label>
                        <input type="text" class="form-control" id="inputSubject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="background-color:#5c4033">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
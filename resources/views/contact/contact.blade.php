<x-layout>
    <x-slot:heading>
        Exclusive
    </x-slot:heading>
    <x-breadcrumbs />
    <div class="main">
        <div class="contact-container">
            <div class="contact-info-block">
                <div class="contact-item">
                    <div class="icon-text-wrapper">
                        <div class="icon-circle">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span class="contact-heading">Call To Us</span>
                    </div>
                    <p>We are available 24/7, 7 days a week.</p>
                    <p>Phone: +37369999999</p>
                </div>
                <hr>
                <div class="contact-item">
                    <div class="icon-text-wrapper">
                        <div class="icon-circle">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span class="contact-heading">Write To Us</span>
                    </div>
                    <p>Fill out our form and we will contact you within 24 hours.</p>
                    <p>Emails: customer@exclusive.com</p>
                    <p>Emails: support@exclusive.com</p>
                </div>
            </div>
            <div class="send-message-block">
                <form id="contact-form" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name *" required>
                        <input type="email" name="email" placeholder="Your Email *" required>
                        <input type="text" name="phone" placeholder="Your Phone *" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="form-action">
                        <button type="submit" class="btn-send-message">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

{{-- WhatsApp floating button at bottom right --}}
<div class="whatsapp-floating-button">
    <a href="https://api.whatsapp.com/send?phone=62858551127192&text=Min%20sedot%20wc%20nya%20ready%20nggak" target="_blank" class="btn btn-success rounded-circle shadow" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
        <i class="fab fa-whatsapp fa-lg"></i>
    </a>
</div>

<style>
    .whatsapp-floating-button {
        position: fixed;
        bottom: 80px; /* Positioned above the bottom menu */
        right: 20px;
        z-index: 1000; /* Ensure it's above other elements */
    }

    /* Adjust position for larger screens if needed */
    @media (min-width: 992px) {
        .whatsapp-floating-button {
            bottom: 20%;
            right: 32%;
        }
    }
</style>

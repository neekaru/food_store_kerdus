{{-- WhatsApp floating button at bottom right --}}
<div class="container fixed-bottom mb-5">
    <div class="row justify-content-end">
        <div class="col-auto">
            <a href="https://api.whatsapp.com/send?phone=62858551127192&text=Min%20sedot%20wc%20nya%20ready%20nggak" target="_blank" class="btn btn-success rounded-circle shadow" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                <i class="fab fa-whatsapp fa-lg"></i>
            </a>
        </div>
    </div>
</div>

<script>
    function adjustWhatsAppButton() {
        if (window.innerWidth >= 992) { // Assuming desktop is 992px and above
            const targetDiv = document.querySelector('body > div:nth-child(3) > div');
            if (targetDiv) {
                targetDiv.style.marginBottom = '6rem';
                targetDiv.style.marginRight = '22rem';
            }
        }
    }

    // Run on page load
    adjustWhatsAppButton();

    // Run on window resize
    window.addEventListener('resize', adjustWhatsAppButton);
</script>

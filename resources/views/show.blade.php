<div id="whatsapp-floating-button"></div>

<style>
    #whatsapp-floating-button {
        left: {{ setting('whatsapp-floating-button.position', 'right') ? 'auto' : setting('whatsapp-floating-button.offset_x', 20) . 'px' }} !important;
        right: {{ setting('whatsapp-floating-button.position', 'right') ? setting('whatsapp-floating-button.offset_x', 20) . 'px' : 'auto' }} !important;
        bottom: {{ setting('whatsapp-floating-button.offset_y', 20) }}px !important;
    }
</style>

<script>
    window.addEventListener('load', function() {
        const whatsappFloatingButton = document.getElementById('whatsapp-floating-button');

        if (whatsappFloatingButton) {
            $(whatsappFloatingButton).floatingWhatsApp({
                phone: "{{ setting('whatsapp-floating-button.phone_number') }}",
                popupMessage: "{{ Str::limit(setting('whatsapp-floating-button.popup_message'), 220)}}",
                showPopup: "{{ setting('whatsapp-floating-button.show_popup', false) }}",
                headerTitle: "{{ setting('whatsapp-floating-button.popup_title') }}",
                position: "{{ setting('whatsapp-floating-button.position', 'right') }}",
                size: "{{ setting('whatsapp-floating-button.size', 60) }}px",
                backgroundColor: '#25D366',
                showOnIE: !0,
                autoOpenTimeout: 0,
                headerColor: '#128C7E',
                zIndex: {{ setting('whatsapp-floating-button.z_index', 999) }},
            });
        }
    });
</script>

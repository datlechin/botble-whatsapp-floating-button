$(() => {
    const $button = $('#whatsapp-floating-button')

    if ($button.length) {
        $button.floatingWhatsApp({
            phone: $button.data('phone'),
            popupMessage: $button.data('popup-message'),
            showPopup: $button.data('show-popup'),
            headerTitle: $button.data('popup-title'),
            position: $button.data('position'),
        });
    }
})

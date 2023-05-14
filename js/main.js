(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

})(jQuery);

async function getUserInfo() {
    return await $.ajax({
        url: getAjaxUrl('userInfo', '/getCurrentUserInfo'),
        method: "GET"
    }).then(res => JSON.parse(res));
}

function getAjaxUrl(apiType, pathAndQueryString) {
    if (!pathAndQueryString.startsWith("/")) {
        pathAndQueryString = "/" + pathAndQueryString;
    }
    return `api/${apiType}.php${pathAndQueryString}`;
}

function pushToast({ title = '', type = 'OK', message = '' }) {
    let $toastContainer = $('#toast_container');
    if ($toastContainer.length === 0) {
        $toastContainer = $(`
            <div id="toast_container" style="position: fixed; top: 35px; right: 35px; width: 300px; z-index: 1051;"></div>
        `);
        $('body').prepend($toastContainer);
    }
    type = type.toUpperCase();
    const $toast = $(`
        <div class="toast" role="alert" data-delay="10000" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas ${type === 'OK' ? 'fa-check' : 'fa-times'}" style="margin-right: 8px; color: ${type === 'OK' ? 'green' : '#ff7878'}"></i>
                <strong class="mr-auto">${title}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">${message}</div>
        </div>
    `);
    $toast.on('hidden.bs.toast', function () {
        $(this).remove();
    });
    $('#toast_container').append($toast);
    $toast.toast('show');
}

function openModal({
    $title = '',
    $body = '',
    confirmCallback = () => { }
}) {
    let $modalContainer = $('#modal_container');
    if ($modalContainer.length === 0) {
        $modalContainer = $(`
        <div class="modal fade" id="modal_container" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modalBody" class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="confirmButton" type="button" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div>
        `);
        $('body').prepend($modalContainer);
        $(document).on('hidden.bs.modal', '#modal_container', function () {
            closeModal();
        })

    }
    $modalContainer.find('#modalTitle').html($title);
    $modalContainer.find('#modalBody').html($body);
    $modalContainer.find('#confirmButton').on('click', confirmCallback);
    $modalContainer.modal('show');
}
function closeModal() {
    const $modalContainer = $('#modal_container');
    if ($modalContainer.length === 0) {
        return;
    }
    $modalContainer.find('#modalTitle').html('');
    $modalContainer.find('#modalBody').html('');
    $modalContainer.find("#confirmButton").off();
    $modalContainer.modal('hide');
}

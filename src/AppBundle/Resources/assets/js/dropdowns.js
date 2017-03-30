'use strict';

import $ from 'jquery';

/**
 * Make all dropdown menus interactive.
 *
 * @param {string} root
 */
function initRoot(root) {
    root = root || ':root';

    $(root)
        .find('.dropdown-container')
        .addClass('js')
        .find('.dropdown-toggle')
        .click(function (event) {
            event.stopPropagation();

            const container = $(this).parent('.dropdown-container');

            // close all other dropdowns
            $('.dropdown-container.expanded')
                .not(container)
                .removeClass('expanded')
                .find('.dropdown-toggle')
                .attr('aria-expanded', false);

            // toggle the current dropdown
            $(this)
                .attr('aria-expanded', $(container).hasClass('expanded'))
                .parent('.dropdown-container').toggleClass('expanded');

            return false;
        });
}

/**
 * Adds a global click handler that closes dropdowns when clicking on something
 * that isn't a toggle.
 */
function initWindow() {
    $(window).click(() => {
        $('.dropdown-container.expanded')
            .removeClass('expanded')
            .find('.dropdown-toggle')
            .attr('aria-expanded', false);
    });
}

export { initWindow, initRoot };

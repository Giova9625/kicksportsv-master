(function() {
    'use strict';
    var dialog = document.querySelector('#modal-example');
    var closeButton = dialog.querySelector('button');
    var showButton = document.querySelector('#show-modal-example');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    var closeClickHandler = function(event) {
        dialog.close();
    };
    var showClickHandler = function(event) {
        dialog.showModal();
    };
    showButton.addEventListener('click', showClickHandler);
    closeButton.addEventListener('click', closeClickHandler);
}());

(function() {
    'use strict';
    var dialog = document.querySelector('#modal-example1');
    var closeButton = dialog.querySelector('button');
    var showButton = document.querySelector('#show-modal-example1');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    var closeClickHandler = function(event) {
        dialog.close();
    };
    var showClickHandler = function(event) {
        dialog.showModal();
    };
    showButton.addEventListener('click', showClickHandler);
    closeButton.addEventListener('click', closeClickHandler);
}());

(function() {
    'use strict';
    var dialog = document.querySelector('#modal-example2');
    var closeButton = dialog.querySelector('button');
    var showButton = document.querySelector('#show-modal-example2');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    var closeClickHandler = function(event) {
        dialog.close();
    };
    var showClickHandler = function(event) {
        dialog.showModal();
    };
    showButton.addEventListener('click', showClickHandler);
    closeButton.addEventListener('click', closeClickHandler);
}());

(function() {
    'use strict';
    var dialog = document.querySelector('#modal-example3');
    var closeButton = dialog.querySelector('button');
    var showButton = document.querySelector('#show-modal-example3');
    if (! dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    var closeClickHandler = function(event) {
        dialog.close();
    };
    var showClickHandler = function(event) {
        dialog.showModal();
    };
    showButton.addEventListener('click', showClickHandler);
    closeButton.addEventListener('click', closeClickHandler);
}());
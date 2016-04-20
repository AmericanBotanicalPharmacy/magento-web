// Trigger change event (to fire standard Magento events associated with control).
function aydusSwatchTriggerEvent(id) {
    triggerEvent($$('#' + id)[0],'change');

    // Custom prototype function to fire an event
    // http://stackoverflow.com/questions/460644/trigger-an-event-with-prototype
    function triggerEvent(element, eventName) {
        // safari, webkit, gecko
        if (document.createEvent) {
            var evt = document.createEvent('HTMLEvents');
            evt.initEvent(eventName, true, true);

            return element.dispatchEvent(evt);
        }

        // Internet Explorer
        if (element.fireEvent) {
            return element.fireEvent('on' + eventName);
        }
    }
}

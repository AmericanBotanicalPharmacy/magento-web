/**
 * Author: Aydus
 * 
 * - Added scrollTo checkoutSteps element
 * - Added ga pageview send, from production (app/design/frontend/rwd/default/template/checkout/onepage.phtml) 6/8/15
 */

Checkout.prototype.gotoSection = function (section, reloadProgressBlock) {
    // Adds class so that the page can be styled to only show the "Checkout Method" step
    if ((this.currentStep == 'login' || this.currentStep == 'billing') && section == 'billing') {
        $j('body').addClass('opc-has-progressed-from-login');
    }

    if (reloadProgressBlock) {
        this.reloadProgressBlock(this.currentStep);
    }
    
    try {
    	 ga('send', 'pageview', '/checkout/onepage/' + section + '/');
    		 
    	}
    	catch (err) {
    	}
    	
    this.currentStep = section;
    var sectionElement = $('opc-' + section);
    sectionElement.addClassName('allow');
    this.accordion.openSection('opc-' + section);

    // Scroll viewport to top of checkout steps for smaller viewports
    if (Modernizr.mq('(max-width: ' + bp.xsmall + 'px)')) {
        $j('html,body').animate({scrollTop: $j('#checkoutSteps').offset().top}, 800);
    } else {
        $('checkoutSteps').scrollTo();
    }

    if (!reloadProgressBlock) {
        this.resetPreviousSteps();
    }
}
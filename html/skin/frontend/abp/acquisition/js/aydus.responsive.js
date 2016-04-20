// Override default Magento js breakpoints defined here: skin/frontend/rwd/default/js/app.js
var bp = {
    xsmall: 319,
    small: 639,
    medium: 767,
    large: 1799,
    xlarge: 1799
}

/*
 Javascript Responsive class. Collection of general properties/methods for use with Responsive sites.
 Important: Use jQuery instead of $.  To do: Find solution for using standard jquery $.
 */

function Responsive() {

    // Init breakpoint pixel values (keep consistent with css).
    this.desktopWidth = bp.xlarge + 1;
    this.tabletWidth = bp.medium + 1;
    this.tabletLandscapeWidth = 1024;
    this.mobileWidth = bp.small + 1;
    this.phoneWidth = bp.xsmall + 1;

    // Core breakpoints (keep consistent with css).
    this.mqDesktop = 'handheld, screen and (min-width: ' + (this.desktopWidth + 1) + 'px)';
    this.mqTablet = 'handheld, screen and (max-width: ' + this.tabletWidth + 'px)';
    this.mqMobile = 'handheld, screen and (max-width: ' + this.mobileWidth + 'px)';
    this.mqPhone = 'handheld, screen and (max-width: ' + this.phoneWidth + 'px)';

    // Additional breakpoints (use with care).
    this.mqIsDesktop = 'handheld, screen and (min-width: ' + parseInt(this.tabletLandscapeWidth + 1) + 'px)';
    this.mqIsNotMobile = 'handheld, screen and (min-width: ' + parseInt(this.mobileWidth + 1) + 'px)';
}
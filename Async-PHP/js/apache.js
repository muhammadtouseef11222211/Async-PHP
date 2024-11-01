// script.js

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {

    // Gauge options
    var opts = {
        angle: 0.0, // The span of the gauge arc
        lineWidth: 0.2, // The line thickness
        radiusScale: 1,
        pointer: {
            length: 0.6, // Relative to gauge radius
            strokeWidth: 0.035, // The thickness
            color: '#000000' // Fill color
        },
        limitMax: false,     // If false, max value increases automatically if value > maxValue
        limitMin: false,     // If true, the min value of the gauge will be fixed
        colorStart: '#6FADCF',   // Colors
        colorStop: '#8FC0DA',    // just experiment with them
        strokeColor: '#E0E0E0',  // to see which ones work best for you
        generateGradient: true,
        highDpiSupport: true     // High resolution support
    };

    // RAM Gauge
    var target = document.getElementById('ramGauge'); // your canvas element
    if (target) {
        var gauge = new Gauge(target).setOptions(opts); // create gauge!
        gauge.maxValue = 100; // set max gauge value
        gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
        gauge.animationSpeed = 32; // set animation speed (32 is default value)
        gauge.set(ramUsage); // set actual value
    } else {
        console.error('Canvas element with id "ramGauge" not found.');
    }

});


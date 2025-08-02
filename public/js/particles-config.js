document.addEventListener('DOMContentLoaded', function() {
    if (typeof particlesJS !== 'undefined') {
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 80,
                    "density": {
                        "enable": true,
                        "value_area": 800
                    }
                },
                "color": {
                    "value": ["#00c476", "#ffffff"]
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.7,
                    "random": true
                },
                "size": {
                    "value": 5,
                    "random": true
                },
                "line_linked": {
                    "enable": false
                },
                "move": {
                    "enable": true,
                    "direction": "bottom-right",
                    "speed": 0.5,
                    "out_mode": "bounce",
                    "bounce": true
                }
            },
            "interactivity": {
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    }
                },
                "modes": {
                    "repulse": {
                        "distance": 100,
                        "duration": 0.5
                    }
                }
            }
        });
    } else {
        console.error("particles.js não foi carregado corretamente!");
    }
});
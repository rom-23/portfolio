const ratio = .1;
const options = {
    root: null,
    rootMargin: '0px',
    threshold: ratio
};
const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.remove('reveal');
            observer.unobserve(entry.target)
        }
    })
};
document.documentElement.classList.add('reveal-loaded');
window.addEventListener("DOMContentLoaded", function () {
    const observer = new IntersectionObserver(handleIntersect, options);
    const targets = document.querySelectorAll('.reveal');
    targets.forEach(function (target) {
        observer.observe(target)
    })
});
$(function($) {
    $('.teamskillbar').each(function () {
        $(this).find('.teamskillbar-bar').animate({
            width: $(this).attr('data-percent')
        }, 6000);
    });
});

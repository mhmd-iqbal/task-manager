// Select the floating button container
const floatingButtonContainer = document.querySelector('.floating-button-container');

// Function to update the position of the floating button container
function updateFloatingButtonPosition() {
    const scrollY = window.scrollY || window.pageYOffset; // Get current scroll position
    const windowHeight = window.innerHeight; // Get viewport height

    // Calculate the desired top position for the floating button container
    const desiredTop = scrollY + windowHeight - 150 + 'px';

    // Apply the calculated top position to the floating button container
    floatingButtonContainer.style.top = desiredTop;
}

// Initially position the floating button container
updateFloatingButtonPosition();

// Update the position of the floating button container when scrolling
window.addEventListener('scroll', function () {
    // Use requestAnimationFrame to optimize scroll event handling
    requestAnimationFrame(updateFloatingButtonPosition);
});

// Optional: Update the position of the floating button container on window resize
window.addEventListener('resize', function () {
    // Update the position after a short delay to handle resize end
    clearTimeout(this.resizeTimeout);
    this.resizeTimeout = setTimeout(updateFloatingButtonPosition, 250);
});

$(document).ready(function () {
    $('#tasks-table').DataTable({
        order: [[0, 'desc']],
        searching: false,
        responsive: {
            details: true,
            breakpoints: [
                { name: 'desktop', width: Infinity },
                { name: 'tablet-l', width: 1024 },
                { name: 'tablet-p', width: 768 },
                { name: 'mobile-l', width: 480 },
                { name: 'mobile-p', width: 320 }
            ]
        },
        dom: "<'d-flex justify-content-between my-3'<l><p>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'d-flex justify-content-between my-3'<i><p>>",
        "columnDefs": [{
            "targets": 3,
            "orderable": false
        }],
        scrollCollapse: true,
        scrollY: '500px'
    });
});

// Wait for DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Select all nav items and content sections
    const navItems = document.querySelectorAll('.profile-nav__link');
    const contentSections = document.querySelectorAll('.content-section');
  
    // Add click event listeners to nav items
    navItems.forEach((navItem) => {
      navItem.addEventListener('click', function() {
        // Remove 'active' class from all nav items and sections
        navItems.forEach((item) => item.classList.remove('active'));
        contentSections.forEach((section) => section.classList.remove('active'));
  
        // Add 'active' class to clicked nav item and corresponding content section
        const targetSection = this.getAttribute('data-target');
        document.getElementById(targetSection).classList.add('active');
        this.classList.add('active');
      });
    });
  });
  

let slider = document.querySelector('.favourite__slider--container');
let innerSlider = document.querySelector('.favourite__slider--inner');

let pressed = false;
let startx;
let x;
let velocity = 0;
let animationFrameId;

let lastMousePosition;
let lastTimestamp;

slider.addEventListener('mousedown', (e) => {
    pressed = true;
    startx = e.offsetX - innerSlider.offsetLeft;
    slider.style.cursor = 'grabbing';
    
    cancelAnimationFrame(animationFrameId);  // Stop any ongoing inertia
    lastMousePosition = e.offsetX;  // Store the initial mouse position
    lastTimestamp = Date.now();     // Store the timestamp for velocity calculation
});

slider.addEventListener('mouseenter', () => {
    slider.style.cursor = 'grab';
});

slider.addEventListener('mouseup', () => {
    slider.style.cursor = 'grab';
});

window.addEventListener('mouseup', () => {
    if (pressed) {
        pressed = false;
        // Start the inertia when the mouse is released
        requestInertia();
    }
});

slider.addEventListener('mousemove', (e) => {
    if (!pressed) return;
    e.preventDefault();

    x = e.offsetX;
    let newLeft = x - startx;

    innerSlider.style.left = `${newLeft}px`;

    // Calculate velocity
    let currentTimestamp = Date.now();
    let timeDiff = currentTimestamp - lastTimestamp;
    let mouseMovement = e.offsetX - lastMousePosition;
    velocity = mouseMovement / timeDiff;  // Velocity = distance / time

    // Store current position and timestamp for the next calculation
    lastMousePosition = e.offsetX;
    lastTimestamp = currentTimestamp;

    checkboundary();
});

function checkboundary() {
    let outer = slider.getBoundingClientRect();
    let inner = innerSlider.getBoundingClientRect();

    if (parseInt(innerSlider.style.left) > 0) {
        innerSlider.style.left = '0px';
    } else if (inner.right < outer.right) {
        innerSlider.style.left = `-${inner.width - outer.width}px`;
    }
}

// Function to animate the inertia after mouse release
function requestInertia() {
    const friction = 0.9;  // A friction value less than 1 to slow down the slider over time

    function inertia() {
        if (Math.abs(velocity) > 0.01) {  // Minimum threshold to stop animation
            // Move the slider by the current velocity
            innerSlider.style.left = `${parseInt(innerSlider.style.left) + velocity * 10}px`;

            // Apply friction to reduce velocity
            velocity *= friction;

            checkboundary();  // Ensure boundaries are respected

            // Continue the animation
            animationFrameId = requestAnimationFrame(inertia);
        } else {
            cancelAnimationFrame(animationFrameId);
        }
    }

    // Start the inertia animation
    inertia();
}

checkboundary();

// Get all the setting elements and their respective tooltips
const previewLengthSetting = document.getElementById('preview-length-setting');
const autoScrollSetting = document.getElementById('auto-scroll-setting');
const pushNotificationSetting = document.getElementById('push-notification-setting');
const defaultPlatformSetting = document.getElementById('default-platform-setting'); // New platform setting

const previewTooltip = document.getElementById('tooltip-preview-length');
const autoScrollTooltip = document.getElementById('tooltip-auto-scroll');
const pushNotificationTooltip = document.getElementById('tooltip-push-notification');
const platformTooltip = document.getElementById('tooltip-default-platform'); // New platform tooltip

// Function to show the tooltip
function showTooltip(setting, tooltip) {
    setting.addEventListener('mouseenter', function() {
        tooltip.classList.add('tooltip-visible');
    });
    setting.addEventListener('mouseleave', function() {
        tooltip.classList.remove('tooltip-visible');
    });
}

// Apply hover effect to show/hide tooltips
showTooltip(previewLengthSetting, previewTooltip);
showTooltip(autoScrollSetting, autoScrollTooltip);
showTooltip(pushNotificationSetting, pushNotificationTooltip);
showTooltip(defaultPlatformSetting, platformTooltip); // Tooltip for platform setting

// Dropdown logic for preview length (already existing)
const dropdownBtn = document.getElementById('dropdown-btn');
const dropdownContent = document.getElementById('dropdown-content');

// Toggle dropdown visibility when clicking the button
dropdownBtn.addEventListener('click', function() {
  dropdownContent.classList.toggle('show');
});

// Handle dropdown item click to update button text (without affecting the icon)
dropdownContent.addEventListener('click', function(event) {
  // Make sure the click is on an anchor tag
  if (event.target.tagName === 'A') {
    // Get the selected time from the data attribute
    const selectedTime = event.target.getAttribute('data-time');

    // Update the button's text part (without overwriting the icon)
    dropdownBtn.innerHTML = `${selectedTime} <i style="margin-left:10px;" class="fa-solid fa-chevron-down"></i>`;

    // Close the dropdown
    dropdownContent.classList.remove('show');
  }
});

// Dropdown for Default Import Platform
const platformDropdownBtn = document.getElementById('platform-dropdown-btn');
const platformDropdownContent = document.getElementById('platform-dropdown-content');

// Toggle dropdown visibility when clicking the button
platformDropdownBtn.addEventListener('click', function() {
  platformDropdownContent.classList.toggle('show');
});

// Handle dropdown item click to update platform button text (without affecting the icon)
platformDropdownContent.addEventListener('click', function(event) {
  // Make sure the click is on an anchor tag
  if (event.target.tagName === 'A') {
    // Get the selected platform from the data attribute
    const selectedPlatform = event.target.getAttribute('data-platform');

    // Update the button's text part (without overwriting the icon)
    platformDropdownBtn.innerHTML = `${selectedPlatform} <i style="margin-left:10px;" class="fa-solid fa-chevron-down"></i>`;

    // Close the dropdown
    platformDropdownContent.classList.remove('show');
  }
});

// Close dropdowns if clicking outside of them
window.onclick = function(event) {
  if (!event.target.matches('.dropdown-btn')) {
    if (dropdownContent.classList.contains('show')) {
      dropdownContent.classList.remove('show');
    }
    if (platformDropdownContent.classList.contains('show')) {
      platformDropdownContent.classList.remove('show');
    }
  }
};

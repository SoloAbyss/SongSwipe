// Get the button and the dropdown content
const dropdownBtn = document.getElementById('dropdown-btn');
const dropdownContent = document.getElementById('dropdown-content');

// Toggle dropdown visibility when clicking the button
dropdownBtn.addEventListener('click', function() {
  dropdownContent.classList.toggle('show');
});

// Handle dropdown item click to update button text
dropdownContent.addEventListener('click', function(event) {
  // Make sure the click is on an anchor tag
  if (event.target.tagName === 'A') {
    // Get the selected time from the data attribute
    const selectedTime = event.target.getAttribute('data-time');

    // Update the button text to the selected time
    dropdownBtn.textContent = selectedTime;

    // Close the dropdown
    dropdownContent.classList.remove('show');
  }
});

// Close the dropdown if clicking outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropdown-btn')) {
    if (dropdownContent.classList.contains('show')) {
      dropdownContent.classList.remove('show');
    }
  }
};

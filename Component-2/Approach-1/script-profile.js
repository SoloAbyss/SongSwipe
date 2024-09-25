// Wait for DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Select all nav items and content sections
    const navItems = document.querySelectorAll('.nav-link');
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
  
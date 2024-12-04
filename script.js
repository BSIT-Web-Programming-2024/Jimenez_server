document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove 'active' class from all sections
        document.querySelectorAll('.section').forEach(section => {
            section.classList.remove('active');
        });

        // Add 'active' class to the clicked section
        const targetSection = document.querySelector(this.getAttribute('href'));
        if (targetSection) {
            targetSection.classList.add('active');
        }
    });
});

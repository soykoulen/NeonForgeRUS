// Mobile menu toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const navMenu = document.getElementById('navMenu');

if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });
}

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        navMenu.classList.remove('active');
    });
});

// Project filtering
const statusFilter = document.getElementById('statusFilter');
const searchProject = document.getElementById('searchProject');

function filterProjects() {
    const projects = document.querySelectorAll('.project-card');
    const status = statusFilter ? statusFilter.value : 'all';
    const searchTerm = searchProject ? searchProject.value.toLowerCase() : '';
    
    projects.forEach(project => {
        const projectStatus = project.getAttribute('data-status');
        const projectTitle = project.getAttribute('data-title') || '';
        
        let showByStatus = status === 'all' || projectStatus === status;
        let showBySearch = searchTerm === '' || projectTitle.toLowerCase().includes(searchTerm);
        
        if (showByStatus && showBySearch) {
            project.style.display = '';
            setTimeout(() => {
                project.style.opacity = '1';
            }, 10);
        } else {
            project.style.display = 'none';
        }
    });
}

if (statusFilter) {
    statusFilter.addEventListener('change', filterProjects);
}

if (searchProject) {
    searchProject.addEventListener('input', filterProjects);
}

// Add animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all cards for animation
document.querySelectorAll('.project-card, .designer-card, .client-card, .service-card, .stat-card-large, .dashboard-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'all 0.6s ease';
    observer.observe(card);
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add hover effect for buttons
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// Animate progress bars on scroll
const progressBars = document.querySelectorAll('.progress-fill');
const progressObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const width = entry.target.style.width;
            entry.target.style.width = '0';
            setTimeout(() => {
                entry.target.style.width = width;
            }, 100);
            progressObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

progressBars.forEach(bar => progressObserver.observe(bar));

// Console log for development
console.log('DesignStudio website loaded successfully! 🎨');
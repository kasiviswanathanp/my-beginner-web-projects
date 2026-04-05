const sectionLinks = document.querySelectorAll('.table-of-contents a');
const sections = document.querySelectorAll('section[id], footer[id]');
const topButton = document.querySelector('.top-button');

sectionLinks.forEach(link => {
    link.addEventListener('click', event => {
        event.preventDefault();
        const targetId = link.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

const revealObserver = new IntersectionObserver(
    entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                revealObserver.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.2 }
);

const revealItems = document.querySelectorAll('.reveal');
revealItems.forEach(item => revealObserver.observe(item));

function updateActiveLink() {
    const offset = window.innerHeight * 0.25;
    let current = sections[0];

    sections.forEach(section => {
        const top = section.getBoundingClientRect().top;
        if (top <= offset) {
            current = section;
        }
    });

    sectionLinks.forEach(link => {
        link.classList.toggle(
            'active',
            link.getAttribute('href') === `#${current.id}`
        );
    });
}

window.addEventListener('scroll', () => {
    updateActiveLink();
    topButton.classList.toggle('visible', window.scrollY > 420);
});

topButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

updateActiveLink();

const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');
const homeLink = document.querySelector('.sidebar .side-menu li.active a');

sideLinks.forEach(link => {
  link.addEventListener('click', (e) => {
    if (!link.classList.contains('active')) {
      // Supprimer la classe 'active' de tous les liens
      sideLinks.forEach(link => link.parentElement.classList.remove('active'));
      // Ajouter la classe 'active' au lien cliqué
      link.parentElement.classList.add('active');
    }
  });
});

// Réinitialiser le lien actif lorsque le lien "Accueil" est cliqué
homeLink.addEventListener('click', () => {
  sideLinks.forEach(link => link.parentElement.classList.remove('active'));
  homeLink.parentElement.classList.add('active');
});

// Activer le lien correspondant à la page actuelle lors du chargement
window.addEventListener('load', () => {
  const currentURL = window.location.href;
  sideLinks.forEach(link => {
    const linkURL = link.getAttribute('href');
    if (currentURL.includes(linkURL)) {
      link.parentElement.classList.add('active');
    } else {
      link.parentElement.classList.remove('active');
    }
  });
});



const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');



const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});


const images = document.querySelectorAll('.clickable-img');
const textBox = document.getElementById('imageText');

images.forEach(img => {
  img.addEventListener('click', () => {
    textBox.style.display = 'block';
    textBox.textContent = img.getAttribute('data-text');
  });
});

/* Animaciones al hacer scroll */
const elementos = document.querySelectorAll('.fade-in');

function mostrarScroll() {
  elementos.forEach(el => {
    const rect = el.getBoundingClientRect().top;
    if (rect < window.innerHeight - 100) {
      el.classList.add('show');
    }
  });
}

window.addEventListener('scroll', mostrarScroll);
mostrarScroll();

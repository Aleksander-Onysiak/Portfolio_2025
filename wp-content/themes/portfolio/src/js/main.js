document.addEventListener('DOMContentLoaded', () => {
  const spiralItems = document.querySelectorAll('.container.spiral > *');

  spiralItems.forEach(item => {
    if (item instanceof HTMLElement) {
      item.addEventListener('click', () => {
        // Enlever la classe highlight de tous
        spiralItems.forEach(i => {
          if (i instanceof HTMLElement) {
            i.classList.remove('highlight');
          }
        });
        // Ajouter highlight sur l'élément cliqué
        item.classList.add('highlight');
      });
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const galleries = document.querySelectorAll('.gallery_container');

  galleries.forEach(gallery => {
    if (!(gallery instanceof HTMLElement)) return;

    const mainView = gallery.querySelector('.gallery__main');
    const mainImage = mainView instanceof HTMLElement ? mainView.querySelector('.gallery__main-image') : null;
    const closeButton = mainView instanceof HTMLElement ? mainView.querySelector('.close-button') : null;
    const items = gallery.querySelectorAll('.gallery__item');

    if (!(mainView instanceof HTMLElement) || !(mainImage instanceof HTMLImageElement) || !(closeButton instanceof HTMLElement)) return;

    items.forEach(item => {
      if (!(item instanceof HTMLElement)) return;

      item.addEventListener('click', () => {
        const img = item.querySelector('img');
        if (!(img instanceof HTMLImageElement)) return;

        mainImage.src = img.dataset.full || '';
        mainImage.alt = img.alt || '';

        mainView.style.display = 'flex';
        gallery.classList.add('gallery--active');
      });
    });

    closeButton.addEventListener('click', () => {
      mainView.style.display = 'none';
      gallery.classList.remove('gallery--active');
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const sliderImages = document.querySelectorAll('.slider__image');

  sliderImages.forEach(img => {
    if (img instanceof HTMLElement) {
      // accessibility: allow keyboard focus styling on images
      img.setAttribute('tabindex', '0');
    }
  });
});

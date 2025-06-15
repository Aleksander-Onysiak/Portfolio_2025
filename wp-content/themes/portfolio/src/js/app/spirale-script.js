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

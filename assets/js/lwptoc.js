document.addEventListener('DOMContentLoaded', function () {
  const toc = document.querySelector('.lwptoc');
  const postIt = document.querySelector('.post-it');

  if (toc && postIt) {
    toc.style.display = 'block';
    postIt.insertAdjacentElement('afterend', toc);
  }
});
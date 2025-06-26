document.addEventListener('DOMContentLoaded', function () {
  const toc = document.querySelector('.lwptoc');
  const sidebar = document.querySelector('.sidebar-inner');

  if (toc && sidebar) {
    toc.style.display = 'block';
    sidebar.prepend(toc);
  }
});
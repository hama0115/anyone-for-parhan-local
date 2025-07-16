document.addEventListener('DOMContentLoaded', function () {
  const toc = document.querySelector('.lwptoc');
  const postIt = document.querySelector('.post-it');

  if (toc && postIt) {
    toc.style.display = 'block';
    postIt.insertAdjacentElement('afterend', toc);
  }

  // h3グループ（= 子リスト）を全部最初に非表示にする
  const nestedWraps = toc.querySelectorAll('.lwptoc_item > .lwptoc_itemWrap');
  nestedWraps.forEach(wrap => {
    wrap.style.display = 'none';

    // ボタンを h2リンクの横に追加
    const parentItem = wrap.closest('.lwptoc_item');
    const headingLink = parentItem.querySelector('a');

    if (headingLink) {
      const toggleBtn = document.createElement('button');
      toggleBtn.textContent = '+';
      toggleBtn.className = 'toc-toggle-btn';
      toggleBtn.style.marginLeft = '0.5em';
      toggleBtn.style.fontWeight = 'bold';
      toggleBtn.style.cursor = 'pointer';

      headingLink.insertAdjacentElement('afterend', toggleBtn);

      toggleBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const isOpen = wrap.style.display === 'block';
        wrap.style.display = isOpen ? 'none' : 'block';
        toggleBtn.textContent = isOpen ? '+' : '−';
      });
    }
  });
});

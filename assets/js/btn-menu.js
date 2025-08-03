//-- ハンバーガーメニュー --//
const btn = document.querySelector(".btn-menu");
const nav = document.querySelector(".site-menu");

btn.addEventListener("click", () => {
  nav.classList.toggle("open-menu");
});

//-- 目次パネル --//
const tocBtn = document.querySelector(".toc-fixed-button");
const tocPanel = document.querySelector(".toc-panel");
const originalToc = document.querySelector(".lwptoc");
const tocPanelContent = document.getElementById("lwptoc-panel");
const mainContent = document.querySelector(".main-content");
const tocClose = document.getElementById("toc-close");

// 目次を複製
if (originalToc && tocPanelContent) {
  tocPanelContent.innerHTML = originalToc.innerHTML;
  mainContent.insertAdjacentElement('afterbegin', tocPanel);
}

//目次パネルを開閉
tocBtn.addEventListener("click", () => {
  tocPanel.classList.toggle("open-toc");
});

//目次パネルを閉じる
tocClose.addEventListener("click", () => {
  tocPanel.classList.toggle("open-toc");
});
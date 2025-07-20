window.addEventListener("load", () => {

  //要素を取得
  const toc = document.querySelector('.lwptoc');
  const archive = document.querySelector('.archive-block');

  if (toc && archive) {
    //追従させるためのラッパーを作成
    const wrapper = document.createElement('div');
    wrapper.classList.add("fixed-area");

    //DOMにラッパーを挿入し、目次とアーカイブをラッパーの中に移動
    toc.parentNode.insertBefore(wrapper, toc);
    wrapper.append(toc, archive);

    //固定するサイドバーのheightを取得
    const fixedArea = document.querySelector(".fixed-area");
    const fixedAreaHeight = fixedArea.offsetHeight;

    //固定される位置をmainと合わせるためにpadding-topを計算
    const rem = parseFloat(getComputedStyle(document.documentElement).fontSize);
    const offset = 70 + (2 * rem);

    //サイドバーの固定する部分の高さとmainのpadding-topを合算
    const endOffset = fixedAreaHeight + offset;

    //GSAPとScrollTriggerを読み込む
    gsap.registerPlugin(ScrollTrigger);    

    //サイドバーをスクロールに合わせて固定
    ScrollTrigger.create({
      trigger: ".fixed-area",
      start: `top-=${offset} top`,
      endTrigger: ".main-content",  
      end : `bottom-=${endOffset} top`,
      markers: true,
      pin: true,
      pinSpacing: false
    });
  }
});



/* バニラjsで試したもの

const sidebar = document.querySelector('.sidebar');
const bottomTrigger = document.querySelector('.sidebar-bottom-trigger');
const footer = document.querySelector('.footer');

const container = document.querySelector('.container');

const containerRight = 
  window.innerWidth - container.getBoundingClientRect().right;

sidebar.style.right = `${containerRight}px`;

// サイドバーの「下端」が画面に入ったら固定する
const showTrigger = (entries) => {
  const entry = entries[0];
  if (entry.isIntersecting) {
    sidebar.classList.add('fixed');
  } else {
    sidebar.classList.remove('fixed');
  }
};

const scrollObserver = new IntersectionObserver(showTrigger, {
  root: null,
  threshold: 1.0,
});
scrollObserver.observe(bottomTrigger);

// フッターが見えたら固定解除
const stopTrigger = (entries) => {
  if (entries[0].isIntersecting) {
    sidebar.classList.remove('fixed');
  }
};

const footerObserver = new IntersectionObserver(stopTrigger, {
  root: null,
  threshold: 0,
});
footerObserver.observe(footer);
*/
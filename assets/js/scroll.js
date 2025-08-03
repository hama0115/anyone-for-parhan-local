//-- PC版でスクロールすると目次が固定される --//
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
      //markers: true,
      pin: true,
      pinSpacing: false
    });
  }
});
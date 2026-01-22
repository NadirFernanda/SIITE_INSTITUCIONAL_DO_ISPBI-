// Simple vanilla JS carousel: autoplay + prev/next + indicators
(function(){
  const carousel = document.querySelector('.carousel');
  if (!carousel) return;

  const track = carousel.querySelector('.carousel-track');
  const slides = Array.from(carousel.querySelectorAll('.carousel-slide'));
  const prev = carousel.querySelector('.carousel-prev');
  const next = carousel.querySelector('.carousel-next');
  const indicatorsContainer = carousel.querySelector('.carousel-indicators');
  let current = 0;
  let interval = null;
  const delay = 5000;

  function goTo(index){
    current = (index + slides.length) % slides.length;
    const offset = -current * 100;
    track.style.transform = `translateX(${offset}%)`;
    updateIndicators();
  }

  function nextSlide(){ goTo(current + 1); }
  function prevSlide(){ goTo(current - 1); }

  function createIndicators(){
    indicatorsContainer.innerHTML = '';
    slides.forEach((s, i)=>{
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = i===0 ? 'active' : '';
      btn.addEventListener('click', ()=>{ goTo(i); reset(); });
      indicatorsContainer.appendChild(btn);
    });
  }

  function updateIndicators(){
    const btns = Array.from(indicatorsContainer.children);
    btns.forEach((b, i)=> b.classList.toggle('active', i===current));
  }

  function start(){
    interval = setInterval(nextSlide, delay);
  }
  function stop(){ clearInterval(interval); interval = null; }
  function reset(){ stop(); start(); }

  // bind
  if(next) next.addEventListener('click', ()=>{ nextSlide(); reset(); });
  if(prev) prev.addEventListener('click', ()=>{ prevSlide(); reset(); });

  createIndicators();
  goTo(0);
  start();

  // pause on hover
  carousel.addEventListener('mouseenter', stop);
  carousel.addEventListener('mouseleave', start);
})();

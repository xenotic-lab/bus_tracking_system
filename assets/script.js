document.addEventListener('DOMContentLoaded',function(){
  const rl=document.getElementById('routeLine');
  if(rl){
    const style = getComputedStyle(rl);
    const val = rl.style.getPropertyValue('--progress') || '0%';
    let target = parseFloat(val);
    if(isNaN(target)) target = 0;
    let cur = 0;
    const id = setInterval(()=>{ if(cur>=target){ clearInterval(id); } else { cur += Math.max(0.5, target/40); rl.style.setProperty('--progress', cur + '%'); } },20);
  }
});


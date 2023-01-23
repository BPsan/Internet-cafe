const navContainer = document.querySelector('.ul-nav');
const divWindow = document.querySelector('.pop-user');
const all = document.querySelector('body');

  const popClose = (evt) => {
    const element = evt.target.closest('input');
    if(!element){
      divWindow.classList.remove("shown");
      return
    }
  }

  const popOpen = (evt) => {
    const element = evt.target.closest('input');
  
    if(!element){
      return;
    }
    evt.preventDefault();
    if(divWindow.classList.contains("shown")){
      divWindow.classList.remove("shown");
    }else{
      divWindow.classList.add("shown");
    }
  }

  const input = document.querySelector(".tel");

const prefixNumber = (str) => {
  if (str === "7") {
    return "7 (";
  }
  if (str === "8") {
    return "8 (";
  }
  if (str === "9") {
    return "7 (9";
  }
  return "7 (";
};

  const init = () => {
    navContainer.addEventListener("click", popOpen);
    all.addEventListener("click", popClose);
};


init();
function scrollToElement(id, offset = 100) {
    const element = document.getElementById(id);
    if (element) {
      const elementRect = element.getBoundingClientRect();
      const absoluteElementTop = elementRect.top + window.pageYOffset;
      const scrollToY = absoluteElementTop - offset;
  
      window.scrollTo({
        top: scrollToY,
        behavior: "smooth",
      });
    }
  }
  
  const links = document.querySelectorAll(".sub-nav");
  links.forEach((link) => {
    //añadiendo los click a los sub nav
    link.addEventListener("click", () => {
      const idLink = link.textContent.trim().toLowerCase();
      console.log(idLink);
      scrollToElement(idLink);
    //   links.forEach((link) => link.classList.remove("link-proyect"));
    //   link.classList.add("link-proyect");
    });
  });
<script>
  let fa_bars = document.querySelector(".fa-bars"),
    fa_xmark = document.querySelector(".fa-xmark"),
    nav = document.querySelector("nav"),
    cb = document.querySelector("#cb"),
    cb1 = document.querySelector("#cb1"),
    cb2 = document.querySelector("#cb2"),
    sc = document.querySelector("#sc"),
    sc1 = document.querySelector("#sc1"),
    sc2 = document.querySelector("#sc2");

  //main-course list tab
  cb1.addEventListener("click", () => {
    cb.classList.remove("active");
    cb2.classList.remove("active");
    cb1.classList.add("active");
    sc.style.display = "none";
    sc2.style.display = "none";
    sc1.style.display = "flex";
  });

  cb2.addEventListener("click", () => {
    cb.classList.remove("active");
    cb1.classList.remove("active");
    cb2.classList.add("active");
    sc.style.display = "none";
    sc1.style.display = "none";
    sc2.style.display = "flex";
  });

  cb.addEventListener("click", () => {
    cb2.classList.remove("active");
    cb1.classList.remove("active");
    cb.classList.add("active");
    sc2.style.display = "none";
    sc1.style.display = "none";
    sc.style.display = "flex";
  });


  // open nav
  fa_bars.addEventListener("click", () => {
    nav.style.width = "280px";
    fa_bars.style.display = "none";
    fa_xmark.style.display = "block";
  });

  if (window.innerWidth <= 1024) {
    nav.style.display = "none";
    nav.style.position = "fixed";
    nav.style.zIndex = "10";
  }
  if (window.innerWidth <= 768) {
    // open nav
    fa_bars.addEventListener("click", () => {
      nav.style.display = "block";
      nav.style.width = "280px";
      fa_bars.style.display = "none";
      fa_xmark.style.display = "block";
    });

    // close nav
    fa_xmark.addEventListener("click", () => {
      nav.style.display = "none";
      fa_bars.style.display = "block";
      fa_xmark.style.display = "none";
      fa_xmark.style.right = "-10px";
    });
  }
  // close nav
  fa_xmark.addEventListener("click", () => {
    nav.style.width = "90px";
    fa_bars.style.display = "block";
    fa_xmark.style.display = "none";
  });
</script>
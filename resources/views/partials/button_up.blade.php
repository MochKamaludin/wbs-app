<button id="btnUp"
    class="
        hidden
        md:fixed md:bottom-6 md:right-6
        sticky bottom-4 ml-auto mr-4
        bg-blue-600 text-white
        w-11 h-11
        flex items-center justify-center
        rounded-xl shadow-lg
        hover:bg-blue-700 transition
        z-30
    ">
    <i class="fas fa-arrow-up text-xl font-bold"></i>
</button>

<script>
    const btnUp = document.getElementById("btnUp");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 200) {
            btnUp.classList.remove("hidden");
        } else {
            btnUp.classList.add("hidden");
        }
    });

    btnUp.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
</script>

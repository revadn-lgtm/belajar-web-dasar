// ============================
// FORM SUBMIT
// ============================
document.querySelector("form").addEventListener("submit", function(e) {
    e.preventDefault();

    const nama = document.getElementById("nama").value;

    if (nama === "") {
        alert("Nama harus diisi dulu ya!");
    } else {
        alert("Terima kasih, " + nama + " 😊");
    }
});


// ============================
// UBAH BACKGROUND SESUAI WARNA
// ============================
const colorInput = document.getElementById("warna");

colorInput.addEventListener("input", function() {
    document.body.style.backgroundColor = this.value;
});


// ============================
// ZOOM GAMBAR
// ============================
const img = document.querySelector(".img-wrapper img");

img.addEventListener("click", function() {
    this.classList.toggle("zoomed");
});


// ============================
// ANIMASI SCROLL
// ============================
const cards = document.querySelectorAll(".card");

window.addEventListener("scroll", function() {
    cards.forEach(card => {
        const rect = card.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            card.style.opacity = 1;
            card.style.transform = "translateY(0)";
        }
    });
});


// ============================
// JAM REAL-TIME
// ============================
function updateJam() {
    const now = new Date();
    const jamElement = document.getElementById("jam");
    
    if (jamElement) {
        jamElement.innerText = now.toLocaleTimeString();
    }
}

setInterval(updateJam, 1000);
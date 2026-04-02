let currentIndex = 0;
const images = document.querySelectorAll('.slides img');
const total = images.length;
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

function showImage(index) {
    if (!images.length) return; // Kiểm tra nếu không có ảnh
    images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
    });
}

function nextImage() {
    if (!images.length) return;
    currentIndex = (currentIndex + 1) % total;
    showImage(currentIndex);
}

function prevImage() {
    if (!images.length) return;
    currentIndex = (currentIndex - 1 + total) % total;
    showImage(currentIndex);
}

if (nextBtn && prevBtn) {
    nextBtn.addEventListener('click', nextImage);
    prevBtn.addEventListener('click', prevImage);
}

setInterval(nextImage, 3000); // Tự động chuyển ảnh sau mỗi 3s
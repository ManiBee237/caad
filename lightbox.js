function initLightbox() {
    // Create lightbox HTML
    const lightboxHTML = `
        <div class="lightbox" id="galleryLightbox">
            <button class="lightbox-close" id="lightboxClose">&times;</button>
            <button class="lightbox-prev" id="lightboxPrev">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24"><path d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button class="lightbox-next" id="lightboxNext">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24"><path d="M9 5l7 7-7 7" /></svg>
            </button>
            <div class="lightbox-content">
                <img class="lightbox-img" id="lightboxImg" src="" alt="Gallery Image fullscreen">
                <div class="lightbox-caption" id="lightboxCaption"></div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', lightboxHTML);

    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const closeBtn = document.getElementById('lightboxClose');
    const prevBtn = document.getElementById('lightboxPrev');
    const nextBtn = document.getElementById('lightboxNext');

    let currentItems = [];
    let currentIndex = 0;

    // Attach click to all gallery items and poster cards
    const galleryItems = document.querySelectorAll('.facility-gallery-item, .poster-card');
    if (galleryItems.length === 0) return;

    currentItems = Array.from(galleryItems).map(item => {
        const img = item.querySelector('img');
        const h4 = item.querySelector('h4');
        const p = item.querySelector('p');
        return {
            src: img ? img.src : '',
            caption: (h4 ? h4.innerText + ' - ' : '') + (p ? p.innerText : '')
        };
    });

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            currentIndex = index;
            updateLightbox();
            openLightbox();
        });
    });

    function updateLightbox() {
        const data = currentItems[currentIndex];
        lightboxImg.src = data.src;
        lightboxCaption.innerText = data.caption;
    }

    function openLightbox() {
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function prevImage() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : currentItems.length - 1;
        updateLightbox();
    }

    function nextImage() {
        currentIndex = (currentIndex < currentItems.length - 1) ? currentIndex + 1 : 0;
        updateLightbox();
    }

    closeBtn.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', (e) => { e.stopPropagation(); prevImage(); });
    nextBtn.addEventListener('click', (e) => { e.stopPropagation(); nextImage(); });

    // Close when clicking outside the image
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox || e.target.classList.contains('lightbox-content')) {
            closeLightbox();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLightbox);
} else {
    initLightbox();
}

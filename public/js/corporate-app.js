/**
 * Mais Agro House - Corporate Core JavaScript
 * Native Vanilla JS - Zero runtime blockers
 */

document.addEventListener('DOMContentLoaded', function () {
  // 0. Hero Video Autoplay Handler (graceful fallback for mobile)
  const heroVideo = document.getElementById('heroVideo');
  if (heroVideo) {
    const playPromise = heroVideo.play();
    if (playPromise !== undefined) {
      playPromise.catch(function () {
        // Autoplay blocked — poster image will show as fallback
        heroVideo.style.display = 'none';
        // Show fallback static image
        const fallbackImg = heroVideo.querySelector('img.hm-hero-img-bg');
        if (fallbackImg) {
          heroVideo.parentNode.insertBefore(fallbackImg, heroVideo);
          fallbackImg.style.display = 'block';
        }
      });
    }
  }

  // 1. Sticky Navbar Scroll State
  const header = document.querySelector('.hm-header');
  if (header) {
    const handleScroll = () => {
      if (window.scrollY > 40) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    };
    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // 2. Animated Counter for Statistics
  const counters = document.querySelectorAll('.hm-counter');
  if (counters.length > 0 && 'IntersectionObserver' in window) {
    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const targetStr = el.getAttribute('data-target') || el.innerText;
          const numMatch = targetStr.match(/[\d\.]+/);
          if (numMatch) {
            const finalNum = parseFloat(numMatch[0]);
            const prefix = targetStr.split(numMatch[0])[0] || '';
            const suffix = targetStr.split(numMatch[0])[1] || '';
            let current = 0;
            const step = finalNum / 40;
            const timer = setInterval(() => {
              current += step;
              if (current >= finalNum) {
                el.innerText = prefix + (Number.isInteger(finalNum) ? finalNum : finalNum.toFixed(1)) + suffix;
                clearInterval(timer);
              } else {
                el.innerText = prefix + Math.floor(current) + suffix;
              }
            }, 30);
          }
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(c => counterObserver.observe(c));
  }

  // 3. AJAX Contact Form Submission
  const contactForm = document.getElementById('corporateContactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const submitBtn = contactForm.querySelector('button[type="submit"]');
      const alertBox = document.getElementById('contactFormAlert');
      const originalText = submitBtn.innerHTML;

      // Clear previous error messages
      contactForm.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
      contactForm.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      if (alertBox) alertBox.innerHTML = '';

      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Submitting Dispatch...';

      const formData = new FormData(contactForm);

      fetch(contactForm.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(async response => {
        const data = await response.json();
        if (response.ok && data.success) {
          contactForm.reset();
          if (alertBox) {
            alertBox.innerHTML = `
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                <div>
                  <h6 class="mb-1 fw-bold">Inquiry Dispatched Successfully</h6>
                  <p class="mb-0 text-sm">${data.message} Ref: <strong>${data.data ? data.data.reference : ''}</strong></p>
                </div>
              </div>
            `;
          }
          showToast('Success', data.message, 'success');
        } else {
          // Validation error
          if (data.errors) {
            Object.keys(data.errors).forEach(field => {
              const input = contactForm.querySelector(`[name="${field}"]`);
              if (input) {
                input.classList.add('is-invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.innerText = data.errors[field][0];
                input.parentNode.appendChild(errorDiv);
              }
            });
          }
          if (alertBox) {
            alertBox.innerHTML = `
              <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                ${data.message || 'Please correct the highlighted form errors and try again.'}
              </div>
            `;
          }
        }
      })
      .catch(err => {
        console.error(err);
        if (alertBox) {
          alertBox.innerHTML = `
            <div class="alert alert-danger" role="alert">
              An unexpected network transmission error occurred. Please contact our direct lines: +91 80080 07062 or +91 90090 08014.
            </div>
          `;
        }
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      });
    });
  }

  // 4. AJAX Product / Service RFQ Modal Form
  const enquiryForm = document.getElementById('corporateEnquiryForm');
  if (enquiryForm) {
    enquiryForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const submitBtn = enquiryForm.querySelector('button[type="submit"]');
      const alertBox = document.getElementById('enquiryFormAlert');
      const originalText = submitBtn.innerHTML;

      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Submitting RFQ...';

      const formData = new FormData(enquiryForm);

      fetch(enquiryForm.action, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(async response => {
        const data = await response.json();
        if (response.ok && data.success) {
          enquiryForm.reset();
          if (alertBox) {
            alertBox.innerHTML = `
              <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> ${data.message} Ref: <strong>${data.reference_no}</strong>
              </div>
            `;
          }
          showToast('RFQ Registered', data.message, 'success');
          setTimeout(() => {
            const modalEl = document.getElementById('enquiryModal');
            if (modalEl && window.bootstrap) {
              const modal = bootstrap.Modal.getInstance(modalEl);
              if (modal) modal.hide();
            }
          }, 2500);
        } else {
          if (alertBox) {
            alertBox.innerHTML = `
              <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> ${data.message || 'Please fill in all required fields.'}
              </div>
            `;
          }
        }
      })
      .catch(err => {
        console.error(err);
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
      });
    });
  }

  // 5. Dynamic Lightbox Viewer
  const lightbox = document.getElementById('hmLightbox');
  const lightboxImg = document.getElementById('hmLightboxImg');
  const lightboxClose = document.getElementById('hmLightboxClose');

  document.querySelectorAll('.hm-lightbox-trigger').forEach(trigger => {
    trigger.addEventListener('click', function (e) {
      e.preventDefault();
      const src = this.getAttribute('data-image') || this.getAttribute('href');
      if (lightbox && lightboxImg && src) {
        lightboxImg.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
    });
  });

  if (lightboxClose) {
    lightboxClose.addEventListener('click', () => {
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
    });
  }

  if (lightbox) {
    lightbox.addEventListener('click', (e) => {
      if (e.target === lightbox) {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
      }
    });
  }

  // 5. Harsh Group Inspired Cinematic Banner Slider
  const slides = document.querySelectorAll('.hm-slide');
  const dots = document.querySelectorAll('.hm-slider-dot');
  const prevBtn = document.querySelector('.hm-slider-prev');
  const nextBtn = document.querySelector('.hm-slider-next');
  let currentSlideIndex = 0;
  let slideInterval = null;

  function showSlide(index) {
    if (!slides.length) return;
    if (index >= slides.length) index = 0;
    if (index < 0) index = slides.length - 1;

    slides.forEach((s, i) => {
      s.classList.toggle('active', i === index);
    });

    dots.forEach((d, i) => {
      d.classList.toggle('active', i === index);
    });

    currentSlideIndex = index;
  }

  function nextSlide() {
    showSlide(currentSlideIndex + 1);
  }

  function prevSlide() {
    showSlide(currentSlideIndex - 1);
  }

  function startSlideTimer() {
    stopSlideTimer();
    slideInterval = setInterval(nextSlide, 6500);
  }

  function stopSlideTimer() {
    if (slideInterval) {
      clearInterval(slideInterval);
      slideInterval = null;
    }
  }

  if (slides.length > 0) {
    if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); startSlideTimer(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); startSlideTimer(); });

    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => {
        showSlide(idx);
        startSlideTimer();
      });
    });

    const bannerContainer = document.querySelector('.hm-banner-slider');
    if (bannerContainer) {
      bannerContainer.addEventListener('mouseenter', stopSlideTimer);
      bannerContainer.addEventListener('mouseleave', startSlideTimer);
    }

    startSlideTimer();
  }

  // 6. Harsh Group Style Project Filter
  const projectFilters = document.querySelectorAll('.hm-project-filter-btn');
  const projectCards = document.querySelectorAll('.hm-project-item');
  if (projectFilters.length > 0 && projectCards.length > 0) {
    projectFilters.forEach(btn => {
      btn.addEventListener('click', function () {
        projectFilters.forEach(b => b.classList.remove('active', 'btn-primary'));
        projectFilters.forEach(b => b.classList.add('btn-outline-secondary'));
        this.classList.remove('btn-outline-secondary');
        this.classList.add('active', 'btn-primary');

        const filter = this.getAttribute('data-filter');
        projectCards.forEach(card => {
          if (filter === 'all' || card.getAttribute('data-category') === filter || card.getAttribute('data-status') === filter) {
            card.style.display = 'block';
            card.classList.add('fade-in');
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // 7. Harsh Group Style EMI / Investment Calculator
  const calcBtn = document.getElementById('hmCalculateEmiBtn');
  if (calcBtn) {
    calcBtn.addEventListener('click', function () {
      const amount = parseFloat(document.getElementById('emiAmount').value) || 0;
      const rate = parseFloat(document.getElementById('emiRate').value) || 8.5;
      const tenureYears = parseFloat(document.getElementById('emiTenure').value) || 15;

      if (amount > 0 && rate > 0 && tenureYears > 0) {
        const monthlyRate = (rate / 12) / 100;
        const totalMonths = tenureYears * 12;
        const emi = (amount * monthlyRate * Math.pow(1 + monthlyRate, totalMonths)) / (Math.pow(1 + monthlyRate, totalMonths) - 1);
        const totalPayment = emi * totalMonths;
        const totalInterest = totalPayment - amount;

        document.getElementById('emiResultMonthly').innerText = '₹ ' + Math.round(emi).toLocaleString('en-IN');
        document.getElementById('emiResultTotal').innerText = '₹ ' + Math.round(totalPayment).toLocaleString('en-IN');
        document.getElementById('emiResultInterest').innerText = '₹ ' + Math.round(totalInterest).toLocaleString('en-IN');
        document.getElementById('emiResultBox').style.display = 'block';
      }
    });
  }

  // Helper: Toast notifications
  function showToast(title, message, type = 'info') {
    let container = document.getElementById('hmToastContainer');
    if (!container) {
      container = document.createElement('div');
      container.id = 'hmToastContainer';
      container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
      container.style.zIndex = '1090';
      document.body.appendChild(container);
    }

    const toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-bg-${type === 'success' ? 'dark' : 'primary'} border-0 show shadow-lg`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastEl.innerHTML = `
      <div class="d-flex">
        <div class="toast-body">
          <strong class="d-block mb-1 text-warning">${title}</strong>
          ${message}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    `;
    container.appendChild(toastEl);
    setTimeout(() => {
      toastEl.remove();
    }, 4500);
  }

  // Floating WhatsApp Widget Dropup toggle
  const waWrap = document.querySelector('.hm-float-whatsapp-wrap');
  const waBtn = document.getElementById('hmFloatWhatsappBtn');
  const waPopup = document.getElementById('hmWhatsappPopup');

  if (waBtn && waPopup) {
    waBtn.addEventListener('click', function (e) {
      if (window.innerWidth >= 992) {
        if (!waPopup.classList.contains('is-active')) {
          e.preventDefault();
          waPopup.classList.add('is-active');
        }
      }
    });

    document.addEventListener('click', function (e) {
      if (waWrap && !waWrap.contains(e.target)) {
        waPopup.classList.remove('is-active');
      }
    });
  }

  window.showCorporateToast = showToast;
});

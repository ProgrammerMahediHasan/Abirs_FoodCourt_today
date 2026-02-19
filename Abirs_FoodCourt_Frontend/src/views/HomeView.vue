<script setup>
import AboutView from './AboutView.vue'
import ContactView from './ContactView.vue'
import heroVideo from '@/assets/home-video.mp4'
</script>

<template>
  <div>
    <section class="mb-5 home-menu-section">
      <div class="home-hero-video-wrapper">
        <video
          :src="heroVideo"
          class="home-hero-video"
          autoplay
          muted
          loop
          playsinline
        />
        <div class="home-hero-overlay">
          <div class="home-hero-content">
            <p class="home-hero-eyebrow">
              Welcome To Abir's FoodCourt
            </p>
            <h1 class="home-hero-title">
              Home of Delicious Food &amp; Fast Delivery
            </h1>
            <p class="home-hero-subtitle">
              Explore our menu, learn about us, and get in touch from one place.
            </p>
            <div class="home-hero-actions">
              <router-link
                to="/products"
                class="btn home-hero-btn home-hero-btn-primary"
              >
                Explore Menu
              </router-link>
              <router-link
                to="/contact"
                class="btn home-hero-btn home-hero-btn-secondary"
              >
                Contact Us
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-5 home-about-block">
      <AboutView />
    </section>

    <div class="mt-5">
      <ContactView />
    </div>
  </div>
</template>

<style scoped>
.home-menu-section {
  border-radius: 1.5rem;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(15, 23, 42, 0.35);
}

.home-about-block {
  border-radius: 1.5rem;
  overflow: hidden;
}

:deep(.home-about-block .about-page > section:not(.about-testimonials):not(.about-team)) {
  display: none;
}

.home-hero-video-wrapper {
  position: relative;
  width: 100%;
  min-height: 260px;
}

.home-hero-video {
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
}

.home-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    120deg,
    rgba(15, 23, 42, 0.9),
    rgba(15, 23, 42, 0.65),
    rgba(15, 23, 42, 0.25)
  );
  display: flex;
  align-items: center;
}

.home-hero-content {
  padding: 2.25rem 2rem;
  max-width: 520px;
  color: #ffffff;
}

.home-hero-eyebrow {
  font-size: 0.75rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: #fed7aa;
  margin-bottom: 0.5rem;
}

.home-hero-title {
  font-size: 1.9rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
}

.home-hero-subtitle {
  font-size: 0.95rem;
  color: #e5e7eb;
}

.home-hero-actions {
  margin-top: 1.5rem;
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.home-hero-btn {
  border-radius: 999px;
  padding: 0.5rem 1.35rem;
  font-size: 0.9rem;
  font-weight: 600;
}

.home-hero-btn-primary {
  background-color: #ff7f50;
  border-color: #ff7f50;
  color: #111827;
}

.home-hero-btn-primary:hover,
.home-hero-btn-primary:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
  color: #111827;
}

.home-hero-btn-secondary {
  background-color: transparent;
  border-color: #e5e7eb;
  color: #f9fafb;
}

.home-hero-btn-secondary:hover,
.home-hero-btn-secondary:focus {
  background-color: rgba(249, 250, 251, 0.12);
  border-color: #ffffff;
  color: #ffffff;
}

@media (max-width: 768px) {
  .home-hero-content {
    padding: 1.75rem 1.5rem;
  }

  .home-hero-title {
    font-size: 1.5rem;
  }
}

</style>

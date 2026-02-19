<script setup>
const featureItems = [
  {
    title: 'Chef-Curated Menu',
    description: 'Signature recipes and bestsellers, carefully selected for every mood.',
  },
  {
    title: 'Smooth Online Ordering',
    description: 'Browse, add to cart, and confirm your order in just a few taps.',
  },
  {
    title: 'Secure Account & Tracking',
    description: 'Create an account, save your details, and follow every order in real time.',
  },
  {
    title: 'Smart Categories & Filters',
    description: 'Quickly find your cravings by cuisine, category, or dietary preference.',
  },
]

const statItems = [
  { value: '120+', label: 'Menu Items' },
  { value: '15k+', label: 'Happy Customers' },
  { value: '4.9', label: 'Average Rating' },
]

const testimonials = [
  {
    name: 'Cristrofar Henry',
    role: 'Guest',
    quote:
      "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything hidden in the middle of text. All the Lorem Ipsum generators, to use a passage of Lorem Ipsum.",
    rating: 5,
  },
  {
    name: 'Jonathon Smith',
    role: 'Guest',
    quote:
      "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything hidden in the middle of text. All the Lorem Ipsum generators, to use a passage of Lorem Ipsum.",
    rating: 4.5,
  },
  {
    name: 'David Von',
    role: 'Guest',
    quote:
      'All the Lorem Ipsum generators, If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything hidden in the middle of text.',
    rating: 4.8,
  },
]

import { ref, computed, onMounted, onUnmounted } from 'vue'
import headChef from '@/assets/Head-Chef.png'
import steakVideo from '@/assets/steak.mp4'
import vegetablesImg from '@/assets/vegetables.jpg'
import sousAvatar from '@/assets/Sous.png'
import pastryAvatar from '@/assets/Pastry.png'
import sousChef from '@/assets/Sous.png'
import pastryChef from '@/assets/Pastry.png'

const teamMembers = ref([
  {
    name: 'Abir Khan',
    role: 'Head Chef',
    initials: 'AK',
    photo: headChef,
  },
  {
    name: 'Sara Islam',
    role: 'Sous Chef',
    initials: 'SI',
    photo: sousChef,
  },
  {
    name: 'Nafis Rahman',
    role: 'Pastry Chef',
    initials: 'NR',
    photo: pastryChef,
  },
])

function onImgError(e, member) {
  member.photo = ''
}

const brands = ['Foodpanda', 'DoorDash', 'UberEats', 'Bolt Food', 'HungryNaki']

const aboutImage = ref(vegetablesImg)
function clearAboutImage() {
  aboutImage.value = ''
}
const aboutVideo = ref(steakVideo)
function onVideoError() {
  aboutVideo.value = ''
}

const showPreview = ref(false)
const videoUrl = ref('http://localhost/Abirs_FoodCourt/public/assets/videos/foodcourt-preview.mp4')
function openPreview() {
  showPreview.value = true
}
function closePreview() {
  showPreview.value = false
  const vid = document.getElementById('aboutVideo')
  if (vid) {
    vid.pause()
  }
}

const heroStyle = computed(() => {
  return {
    backgroundImage: `linear-gradient(to right, rgba(0,0,0,.85) 0%, rgba(0,0,0,.65) 42%, rgba(0,0,0,.3) 70%, rgba(0,0,0,.1) 100%), url(${vegetablesImg})`,
    backgroundSize: 'cover',
    backgroundPosition: 'center center',
    backgroundRepeat: 'no-repeat',
  }
})

const testimonialAvatars = [headChef, sousAvatar, pastryAvatar]
const currentTestimonial = ref(0)
let testimonialTimer = null
function nextTestimonial() {
  currentTestimonial.value = (currentTestimonial.value + 1) % testimonials.length
}
function prevTestimonial() {
  currentTestimonial.value =
    (currentTestimonial.value - 1 + testimonials.length) % testimonials.length
}
function goToTestimonial(i) {
  currentTestimonial.value = i
}
function startAutoRotate() {
  stopAutoRotate()
  testimonialTimer = setInterval(nextTestimonial, 4000)
}
function stopAutoRotate() {
  if (testimonialTimer) {
    clearInterval(testimonialTimer)
    testimonialTimer = null
  }
}
function starIcon(i, rating) {
  const full = Math.floor(rating)
  const hasHalf = rating - full >= 0.5
  if (i <= full) return 'bi bi-star-fill'
  if (i === full + 1 && hasHalf) return 'bi bi-star-half'
  return 'bi bi-star'
}
onMounted(() => {
  startAutoRotate()
})
onUnmounted(() => {
  stopAutoRotate()
})
</script>

<template>
  <div class="about-page">
    <section
      class="about-hero"
      :style="heroStyle"
    >
      <div class="container py-5 position-relative">
        <div class="hero-decor hero-decor-left">
          <span class="diamond d1" />
          <span class="diamond d2" />
        </div>
        <h1 class="hero-title mb-2">About Us</h1>
        <div class="breadcrumb-wrap">
          <a href="/" class="breadcrumb-link">Home</a>
          <span class="breadcrumb-chevron">»</span>
          <span class="breadcrumb-current">About Us</span>
        </div>
        <div class="hero-decor hero-decor-right">
          <span class="diamond d3" />
        </div>
      </div>
    </section>

    <section class="container py-5">
      <div class="row align-items-center g-4 mb-4">
        <div class="col-md-6">
          <div class="about-image-wrapper shadow-sm">
            <div class="about-badge">
              24/7
              <span class="small d-block">Order Anytime</span>
            </div>
            <video
              v-if="aboutVideo"
              :src="aboutVideo"
              class="about-video"
              autoplay
              muted
              loop
              playsinline
              @error="onVideoError"
            />
            <img
              v-else-if="aboutImage"
              :src="aboutImage"
              alt="About Us"
              class="about-image"
              @error="clearAboutImage"
            />
          </div>
        </div>
        <div class="col-md-6">
          <h2 class="fw-bold mb-3">Fresh, Fast &amp; Unforgettable Flavour</h2>
          <p class="text-muted mb-3">
            Abir's FoodCourt is your modern digital food court — a place to discover chef-crafted
            dishes, explore a carefully curated menu, and order your favourites in just a few simple
            steps.
          </p>
          <p class="text-muted mb-4">
            From quality ingredients and consistent taste to reliable delivery and a smooth
            interface, we focus on the details so you can focus on enjoying every bite, every time.
          </p>

          <div class="row">
            <div
              v-for="item in featureItems"
              :key="item.title"
              class="col-6 mb-3"
            >
              <div class="d-flex">
                <span class="about-check me-2">✓</span>
                <div>
                  <h6 class="mb-1">{{ item.title }}</h6>
                  <p class="small text-muted mb-0">
                    {{ item.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center about-stats">
        <div
          v-for="stat in statItems"
          :key="stat.label"
          class="col-md-4 mb-3"
        >
          <div class="stat-card">
            <div class="stat-value">{{ stat.value }}</div>
            <div class="stat-label">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <section class="about-testimonials py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mb-4">
            <h2 class="fw-bold">What Our Guests Say</h2>
            <p class="text-muted">Real words from real customers about their experience.</p>
          </div>
        </div>

        <div
          class="testimonial-carousel"
          @mouseenter="stopAutoRotate"
          @mouseleave="startAutoRotate"
        >
          <button
            type="button"
            class="carousel-nav prev"
            aria-label="Previous"
            @click="prevTestimonial"
          >
            ‹
          </button>
          <button
            type="button"
            class="carousel-nav next"
            aria-label="Next"
            @click="nextTestimonial"
          >
            ›
          </button>

          <div class="carousel-slides">
            <div
              v-for="(t, i) in testimonials"
              :key="t.name"
              class="carousel-slide"
              :class="{ active: currentTestimonial === i }"
            >
              <div class="testimonial-card">
                <div class="testimonial-header">
                  <div class="testimonial-avatar">
                    <img
                      :src="testimonialAvatars[i % testimonialAvatars.length]"
                      alt=""
                    />
                  </div>
                  <div>
                    <div class="author-name">{{ t.name }}</div>
                    <div class="author-role text-muted small">{{ t.role }}</div>
                    <div class="testimonial-stars">
                      <i
                        v-for="s in 5"
                        :key="s"
                        :class="starIcon(s, t.rating)"
                      />
                    </div>
                  </div>
                </div>
                <div class="testimonial-quote-icon">“</div>
                <p class="testimonial-text">{{ t.quote }}</p>
              </div>
            </div>
          </div>

          <div class="carousel-dots">
            <button
              v-for="(t, i) in testimonials"
              :key="t.name + '-dot'"
              type="button"
              class="dot"
              :class="{ active: currentTestimonial === i }"
              @click="goToTestimonial(i)"
              aria-label="Go to slide"
            />
          </div>
        </div>
      </div>
    </section>

    <section class="about-team py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mb-4">
            <h2 class="fw-bold">Meet Our Chef Team</h2>
            <p class="text-muted">Experienced chefs dedicated to taste and quality.</p>
          </div>
        </div>
        <div class="row">
          <div
            v-for="m in teamMembers"
            :key="m.name"
            class="col-md-4 mb-3"
          >
            <div class="team-card h-100">
              <div class="team-avatar">
                <img
                  v-if="m.photo"
                  :src="m.photo"
                  :alt="m.name"
                  class="team-avatar-img"
                  @error="onImgError($event, m)"
                />
                <span
                  v-else
                  class="team-avatar-fallback"
                >
                  {{ m.initials }}
                </span>
              </div>
              <div class="team-name">{{ m.name }}</div>
              <div class="team-role-badge">{{ m.role }}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="about-cta">
      <div class="container py-5">
        <div class="cta-card">
          <div>
            <h3 class="cta-title">Craving Something Delicious?</h3>
            <p class="cta-subtitle">Browse our menu and order now.</p>
          </div>
          <router-link class="btn btn-light" to="/products">Explore Menu</router-link>
        </div>
      </div>
    </section>

    <section class="about-brands">
      <div class="container py-4">
        <div class="brands-row">
          <div
            v-for="b in brands"
            :key="b"
            class="brand-badge"
          >
            {{ b }}
          </div>
        </div>
      </div>
    </section>

    <div
      v-if="showPreview"
      class="video-modal"
      @click.self="closePreview"
    >
      <div class="video-modal-card">
        <button
          type="button"
          class="video-modal-close"
          aria-label="Close"
          @click="closePreview"
        >
          ×
        </button>
        <video
          id="aboutVideo"
          :src="videoUrl"
          controls
          autoplay
          playsinline
          class="video-player"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.about-page {
  background-color: #fffaf6;
}

.about-hero {
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  color: #fff;
  min-height: 280px;
  display: flex;
  align-items: center;
}
.breadcrumb-wrap {
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.breadcrumb-link {
  color: #fff;
  text-decoration: none;
}
.breadcrumb-link:hover {
  text-decoration: underline;
}
.breadcrumb-chevron,
.breadcrumb-current {
  color: #f2c16b;
}
.breadcrumb-current {
  font-weight: 600;
}
.hero-title {
  font-family: Georgia, 'Times New Roman', serif;
  font-size: 2.25rem;
  font-weight: 600;
}
.hero-decor {
  position: absolute;
  pointer-events: none;
}
.hero-decor-left {
  left: 24px;
  bottom: 24px;
  display: flex;
  gap: 18px;
}
.hero-decor-right {
  right: 24px;
  top: 24px;
}
.diamond {
  width: 42px;
  height: 42px;
  border: 1px solid rgba(242, 193, 107, 0.8);
  transform: rotate(45deg);
  display: inline-block;
}
.diamond.d2 {
  width: 34px;
  height: 34px;
}
.diamond.d3 {
  width: 28px;
  height: 28px;
}

.about-check {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background-color: #ff7f50;
  color: #fff;
  font-size: 0.75rem;
}

.about-image-wrapper {
  position: relative;
  border-radius: 1rem;
  overflow: hidden;
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  height: 420px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.about-video {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.about-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.about-image-placeholder {
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 0.75rem;
  padding: 1.5rem 2rem;
}

.about-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  background-color: #000;
  color: #fff;
  padding: 0.5rem 0.75rem;
  border-radius: 0.75rem;
  font-weight: 600;
  font-size: 0.85rem;
  text-align: center;
}

.about-video-trigger {
  position: absolute;
  bottom: 16px;
  right: 16px;
  background: rgba(255, 255, 255, 0.9);
  color: #333;
  border: none;
  border-radius: 999px;
  padding: 0.5rem 0.75rem;
  font-weight: 600;
  font-size: 0.9rem;
  cursor: pointer;
}
.about-video-trigger:hover {
  background: #fff;
}

.about-stats .stat-card {
  background: #fff;
  border-radius: 1rem;
  padding: 1rem 0.75rem;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
}
.stat-value {
  font-size: 2rem;
  font-weight: 700;
  color: #ff7f50;
}
.stat-label {
  font-size: 0.9rem;
  color: #666;
}

.about-testimonials {
  background: linear-gradient(135deg, #fff7f2, #ffe9dc);
}
.testimonial-carousel {
  position: relative;
  max-width: 880px;
  margin: 0 auto;
}
.carousel-slides {
  position: relative;
  display: grid;
}
.carousel-slide {
  position: relative;
  grid-area: 1 / 1;
  opacity: 0;
  transform: translateX(24px) scale(0.98);
  transition: opacity 420ms ease, transform 420ms ease, box-shadow 420ms ease;
}
.carousel-slide.active {
  opacity: 1;
  transform: translateX(0) scale(1);
}
.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 127, 80, 0.12);
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 999px;
  font-size: 1.25rem;
  cursor: pointer;
  color: #ff7f50;
  backdrop-filter: blur(4px);
}
.carousel-nav.prev {
  left: -14px;
}
.carousel-nav.next {
  right: -14px;
}
.carousel-dots {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 12px;
}
.dot {
  width: 8px;
  height: 8px;
  border-radius: 999px;
  background: #e5e5e5;
  border: none;
}
.dot.active {
  background: #ff7f50;
}
.testimonial-card {
  background: rgba(255, 255, 255, 0.9);
  border-radius: 1rem;
  padding: 1.5rem;
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.08);
  border: 1px solid rgba(255, 127, 80, 0.18);
  backdrop-filter: saturate(180%) blur(8px);
}
.testimonial-header {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: 8px;
}
.testimonial-avatar {
  width: 54px;
  height: 54px;
  border-radius: 999px;
  overflow: hidden;
  border: 2px solid transparent;
  background:
    linear-gradient(#fff, #fff) padding-box,
    linear-gradient(135deg, #ff7f50, #ffb26b) border-box;
}
.testimonial-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.testimonial-quote-icon {
  font-size: 2.25rem;
  line-height: 1;
  color: #ff7f50;
}
.testimonial-text {
  font-size: 1rem;
  color: #555;
  margin-top: 0.75rem;
}
.testimonial-author {
  margin-top: 0.75rem;
}
.author-name {
  font-weight: 600;
}
.testimonial-stars {
  color: #ffb26b;
  font-size: 1rem;
}

.about-team {
  background: #fff;
}
.team-card {
  background: #fff;
  border-radius: 1rem;
  padding: 1.25rem;
  text-align: center;
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}
.team-avatar {
  width: 96px;
  height: 96px;
  border-radius: 999px;
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-weight: 700;
  margin-bottom: 0.75rem;
}
.team-avatar-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: inherit;
  display: block;
}
.team-avatar-fallback {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}
.team-name {
  font-weight: 600;
}
.team-role-badge {
  margin-top: 6px;
  display: inline-block;
  padding: 0.25rem 0.5rem;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 600;
  background: #ff7f50;
  color: #fff;
}

.about-cta {
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  color: #fff;
}
.cta-card {
  background: rgba(0, 0, 0, 0.15);
  border-radius: 1rem;
  padding: 1.25rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}
.cta-title {
  margin: 0;
}
.cta-subtitle {
  margin: 0;
  opacity: 0.9;
}

.about-brands {
  background: #fff;
}
.brands-row {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  align-items: center;
  justify-content: center;
}
.brand-badge {
  padding: 0.5rem 0.75rem;
  border-radius: 999px;
  background: #f4f4f4;
  color: #333;
  font-weight: 600;
  font-size: 0.9rem;
}

.video-modal {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
}
.video-modal-card {
  position: relative;
  width: min(960px, 92vw);
  background: #000;
  border-radius: 0.75rem;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
}
.video-player {
  display: block;
  width: 100%;
  height: auto;
}
.video-modal-close {
  position: absolute;
  top: 8px;
  right: 12px;
  background: rgba(255, 255, 255, 0.2);
  border: none;
  color: #fff;
  width: 36px;
  height: 36px;
  border-radius: 999px;
  font-size: 1.25rem;
  cursor: pointer;
}
.video-modal-close:hover {
  background: rgba(255, 255, 255, 0.3);
}
</style>

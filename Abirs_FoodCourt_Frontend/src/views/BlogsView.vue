<script setup>
import heroImg from '@/assets/food.jpg'
const assetImages = Object.values(
  import.meta.glob('@/assets/*.{png,jpg,jpeg}', { eager: true, import: 'default' })
)
const assetsMap = import.meta.glob('@/assets/*.{png,jpg,jpeg}', { eager: true, import: 'default' })
const blogHero =
  assetsMap['/src/assets/blog-hero.jpg'] ||
  assetsMap['/src/assets/blog_hero.jpg'] ||
  assetsMap['/src/assets/blogHero.jpg'] ||
  heroImg

const basePosts = [
  {
    id: 1,
    title: 'Lorem ipsum dolor sit amet',
    author: 'Admin',
    category: 'Food',
    date: '01-Jan-2026',
    comments: 10,
    excerpt:
      'Lorem ipsum dolor sit amet elit. Neca pretim miura bitur facili ornare velit non vulpte liqum metus tortor.',
  },
  {
    id: 2,
    title: 'Seasonal specials and tips',
    author: 'Admin',
    category: 'Food',
    date: '12-Feb-2026',
    comments: 6,
    excerpt:
      'Curated dishes for the season. Discover flavors and cooking insights for your kitchen.',
  },
  {
    id: 3,
    title: 'Behind the kitchen',
    author: 'Admin',
    category: 'Food',
    date: '20-Mar-2026',
    comments: 14,
    excerpt:
      'A look at how our chefs prepare signature plates with care and precision.',
  },
  {
    id: 4,
    title: 'Healthy choices you’ll love',
    author: 'Admin',
    category: 'Food',
    date: '09-Apr-2026',
    comments: 8,
    excerpt:
      'Fresh ingredients and balanced meals that taste great and keep you energized.',
  },
  {
    id: 5,
    title: 'Sweet delights from our pastry',
    author: 'Admin',
    category: 'Food',
    date: '25-May-2026',
    comments: 12,
    excerpt:
      'Desserts crafted by our pastry team, combining classic techniques with modern twists.',
  },
  {
    id: 6,
    title: 'Chef’s corner: tips & tricks',
    author: 'Admin',
    category: 'Food',
    date: '30-Feb-2026',
    comments: 21,
    excerpt:
      'Pro cooking tips to elevate your home dishes. Simple techniques with big impact.',
  },
]
const posts = basePosts.map((p, i) => ({
  ...p,
  image: assetImages[i % assetImages.length],
}))
</script>

<template>
  <div class="blog-grid-page">
    <section class="blog-hero" :style="{ backgroundImage: `linear-gradient(135deg, rgba(0,0,0,.6), rgba(0,0,0,.3)), url(${blogHero})` }">
      <div class="container py-5">
        <h1 class="hero-title">Blog Grid</h1>
        <p class="hero-sub">Latest updates and culinary stories</p>
      </div>
    </section>

    <section class="container py-5">
      <div class="row g-4">
        <div
          v-for="p in posts"
          :key="p.id"
          class="col-md-6 col-lg-4"
        >
          <article class="blog-card h-100">
            <div class="blog-thumb">
              <img :src="p.image" :alt="p.title" />
            </div>
            <div class="blog-body">
              <h3 class="blog-title">{{ p.title }}</h3>
              <div class="blog-meta">
                <span><i class="bi bi-person" /> {{ p.author }}</span>
                <span><i class="bi bi-tag" /> {{ p.category }}</span>
                <span><i class="bi bi-calendar" /> {{ p.date }}</span>
                <span><i class="bi bi-chat-dots" /> {{ p.comments }}</span>
              </div>
              <p class="blog-excerpt">{{ p.excerpt }}</p>
              <router-link class="btn btn-outline-secondary btn-sm" :to="`/blogs/details?id=${p.id}`">Read More</router-link>
            </div>
          </article>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="pagination-wrap">
            <button type="button" class="btn btn-light btn-sm" disabled>Prev</button>
            <button type="button" class="btn btn-light btn-sm">1</button>
            <button type="button" class="btn btn-light btn-sm">2</button>
            <button type="button" class="btn btn-light btn-sm">Next</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped>
.blog-hero {
  background-size: cover;
  background-position: center;
  color: #fff;
}
.hero-title {
  font-weight: 700;
}
.hero-sub {
  opacity: 0.9;
}
.blog-card {
  border: none;
  border-radius: 1rem;
  background: #fff;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
  overflow: hidden;
}
.blog-thumb {
  width: 100%;
  height: 180px;
  overflow: hidden;
}
.blog-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.blog-body {
  padding: 1rem 1rem 1.25rem;
}
.blog-title {
  font-size: 1.1rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}
.blog-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  color: #666;
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
}
.blog-excerpt {
  color: #555;
  font-size: 0.95rem;
}
.pagination-wrap {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 24px;
}
</style>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const assetImages = Object.values(
  import.meta.glob('@/assets/*.{png,jpg,jpeg}', { eager: true, import: 'default' })
)
const assetsMap = import.meta.glob('@/assets/*.{png,jpg,jpeg}', { eager: true, import: 'default' })
const blogHero =
  assetsMap['/src/assets/blog-hero.jpg'] ||
  assetsMap['/src/assets/blog_hero.jpg'] ||
  assetsMap['/src/assets/blogHero.jpg'] ||
  assetImages[0]
const id = computed(() => Number(route.query.id) || 1)
const featured = computed(() => assetImages[(id.value - 1) % assetImages.length])

const post = computed(() => ({
  title: 'Lorem ipsum dolor sit amet',
  author: 'Admin',
  category: 'Food',
  date: '01-Jan-2026',
  comments: 10,
  image: featured.value,
  sections: [
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer molestie, lorem eu eleifend bibendum, augue purus mollis sapien, non rhoncus eros leo in nunc.',
    'Mauris eu pulvinar tellus, eu luctus nisl. Pellentesque suscipit mi eu varius pulvinar. Aenean vulputate, massa eget elementum finibus, ipsum arcu commodo est.',
    'Quisque arcu nulla, convallis nec orci vel, suscipit elementum odio. Curabitur volutpat velit non diam tincidunt sodales. Nullam sapien libero, bibendum nec viverra in, iaculis ut eros.',
  ],
  quote:
    'Praesent ultricies, mauris eget vestibulum viverra, neque lorem malesuada mauris, eget rhoncus lectus enim a lorem.',
  tags: ['Food', 'Recipe', 'Kitchen', 'Tips'],
}))
</script>

<template>
  <div class="blog-details-page">
    <section class="blog-hero" :style="{ backgroundImage: `linear-gradient(135deg, rgba(0,0,0,.6), rgba(0,0,0,.3)), url(${blogHero})` }">
      <div class="container py-4">
        <div class="breadcrumb-wrap">
          <a href="/" class="breadcrumb-link">Home</a>
          <span class="breadcrumb-chevron">»</span>
          <a href="/blogs" class="breadcrumb-link">Blog Grid</a>
          <span class="breadcrumb-chevron">»</span>
          <span class="breadcrumb-current">Blog Details</span>
        </div>
        <h1 class="hero-title">Blog Details</h1>
        <p class="hero-sub">Read our latest culinary insights</p>
      </div>
    </section>

    <section class="container py-5">
      <div class="row g-4">
        <div class="col-lg-8">
          <article class="blog-article">
            <div class="article-featured">
              <img :src="post.image" alt="Featured" />
            </div>
            <h2 class="article-title">{{ post.title }}</h2>
            <div class="article-meta">
              <span><i class="bi bi-person" /> {{ post.author }}</span>
              <span><i class="bi bi-tag" /> {{ post.category }}</span>
              <span><i class="bi bi-calendar" /> {{ post.date }}</span>
              <span><i class="bi bi-chat-dots" /> {{ post.comments }}</span>
            </div>

            <div class="article-body">
              <p v-for="(s, i) in post.sections" :key="i">{{ s }}</p>
              <div class="article-quote">
                <div class="quote-icon">“</div>
                <p class="quote-text">{{ post.quote }}</p>
              </div>
            </div>

            <div class="article-bottom">
              <div class="article-tags">
                <span v-for="t in post.tags" :key="t" class="tag">{{ t }}</span>
              </div>
              <div class="article-share">
                <a href="#" aria-label="Share Facebook"><i class="bi bi-facebook" /></a>
                <a href="#" aria-label="Share Twitter"><i class="bi bi-twitter" /></a>
                <a href="#" aria-label="Share Linkedin"><i class="bi bi-linkedin" /></a>
              </div>
            </div>

            <div class="author-box">
              <div class="author-avatar" />
              <div>
                <div class="author-name">Chef Team</div>
                <p class="author-bio">
                  Stories and techniques from our kitchen. Fresh ingredients, bold flavors, and a
                  passion for great food.
                </p>
              </div>
            </div>

            <div class="article-nav">
              <router-link class="btn btn-light btn-sm" to="/blogs">← Back to Blog Grid</router-link>
              <div class="nav-spacer" />
              <button type="button" class="btn btn-light btn-sm" disabled>Prev</button>
              <button type="button" class="btn btn-light btn-sm">Next</button>
            </div>

            <div class="comment-form card shadow-sm p-3 mt-4">
              <h5 class="mb-3">Leave a Comment</h5>
              <form class="row g-3">
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Your Name" />
                </div>
                <div class="col-md-6">
                  <input type="email" class="form-control" placeholder="Your Email" />
                </div>
                <div class="col-12">
                  <textarea class="form-control" rows="4" placeholder="Comment" />
                </div>
                <div class="col-12">
                  <button type="button" class="btn btn-success">Post Comment</button>
                </div>
              </form>
            </div>
          </article>
        </div>

        <div class="col-lg-4">
          <aside class="sidebar">
            <div class="card shadow-sm p-3 mb-3">
              <h5 class="mb-3">Recent Posts</h5>
              <div class="recent-list">
                <div class="recent-item" v-for="i in 5" :key="i">
                  <div class="recent-thumb">
                    <img :src="assetImages[i % assetImages.length]" alt="" />
                  </div>
                  <div>
                    <div class="recent-title">Sample Post {{ i }}</div>
                    <div class="recent-meta"><i class="bi bi-calendar" /> 01-Jan-2026</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow-sm p-3">
              <h5 class="mb-3">Categories</h5>
              <div class="chip-list">
                <span class="chip">Food</span>
                <span class="chip">Tips</span>
                <span class="chip">Kitchen</span>
                <span class="chip">Dessert</span>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>
  </div>
</template>

<style scoped>
.blog-hero {
  background: linear-gradient(135deg, #ff7f50, #ffb26b);
  color: #fff;
}
.breadcrumb-wrap {
  color: #fff;
}
.breadcrumb-link {
  color: #fff;
  text-decoration: none;
}
.breadcrumb-chevron {
  margin: 0 6px;
}
.hero-title {
  font-weight: 700;
}
.hero-sub {
  opacity: 0.9;
}
.blog-article {
  background: #fff;
  border-radius: 1rem;
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  padding: 1rem 1rem 1.5rem;
}
.article-featured {
  width: 100%;
  height: 320px;
  border-radius: 0.75rem;
  overflow: hidden;
}
.article-featured img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.article-title {
  font-weight: 700;
  margin-top: 1rem;
}
.article-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  color: #666;
  margin-top: 6px;
}
.article-body {
  margin-top: 10px;
}
.article-quote {
  position: relative;
  background: rgba(255, 127, 80, 0.08);
  border-left: 4px solid #ff7f50;
  border-radius: 0.5rem;
  padding: 0.75rem 0.75rem 0.75rem 1rem;
  margin-top: 10px;
}
.quote-icon {
  color: #ff7f50;
  font-size: 1.6rem;
  line-height: 1;
}
.article-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  margin-top: 12px;
}
.article-tags {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}
.tag {
  padding: 0.25rem 0.5rem;
  border-radius: 999px;
  background: #f4f4f4;
  color: #333;
  font-weight: 600;
  font-size: 0.85rem;
}
.article-share a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 999px;
  background: #ff7f50;
  color: #fff;
  margin-left: 6px;
}
.author-box {
  display: flex;
  gap: 12px;
  align-items: flex-start;
  background: #fff;
  border-radius: 0.75rem;
  padding: 0.75rem;
  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.06);
  margin-top: 16px;
}
.author-avatar {
  width: 56px;
  height: 56px;
  border-radius: 999px;
  background:
    linear-gradient(#fff, #fff) padding-box,
    linear-gradient(135deg, #ff7f50, #ffb26b) border-box;
  border: 2px solid transparent;
}
.author-name {
  font-weight: 700;
}
.author-bio {
  margin: 0;
  color: #555;
}
.article-nav {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 16px;
}
.nav-spacer {
  flex: 1;
}
.sidebar .recent-list {
  display: grid;
  gap: 10px;
}
.recent-item {
  display: grid;
  grid-template-columns: 64px 1fr;
  gap: 10px;
  align-items: center;
}
.recent-thumb {
  width: 64px;
  height: 64px;
  overflow: hidden;
  border-radius: 0.5rem;
}
.recent-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.recent-title {
  font-weight: 600;
}
.recent-meta {
  color: #666;
  font-size: 0.85rem;
}
.chip-list {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.chip {
  padding: 0.25rem 0.5rem;
  border-radius: 999px;
  background: #f4f4f4;
  color: #333;
  font-weight: 600;
  font-size: 0.85rem;
}
</style>

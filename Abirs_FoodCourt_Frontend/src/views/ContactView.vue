<script setup>
import { ref } from 'vue'
import { useRoute } from 'vue-router'

const contactCards = [
  {
    label: 'Call Us',
    value: '+880 1632606827',
  },
  {
    label: 'Email',
    value: 'abirsfoodcourt@gmail.com',
  },
  {
    label: 'Location',
    value: 'Dhaka, Bangladesh',
  },
  {
    label: 'Working Hours',
    value: 'Everyday, 10:00 AM – 11:00 PM',
  },
]

const name = ref('')
const email = ref('')
const phone = ref('')
const subject = ref('')
const message = ref('')
const success = ref('')
const route = useRoute()
const nextUrl = `${location.origin}/contact?sent=1`
if (route.query?.sent === '1') {
  success.value = 'Thanks for your message. We will get back to you soon.'
}
const errors = ref({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: '',
})

function resetForm() {
  name.value = ''
  email.value = ''
  phone.value = ''
  subject.value = ''
  message.value = ''
  errors.value = {
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
  }
}

function validate() {
  errors.value = { name: '', email: '', phone: '', subject: '', message: '' }
  if (!name.value.trim()) errors.value.name = 'Please enter your name'
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(email.value)) errors.value.email = 'Enter a valid email'
  if (!phone.value.trim()) errors.value.phone = 'Enter your phone number'
  if (!subject.value.trim()) errors.value.subject = 'Add a subject'
  if (!message.value.trim() || message.value.length < 10)
    errors.value.message = 'Message should be at least 10 characters'
  return !(
    errors.value.name ||
    errors.value.email ||
    errors.value.phone ||
    errors.value.subject ||
    errors.value.message
  )
}
</script>

<template>
  <div class="contact-page py-5">
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-8">
          <h5 class="text-uppercase text-muted mb-2">Contact Us</h5>
          <h1 class="fw-bold mb-3">
            We are here to help with your orders
          </h1>
          <p class="text-muted mb-0">
            Reach out if you have questions about your order, delivery, or menu items.
          </p>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
          <div class="row">
            <div
              v-for="card in contactCards"
              :key="card.label"
              class="col-sm-6 mb-3"
            >
              <div class="card h-100 shadow-sm border-0 contact-card">
                <div class="card-body">
                  <h6 class="text-muted text-uppercase small mb-1">
                    {{ card.label }}
                  </h6>
                  <p class="mb-0">
                    {{ card.value }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm border-0 contact-form-card">
            <div class="card-body">
              <h5 class="mb-3">Send us a message</h5>

              <div
                v-if="success"
                class="alert alert-success py-2"
                role="alert"
              >
                {{ success }}
              </div>

              <form action="https://formsubmit.co/idbmahedi@gmail.com" method="POST" @submit="validate()" novalidate>
                <input type="hidden" name="_next" :value="nextUrl" />
                <input type="hidden" name="_subject" value="New Contact Message — Abir's FoodCourt" />
                <input type="hidden" name="_captcha" value="false" />
                <input type="hidden" name="_template" value="table" />
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <div class="contact-input">
                      <span class="contact-input-icon">
                        <i class="bi bi-person" />
                      </span>
                      <input
                        name="name"
                        v-model="name"
                        type="text"
                        class="form-control contact-input-control"
                        placeholder="Your name"
                        required
                      />
                    </div>
                    <div v-if="errors.name" class="text-danger small mt-1">{{ errors.name }}</div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <div class="contact-input">
                      <span class="contact-input-icon">
                        <i class="bi bi-envelope" />
                      </span>
                      <input
                        name="email"
                        v-model="email"
                        type="email"
                        class="form-control contact-input-control"
                        placeholder="you@example.com"
                        required
                      />
                    </div>
                    <div v-if="errors.email" class="text-danger small mt-1">{{ errors.email }}</div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <div class="contact-input">
                      <span class="contact-input-icon">
                        <i class="bi bi-telephone" />
                      </span>
                      <input
                        name="phone"
                        v-model="phone"
                        type="tel"
                        class="form-control contact-input-control"
                        placeholder="+880 1XXXXXXXXX"
                        required
                      />
                    </div>
                    <div v-if="errors.phone" class="text-danger small mt-1">{{ errors.phone }}</div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Subject</label>
                    <div class="contact-input">
                      <span class="contact-input-icon">
                        <i class="bi bi-chat-dots" />
                      </span>
                      <input
                        name="subject"
                        v-model="subject"
                        type="text"
                        class="form-control contact-input-control"
                        placeholder="Subject"
                        required
                      />
                    </div>
                    <div v-if="errors.subject" class="text-danger small mt-1">{{ errors.subject }}</div>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <div class="contact-input contact-textarea">
                    <span class="contact-input-icon">
                      <i class="bi bi-pencil-square" />
                    </span>
                    <textarea
                      name="message"
                      v-model="message"
                      class="form-control contact-input-control"
                      rows="4"
                      placeholder="Your message"
                      required
                    />
                  </div>
                  <div v-if="errors.message" class="text-danger small mt-1">{{ errors.message }}</div>
                </div>
                <button
                  type="submit"
                  class="btn btn-coral w-100"
                >
                  Send Message
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="contact-map-wrapper shadow-sm">
            <iframe
              src="https://www.google.com/maps?q=Dhaka%2C%20Bangladesh&output=embed"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.contact-page {
  background-color: #fffaf6;
}

.contact-card {
  background-color: #ffffff;
}

.contact-form-card {
  border-radius: 1rem;
  overflow: hidden;
}

.contact-input {
  position: relative;
  display: flex;
  align-items: center;
}
.contact-input-icon {
  position: absolute;
  left: 10px;
  color: #888;
  z-index: 2;
}
.contact-input-control {
  padding-left: 2rem;
  border-radius: 0.5rem;
}
.contact-textarea .contact-input-icon {
  top: 10px;
}

.contact-map-wrapper {
  border-radius: 1rem;
  overflow: hidden;
}

.contact-map-wrapper iframe {
  width: 100%;
  height: 260px;
  border: 0;
}

.btn-coral {
  background-color: #ff7f50;
  border-color: #ff7f50;
  color: #fff;
}
.btn-coral:hover,
.btn-coral:focus {
  background-color: #ff6a38;
  border-color: #ff6a38;
  color: #fff;
}
</style>

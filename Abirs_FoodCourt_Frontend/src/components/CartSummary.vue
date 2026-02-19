<script setup>
import { computed } from 'vue'
import { useCartStore } from '../stores/cart'

const cartStore = useCartStore()

const items = computed(() => cartStore.items)
const subtotal = computed(() => cartStore.subtotal)
const tax = computed(() => cartStore.tax)
const total = computed(() => cartStore.total)

function updateQuantity(id, value) {
  const quantity = Number(value)
  cartStore.updateQuantity(id, quantity)
}

function removeItem(id) {
  cartStore.removeFromCart(id)
}
</script>

<template>
  <div>
    <h2 class="h4 mb-3">Cart</h2>
    <div v-if="!items.length" class="text-muted">
      Cart is empty.
      <div class="mt-3">
        <router-link class="btn btn-primary" to="/">Browse menu</router-link>
      </div>
    </div>
    <div v-else>
      <div class="card border-0 shadow-sm mb-3">
        <div class="card-body p-0">
          <transition-group name="list" tag="div">
            <div
              v-for="item in items"
              :key="item.id"
              class="px-3 py-2 border-bottom d-flex align-items-center"
            >
              <img
                v-if="item.image"
                :src="item.image"
                :alt="item.name"
                width="64"
                height="64"
                class="me-3 rounded"
                style="object-fit: cover"
              />
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fw-semibold">{{ item.name }}</div>
                    <div class="text-muted small">Price: ৳{{ Number(item.price).toFixed(2) }}</div>
                    <div class="text-muted small">VAT 5%: ৳{{ (Number(item.price) * 0.05).toFixed(2) }}</div>
                  </div>
                  <div class="fw-semibold">৳{{ (Number(item.price) * 1.05 * Number(item.quantity)).toFixed(2) }}</div>
                </div>
                <div class="mt-2 d-flex align-items-center">
                  <div class="btn-group me-2" role="group" aria-label="Quantity">
                    <button
                      type="button"
                      class="btn btn-outline-secondary btn-sm"
                      @click="updateQuantity(item.id, Number(item.quantity) - 1)"
                    >−</button>
                    <input
                      :value="item.quantity"
                      type="number"
                      min="1"
                      class="form-control form-control-sm text-center"
                      style="width: 70px"
                      @input="updateQuantity(item.id, $event.target.value)"
                    />
                    <button
                      type="button"
                      class="btn btn-outline-secondary btn-sm"
                      @click="updateQuantity(item.id, Number(item.quantity) + 1)"
                    >+</button>
                  </div>
                  <button
                    type="button"
                    class="btn btn-outline-danger btn-sm"
                    @click="removeItem(item.id)"
                  >
                    Remove
                  </button>
                </div>
              </div>
            </div>
          </transition-group>
        </div>
      </div>
      <div class="d-flex flex-column gap-2">
        <div class="d-flex justify-content-between">
          <span class="text-muted">Subtotal</span>
          <span class="fw-semibold">৳{{ Number(subtotal).toFixed(2) }}</span>
        </div>
        <div class="d-flex justify-content-between">
          <span class="text-muted">VAT (5%)</span>
          <span class="fw-semibold">৳{{ Number(tax).toFixed(2) }}</span>
        </div>
        <div class="d-flex justify-content-between">
          <span class="fw-semibold">Total</span>
          <span class="fw-bold">৳{{ Number(total).toFixed(2) }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.2s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateY(-4px);
}
</style>

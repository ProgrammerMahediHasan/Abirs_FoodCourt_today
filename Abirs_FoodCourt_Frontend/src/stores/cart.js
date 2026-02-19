import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('cart_items') || '[]'),
  }),
  getters: {
    itemCount(state) {
      return state.items.reduce((sum, item) => sum + item.quantity, 0)
    },
    subtotal(state) {
      return state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      )
    },
    tax(state) {
      const subtotal = state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      )
      const rate = 0.05
      return subtotal * rate
    },
    total(state) {
      const subtotal = state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      )
      const tax = subtotal * 0.05
      return subtotal + tax
    },
    totalPrice(state) {
      const subtotal = state.items.reduce(
        (sum, item) => sum + item.quantity * item.price,
        0,
      )
      const tax = subtotal * 0.05
      return subtotal + tax
    },
  },
  actions: {
    addToCart(product) {
      const existing = this.items.find((item) => item.id === product.id)
      if (existing) {
        existing.quantity += 1
      } else {
        this.items.push({
          id: product.id,
          name: product.name,
          price: product.price,
          image: product.image_url || product.image,
          quantity: 1,
        })
      }
      localStorage.setItem('cart_items', JSON.stringify(this.items))
    },
    updateQuantity(id, quantity) {
      const item = this.items.find((i) => i.id === id)
      if (!item) return
      if (quantity <= 0) {
        this.removeFromCart(id)
      } else {
        item.quantity = quantity
        localStorage.setItem('cart_items', JSON.stringify(this.items))
      }
    },
    removeFromCart(id) {
      this.items = this.items.filter((item) => item.id !== id)
      localStorage.setItem('cart_items', JSON.stringify(this.items))
    },
    clearCart() {
      this.items = []
      localStorage.setItem('cart_items', JSON.stringify(this.items))
    },
  },
})

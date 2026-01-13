import './bootstrap';
import Alpine from 'alpinejs'
 
window.Alpine = Alpine

Alpine.data('navbar', () => ({
  open: false,
  toggle() {
    this.open = !this.open;
  }
}))

Alpine.data('credentialForm', () => ({
  accessKey: '',
  secretKey: '',
  isSecretKeyVisible: false,

  toggleSecretKeyVisibility() {
    this.isSecretKeyVisible = !this.isSecretKeyVisible
  },

  generateCredentials() {
    this.accessKey = this.generateRandomKey()
    this.secretKey = this.generateRandomKey()

    console.log(this.accessKey, this.secretKey)
  },

  generateRandomKey() {
    return crypto.randomUUID().replace(/-/g, '')
  }
}))


Alpine.start();
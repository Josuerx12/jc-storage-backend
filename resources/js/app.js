import './bootstrap';
import Alpine from 'alpinejs';

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
    this.accessKey = crypto.randomUUID()
    this.secretKey = crypto.randomUUID()
  },
}))


Alpine.start();
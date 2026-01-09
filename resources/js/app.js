import './bootstrap';
import Alpine from 'alpinejs'
 
window.Alpine = Alpine

Alpine.data('navbar', () => ({
  open: false,
  toggle() {
    this.open = !this.open;
  }
}))

Alpine.start();
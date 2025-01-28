import './bootstrap';

//import '../scss/app.scss';
import *  as bootstrap from 'bootstrap';

// Ejemplo: inicializar un tooltip
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
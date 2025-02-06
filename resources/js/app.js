import './bootstrap';

const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css')
   .js('resources/js/app.js', 'public/js')
   .version();




   import $ from 'jquery'; // Asegúrate de que jQuery esté instalado
import 'select2'; // Importar Select2

// Inicializar Select2
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Selecciona los cursos",
        allowClear: true
    });
});


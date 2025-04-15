import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'select2/dist/css/select2.min.css';
import 'select2/dist/js/select2.min.js';
import React from 'react';
import ReactDOM from 'react-dom';
import MyComponent from './MyComponent';  // Importe o seu componente ShadCN aqui

ReactDOM.render(React.createElement(MyComponent), document.getElementById('app'));


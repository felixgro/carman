/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
    Initiale Page-Load-Animationen für alle Pages und sämmtliche Eventlistener im Header
    Dep: anime.js
*/
// Methode für Logo und Action Buttons im Header
var animateHeader = function animateHeader() {
  // Logo
  anime({
    targets: '.carmanLogo',
    rotate: 360,
    scale: 1,
    opacity: 1
  }); // Action Buttons

  anime({
    targets: '.header-action',
    duration: 600,
    easing: 'easeOutSine',
    opacity: 1,
    delay: function delay(el, i) {
      return i * 50;
    }
  });
};

animateHeader(); // LOGIK FÜR LOGOEVENTS (HEADER)

var logo = document.querySelector('.carmanLogo');
var mouseover = false; // Entählt aktuellen Logo-Hoverstatus

logo.addEventListener('mouseover', function (event) {
  if (!mouseover) {
    mouseover = true;
    anime({
      targets: '.carmanLogo',
      rotate: 720,
      scale: 1,
      opacity: 1
    });
  }
});
logo.addEventListener('mouseleave', function (event) {
  if (mouseover) {
    mouseover = false;
    anime({
      targets: '.carmanLogo',
      rotate: 360,
      scale: 1,
      opacity: 1
    });
  }
}); // Redirect zu Landingpage

logo.addEventListener('click', function (event) {
  window.location.href = "/";
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/components/forms.scss":
/*!**********************************************!*\
  !*** ./resources/sass/components/forms.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/components/tables.scss":
/*!***********************************************!*\
  !*** ./resources/sass/components/tables.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/dashboard.scss":
/*!***************************************!*\
  !*** ./resources/sass/dashboard.scss ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/welcome/landing.scss":
/*!*********************************************!*\
  !*** ./resources/sass/welcome/landing.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/welcome/register.scss":
/*!**********************************************!*\
  !*** ./resources/sass/welcome/register.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*********************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/components/forms.scss ./resources/sass/components/tables.scss ./resources/sass/welcome/landing.scss ./resources/sass/welcome/register.scss ./resources/sass/dashboard.scss ***!
  \*********************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/js/app.js */"./resources/js/app.js");
__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/app.scss */"./resources/sass/app.scss");
__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/components/forms.scss */"./resources/sass/components/forms.scss");
__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/components/tables.scss */"./resources/sass/components/tables.scss");
__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/welcome/landing.scss */"./resources/sass/welcome/landing.scss");
__webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/welcome/register.scss */"./resources/sass/welcome/register.scss");
module.exports = __webpack_require__(/*! /Users/felixgrohs/Server/rider/resources/sass/dashboard.scss */"./resources/sass/dashboard.scss");


/***/ })

/******/ });
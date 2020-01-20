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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/menu.js":
/*!******************************!*\
  !*** ./resources/js/menu.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  // Main Menu Tooltip Function
  var icons = document.querySelectorAll('#menuIcons a');
  var tooltip = document.getElementById('menuTooltip');
  var toolRect = tooltip.getBoundingClientRect(); // Liest die Aktuelle Seite aus einem Hidden Inputfeld aus. Das Value dieses Feldes kommt aus PHP vom jeweiligen Controller

  var currentPage = document.getElementById('currentPage').value == '' ? 'home' : document.getElementById('currentPage').value;
  var currentFocus;

  switch (currentPage) {
    case 'vehicle':
      currentFocus = 1;
      break;

    case 'route':
      currentFocus = 2;
      break;

    case 'expense':
      currentFocus = 3;
      break;

    case 'dependency':
      currentFocus = 4;
      break;

    default:
      currentFocus = 0;
  } // TODO: Wenn Auswahltasten verwendet wurden, kehrt Menu nach 10 sekunden in den Normalzustand


  var keyTimeout = 10; // Header Zeile inder sich das Tooltip bewegen soll

  var targetRowRect = document.querySelector('header section.sub').getBoundingClientRect(); // Wird ausgeführt, wenn der Cursor ein Icon überlapt

  var mouseEnter = function mouseEnter(event) {
    var icon = event.target;
    renameTooltip(icon.dataset.name);
    moveTooltip(icon.getBoundingClientRect());
  }; // Wird ausgeführt, wenn  sich der Cursor nichtmehr über dem Icon befindet


  var mouseLeave = function mouseLeave(event) {
    resetTooltip();
  };

  var getTooltipY = function getTooltipY() {
    var targetRowRect = document.querySelector('header section.sub').getBoundingClientRect();
    var y = targetRowRect.y + targetRowRect.height / 2 - toolRect.height / 2 + document.body.scrollTop;
    return y;
  };

  var y = getTooltipY(); // Bewegt das Tooltip zum Icon der aktuellen Seite

  var resetTooltip = function resetTooltip() {
    for (var i = 0; i < icons.length; i++) {
      var name = icons[i].dataset.name.toLowerCase();

      if (name === currentPage.toLowerCase()) {
        renameTooltip(name);
        moveTooltip(icons[i].getBoundingClientRect());
      }
    }
  }; // Zentriert Tooltip in untester Menuzeile unter dem ClientRect rect


  var moveTooltip = function moveTooltip(rect) {
    updateToolRect();
    var x = rect.x + rect.width / 2 - toolRect.width / 2;
    var y = targetRowRect.y + targetRowRect.height / 2 - toolRect.height / 2;
    tooltip.style.left = x + "px";
    tooltip.style.top = y + "px";
  }; // Ändert den im Tooltip gezeigten Text zu value


  var renameTooltip = function renameTooltip(value) {
    tooltip.innerText = value;
  }; // Notwendig, da Tooltip bei renameTooltip() die Breite verändern könnte


  var updateToolRect = function updateToolRect() {
    toolRect = tooltip.getBoundingClientRect();
  }; // Eventlistener Zuweisungen


  for (var i = 0; i < icons.length; i++) {
    icons[i].addEventListener('mouseover', mouseEnter);
    icons[i].addEventListener('mouseleave', mouseLeave);
    icons[i].addEventListener('focus', mouseEnter);
    icons[i].addEventListener('blur', mouseLeave);
  } // Setzt Tooltip zu current Page zurück


  setTimeout(resetTooltip, 300);
  /* Key Menu Navigation:
   '.':              öffnet Einstellungen
  links / rechts:   main manu auswahl
  oben / enter:     link aufrufen
  unten:           abbrechen
  */

  var keyTimeoutFunction = undefined; // Startet Timeout von keyTimeout Sekunden bis Menu in Normalzustand gerät

  var activateTimeout = function activateTimeout() {
    keyTimeoutFunction = setTimeout(function () {
      currentFocus = 0;
      resetTooltip();
    }, keyTimeout * 1000);
  }; // TODO: Icon farbe ändern


  var cancleTimeout = function cancleTimeout() {
    if (keyTimeoutFunction !== undefined) {
      clearTimeout(keyTimeoutFunction);
      keyTimeoutFunction = undefined;
    }
  };

  document.addEventListener('keydown', function (event) {
    // Event Zuordnung
    switch (event.code) {
      case 'ArrowLeft':
        // Wählt linkes Element aus. wenn keines vorhanden ist wird das ganz rechte ausgewählt
        if (currentFocus === 0) {
          icons[icons.length - 1].focus();
          currentFocus = icons.length - 1;
        } else if (currentFocus > 0) {
          icons[--currentFocus].focus();
        }

        break;

      case 'ArrowRight':
        // Wählt rechtes Element aus, wenn keines vorhanden ist wird das ganz linke ausgewählt
        if (currentFocus === icons.length - 1) {
          icons[0].focus();
          currentFocus = 0;
        } else if (currentFocus < icons.length - 1) {
          icons[++currentFocus].focus();
        }

        break;

      case 'ArrowDown':
        // Bricht die Auswahl ab und kehrt in Normalzustand zurück
        currentFocus = 0;

        for (var _i = 0; _i < icons.length; _i++) {
          icons[_i].blur();
        }

        resetTooltip();
        break;

      case 'ArrowUp':
        // Öffnet die aktuelle Auswahl
        var url = document.activeElement.href;
        window.location = url;
        break;

      default:
        // Sollte eine andere Taste außer den Pfeiltasten und der Entertaste gedrückt werden so wird ebenfals die Auswahl abgebrochen
        currentFocus = 0;
        resetTooltip();
        break;
    }
  });
})();

/***/ }),

/***/ 3:
/*!************************************!*\
  !*** multi ./resources/js/menu.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/felixgrohs/Server/Rider/resources/js/menu.js */"./resources/js/menu.js");


/***/ })

/******/ });
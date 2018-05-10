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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/coffee/defer-image-load.coffee":
/***/ (function(module, exports) {

var i, image, images, len, loadDeferredImage;

loadDeferredImage = function(element) {
  var s, src;
  src = element.getAttribute('data-defer-src');
  s = document.createAttribute('src');
  s.nodeValue = src;
  element.setAttributeNode(s);
};

images = document.querySelectorAll('img[data-defer-src]');

for (i = 0, len = images.length; i < len; i++) {
  image = images[i];
  loadDeferredImage(image);
}


/***/ }),

/***/ "./resources/assets/coffee/frank.slideshow.coffee":
/***/ (function(module, exports) {

/*global */
var FSS;

FSS = (function() {
  var autoNext, createElement, isChild, mouseOutHandler, mouseOverHandler, navClickHandler;

  //Slideshow class
  class FSS {
    
    // @element=null
    // @options=null
    // @target=null
    // @container=null
    // @slides=[]
    // @navigation=null
    // @slideA=null
    // @slideB=null
    // @caption=null
    // @currentIndex=-1
    // @interval=null
    // @autoplay=true
    constructor(el, o) {
      this.element = el;
      if (Object.prototype.toString.call(o) === '[object Object]') {
        this.options = o;
      } else {
        this.options = {};
      }
      this.init();
      this.gotoslide(0);
      if (this.autoplay) {
        this.play();
      }
    }

    // Public Methods
    pause() {
      clearTimeout(this.interval);
    }

    play() {
      clearTimeout(this.interval);
      this.interval = setTimeout(autoNext, this.duration, this);
    }

    next() {
      var index;
      index = this.currentIndex < this.slides.length - 1 ? this.currentIndex + 1 : 0;
      this.gotoslide(index);
    }

    gotoslide(index) {
      var a, m;
      if (this.currentIndex === index) {
        return;
      }
      a = this.element.parentNode.querySelector(".visible");
      if (a && a === this.slideA) {
        this.slideB.style.backgroundPosition = '0px ' + String(this.options.height * index * -1) + 'px';
        this.slideA.className = this.slideA.className.replace(new RegExp('(\\s|^)' + 'visible' + '(\\s|$)'), '');
        this.slideB.className += ' visible';
      } else {
        this.slideA.style.backgroundPosition = '0px ' + String(this.options.height * index * -1) + 'px';
        this.slideB.className = this.slideB.className.replace(new RegExp('(\\s|^)' + 'visible' + '(\\s|$)'), '');
        this.slideA.className += ' visible';
      }
      a = this.navigation.querySelector('.active');
      if (a) {
        a.removeAttribute('class');
      }
      a = document.createAttribute('class');
      a.nodeValue = 'active';
      this.navigation.childNodes.item(index).setAttributeNode(a);
      m = this.currentIndex === -1 ? 0 : this.currentIndex;
      this.slides[m].el.className = this.slides[m].el.className.replace(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'), '');
      this.slides[index].el.className += ' active';
      this.currentIndex = index;
    }

    // Private Methods
    init() {
      var cap, context, i, j, l, len, n, ref, slide;
      context = this;
      if (!this.options.width) {
        this.options.width = this.element.offsetWidth;
      }
      if (!this.options.height) {
        this.options.height = this.element.offsetHeight;
      }
      //TEMP
      this.autoplay = true;
      this.duration = 5000;
      this.currentIndex = -1;
      if (!this.element.className.match(new RegExp('(\\s|^)' + 'fss' + '(\\s|$)'))) {
        // inject FSS class name
        this.element.className += ' ' + 'fss';
      }
      
      // find captions
      this.caption = this.element.querySelector('.captions');
      if (!this.caption) {
        return;
      }
      cap = this.caption.firstChild;
      n = 0;
      this.slides = [];
      while (cap) {
        if (cap && cap.nodeType !== 3) {
          this.slides.push({
            ndx: n++,
            el: cap
          });
        }
        cap = cap.nextSibling;
      }
      
      // create slide container
      this.container = createElement('div', 'slide-container');
      // create slide A
      this.slideA = createElement('div', 'slide-a visible');
      // create slide B
      this.slideB = createElement('div', 'slide-b');
      // insert elements
      this.element.insertBefore(this.container, this.caption);
      this.container.appendChild(this.slideA);
      this.container.appendChild(this.slideB);
      // set dimensions of slides
      this.slideA.style.width = this.slideB.style.width = this.options.width + 'px';
      this.slideA.style.height = this.slideB.style.height = this.options.height + 'px';
      this.navigation = createElement('ul', 'fss-nav');
      ref = this.slides;
      for (i = j = 0, len = ref.length; j < len; i = ++j) {
        slide = ref[i];
        l = createElement('li');
        l.appendChild(document.createTextNode(String(i + 1)));
        this.navigation.appendChild(l);
        l.onclick = navClickHandler(l, this);
      }
      this.container.appendChild(this.navigation);
      this.container.onmouseover = function(e) {
        return mouseOverHandler(e, context);
      };
      this.container.onmouseout = function(e) {
        return mouseOutHandler(e, context);
      };
    }

  };

  createElement = function(tagName, className) {
    var attribute, element;
    element = document.createElement(tagName);
    if (!className) {
      return element;
    }
    attribute = document.createAttribute("class");
    attribute.nodeValue = className;
    element.setAttributeNode(attribute);
    return element;
  };

  isChild = function(child, parent) {
    if (child === parent) {
      return false;
    }
    while (child && child !== parent) {
      child = child.parentNode;
    }
    return child === parent;
  };

  autoNext = function(closure) {
    if (!closure) {
      return;
    }
    closure.next();
    closure.play();
  };

  // Event Handlers
  navClickHandler = function(elem, closure) {
    return function() {
      var i;
      closure.pause();
      i = 0;
      while (closure.navigation.childNodes.item(i)) {
        if (closure.navigation.childNodes.item(i) === elem) {
          closure.gotoslide(i);
          return;
        }
        i++;
      }
    };
  };

  mouseOverHandler = function(e, closure) {
    if (!e) {
      return;
    }
    if (!isChild(e.target, closure.container)) {
      e.cancelBubble = true;
      e.stopPropagation();
      return false;
    }
    closure.pause();
    if (!closure.navigation.className.match(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'))) {
      closure.navigation.className += ' active';
    }
  };

  mouseOutHandler = function(e, closure) {
    if (isChild(e.relatedTarget, closure.container)) {
      e.cancelBubble = true;
      e.stopPropagation();
      return false;
    }
    closure.play();
    if (closure.navigation.className.match(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'))) {
      closure.navigation.className = closure.navigation.className.replace(new RegExp('(\\s|^)' + 'active' + '(\\s|$)'), '');
    }
  };

  return FSS;

}).call(this);


/***/ }),

/***/ "./resources/assets/scss/style.scss":
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__("./resources/assets/coffee/defer-image-load.coffee");
__webpack_require__("./resources/assets/coffee/frank.slideshow.coffee");
module.exports = __webpack_require__("./resources/assets/scss/style.scss");


/***/ })

/******/ });
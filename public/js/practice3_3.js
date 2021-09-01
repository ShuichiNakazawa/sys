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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/practice3_3.js":
/*!*************************************!*\
  !*** ./resources/js/practice3_3.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// 数値を通貨書式「#,###,###」に変換するフィルター
Vue.filter('number_format', function (val) {
  return val.toLocaleString();
});
var app = new Vue({
  delimiters: ["(%", "%)"],
  el: '#app',
  data: {
    // 「セール対象」のチェック状態（true: チェック有、false: チェック無し）
    showSaleItem: false,
    // 「送料無料」のチェック状態（true: チェック有、false: チェック無し）
    showDelvFree: false,
    // 「並び替え」の選択値（１：標準、２：価格が安い順）
    sortOrder: 1,
    // 商品リスト
    products: [{
      id: 1,
      name: 'Michael<br>スマホケース',
      price: 1580,
      image: '../../vue_images/01.jpg',
      delv: 0,
      isSale: true
    }, {
      id: 2,
      name: 'Raphael<br>スマホケース',
      price: 1580,
      image: '../../vue_images/02.jpg',
      delv: 0,
      isSale: true
    }, {
      id: 3,
      name: 'Gabriel<br>スマホケース',
      price: 1580,
      image: '../../vue_images/03.jpg',
      delv: 240,
      isSale: true
    }, {
      id: 4,
      name: 'Uriel<br>スマホケース',
      price: 980,
      image: '../../vue_images/04.jpg',
      delv: 0,
      isSale: true
    }, {
      id: 5,
      name: 'Ariel<br>スマホケース',
      price: 980,
      image: '../../vue_images/05.jpg',
      delv: 0,
      isSale: false
    }, {
      id: 6,
      name: 'Azrael<br>スマホケース',
      price: 1580,
      image: '../../vue_images/06.jpg',
      delv: 0,
      isSale: false
    }]
  },
  computed: {
    // 絞り込み後の商品リストを返す算出プロパティ
    filteredList: function filteredList() {
      // 絞り込み後の商品リストを格納する新しい配列
      var newList = [];

      for (var i = 0; i < this.products.length; i++) {
        // 表示対象かどうかを判定するフラグ
        var isShow = true; // i番目の商品が表示対象かどうかを判定する

        if (this.showSaleItem && !this.products[i].isSale) {
          // 「セール対象」チェック有りで、セール対象商品ではない場合
          isShow = false; // この商品は表示しない
        }

        if (this.showDelvFree && this.products[i].delv > 0) {
          // 「送料無料」チェック有りで、送料有りの商品の場合
          isShow = false; // この商品は表示しない
        } // 表示対象の商品だけを新しい配列に追加する


        if (isShow) {
          newList.push(this.products[i]);
        }
      } // 新しい配列を並び替える


      if (this.sortOrder == 1) {// 元の順番にpush しているので並び替え済み
      } else if (this.sortOrder == 2) {
        // 価格が安い順に並び替える
        newList.sort(function (a, b) {
          return a.price - b.price;
        });
      } // 絞り込み後の商品リストを返す


      return newList;
    },
    // 絞り込み後の商品リストの件数を返す算出プロパティ
    count: function count() {
      return this.filteredList.length;
    }
  },
  watch: {
    // 「セール対象」チェックボックスの状態を監視するウォッチャ
    showSaleItem: function showSaleItem(newVal, oldVal) {
      // ここで products の配列を書き換える
      console.log('showSaleItemウォッチャが呼び出されました。');
    },
    // 「送料無料」チェックボックスの状態を監視するウォッチャ
    showDelvFree: function showDelvFree(newVal, oldVal) {
      // ここで products の配列を書き換える
      console.log('showDelvFree ウォッチャが呼び出されました。');
    }
  }
});

/***/ }),

/***/ 6:
/*!*******************************************!*\
  !*** multi ./resources/js/practice3_3.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Business\プロジェクト\lara-assist\code\sys\resources\js\practice3_3.js */"./resources/js/practice3_3.js");


/***/ })

/******/ });